<?php

// Remember to set session.use_only_cookies=1 in php.ini.
// Shouldn't need to do anything else to protect against session attacks. 

$session = session_start();

// To protect from CSRF we can store a NONCE in a session variable,
// add a hidden input value with this NONCE to every form and then
// check whether this value is supplied in every POST request. If it
// isn't, we will know that a CSRF attack has been attempted and can
// deny the request. 

// CAUTION: The script below uses REGEX to parse HTML. Heed the
// following warning: 
// http://stackoverflow.com/questions/1732348/regex-match-open-tags-except-xhtml-self-contained-tags/1732454#1732454
// In a real site, the CSRF would be added internally by a form generating function.

// Start of CSRF Guard
// From: https://www.owasp.org/index.php/PHP_CSRF_Guard
function store_in_session($key,$value)
{
	if (isset($_SESSION))
	{
		$_SESSION[$key]=$value;
	}
}

function unset_session($key)
{
	$_SESSION[$key]=' ';
	unset($_SESSION[$key]);
}

function get_from_session($key)
{
	if (isset($_SESSION))
	{
		return $_SESSION[$key];
	}
	else {  return false; } //no session data, no CSRF risk
}

function csrfguard_generate_token($unique_form_name)
{
	if (function_exists("hash_algos") and in_array("sha512",hash_algos()))
	{
		$token=hash("sha512", mt_rand(0, mt_getrandmax()));
	}
	else
	{
		$token=' ';
		for ($i=0;$i<128;++$i)
		{
			$r=mt_rand(0,35);
			if ($r<26)
			{
				$c=chr(ord('a')+$r);
			}
			else
			{ 
				$c=chr(ord('0')+$r-26);
			} 
			$token.=$c;
		}
	}
	store_in_session($unique_form_name,$token);
	return $token;
}

function csrfguard_validate_token($unique_form_name,$token_value)
{
	$token=get_from_session($unique_form_name);
	if ($token===false)
	{
		return true;
	}
	elseif ($token===$token_value)
	{
		$result=true;
	}
	else
	{ 
		$result=false;
	} 
	unset_session($unique_form_name);
	return $result;
}

function csrfguard_replace_forms($form_data_html)
{
	$count=preg_match_all("/<form(.*?)>(.*?)<\\/form>/is",$form_data_html,$matches,PREG_SET_ORDER);
	if (is_array($matches))
	{
		foreach ($matches as $m)
		{
			if (strpos($m[1],"nocsrf")!==false) { continue; }
			$name="CSRFGuard_".mt_rand(0,mt_getrandmax());
			$token=csrfguard_generate_token($name);
			$form_data_html=str_replace($m[0],
				"<form{$m[1]}>
<input type='hidden' name='CSRFName' value='{$name}' />
<input type='hidden' name='CSRFToken' value='{$token}' />{$m[2]}</form>",$form_data_html);
		}
	}
	return $form_data_html;
}
function csrfguard_inject()
{
	$data=ob_get_clean();
	$data=csrfguard_replace_forms($data);
	echo $data;
}
function csrfguard_start()
{
	if (count($_POST))
	{
		if ( !isset($_POST['CSRFName']) or !isset($_POST['CSRFToken']) )
		{
			trigger_error("No CSRFName found, probable invalid request.",E_USER_ERROR);		
		} 
		$name =$_POST['CSRFName'];
		$token=$_POST['CSRFToken'];
		if (!csrfguard_validate_token($name, $token))
		{ 
			trigger_error("Invalid CSRF token.",E_USER_ERROR);
		} 
	}
	ob_start();
	register_shutdown_function('csrfguard_inject');
}

csrfguard_start();
// End of CSRF Guard

?>