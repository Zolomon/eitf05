eitf05
======

Project for the course EITF05 (web security)


Design
======

`index.php` includes `content.php` which includes the appropriate file from `contents/` via the session variable `$_SESSION['site']`.

The following files sets `$_SESSION['site']` to the name of the file, and then redirects to `index.php` which will then show the chosen content.

* `shop.php`
* `cart.php`
* `checkout.php`

Protection
====
[X] [XSS Evasion Cheat Sheet](https://www.owasp.org/index.php/XSS_Filter_Evasion_Cheat_Sheet): Protection by escaping before outputting as HTML.
[X] [SQL Injections](https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet): Protection using PHP PDOs.


TODO
====

[ ] SQLi protection via sanitizing input EVERYWHERE
