INSTALL SSL
===========

1. Copy "ssl.crt" and "ssl.key" to folder corresponding to "C:\wamp\bin\apache\Apache2.4.4\conf"

2. In the same folder open "httpd.conf" and find and uncomment:
	#LoadModule socache_shmcb_module modules/mod_socache_shmcb.so
	#LoadModule ssl_module modules/mod_ssl.so
	#Include conf/extra/httpd-ssl.conf

3. In the subfolder "extra" open "httpd-ssl.conf" and edit following rows to these values or corresponding values for your filesystem:
	<VirtualHost _default_:443>
	DocumentRoot "c:/wamp/www" 	<-- Your htdocs folder
	ServerName localhost:443
	ServerAdmin admin@localhost
	ErrorLog "c:/wamp/bin/apache/Apache2.4.4/logs/error.log"
	TransferLog "c:/wamp/bin/apache/Apache2.4.4/logs/access.log"
	SSLEngine on
	SSLCertificateFile "c:/wamp/bin/apache/Apache2.4.4/conf/ssl.crt" 	<-- Files from step 1
	SSLCertificateKeyFile "c:/wamp/bin/apache/Apache2.4.4/conf/ssl.key" 	<-- Files from step 1
	</VirtualHost>

4. httpd -t to check that everything is fine.

5. In folder corresponding to "C:\wamp\bin\php\php5.4.12" open "php.ini" and uncomment the following row:
	;extension=php_openssl.dll

6. Restart A(M)P et Voilà!
