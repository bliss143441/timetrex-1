;<?php die('Unauthorized Access...'); //SECURITY MECHANISM, DO NOT REMOVE//?>
;
;
; TimeTrex Configuration File
; *Windows Example*
;
;

;
; System paths. NO TRAILING SLASHES!
;
[path]
;URL to TimeTrex web root directory. ie: http://your.domain.com/<*BASE_URL*>
;DO NOT INCLUDE http://your.domain.com, just the directory AFTER your domain
base_url = "/timetrex/interface/"

;
;Log directory -- NOTICE: For security reasons, this should always be outside the web server document root.
;
log = "d:\timetrex\log"

;
;Misc storage, for attachments/images -- NOTICE: For security reasons, this should always be outside the web server document root.
;
storage = "d:\timetrex\storage"

;
;Full path and name to the PHP CLI Binary
;
php_cli = "D:\xampp\php\php.exe"



;
; Database connection settings. These can be set from the installer.
;
[database]
type = postgres8

host = 127.0.0.1
database_name = timetrex
user = timetrex
password = 3137Y6St


;
; Email delivery settings.
;
[mail]
;Least setup, deliver email through TimeTrex's email relay via SOAP (HTTP port 80/443)

;Deliver email through remote SMTP server with the following settings.
delivery_method = soap, smtp
smtp_host = smpc.steniel.com.ph
smtp_port = 25
;smtp_username=timetrex@gmail.com
;smtp_password=testpass123

;The domain that emails will be sent from, do not include the "@" or anything before it.
; *ONLY* specify this if "delivery_method" above is "smtp"
;email_domain = smpc.steniel.com.ph

;The local part of the email address that emails will be sent from, do not include the "@" or anything after it.
; *ONLY* specify this if "delivery_method" above is "smtp"
;email_local_part = DoNotReply


;
; Cache settings
;
[cache]
enable = TRUE
;NOTICE: For security reasons, this should always be outside the web server document root.
dir = "D:\timetrex\temp"



[debug]
;Set to false if you're debugging
production = TRUE

enable = FALSE
enable_display = FALSE
buffer_output = TRUE
enable_log = FALSE
verbosity = 10

[other]
default_interface = html5
uuid_seed = 98bf93fc5f23
; Force all clients to use SSL.
force_ssl = FALSE
installer_enabled = FALSE
primary_company_id = 11e86d20-02be-0f40-9629-98bf93fc5f23
disable_auto_upgrade = TRUE

;Specify the URL hostname to be used to access TimeTrex. The BASE_URL specified above will be appended on to this automatically.
; This should be a fully qualified domain name only, do not include http:// or any trailing directories.
hostname = localhost

;ONLY when using a fully qualified hostname specified above, enable CSRF validation for increased security.
;enable_csrf_validation = TRUE

; System Administrators Email address to send critical errors to if necessary. Set to FALSE to disable completely.
system_admin_email = admin@steniel.com.ph

;WARNING: DO NOT CHANGE THIS AFTER YOU HAVE INSTALLED TIMETREX.
;If you do it will cause all your passwords to become invalid,
;and you may lose access to some encrypted data.
salt = b6480f49e7768a042bfeb1a98db57cb6
