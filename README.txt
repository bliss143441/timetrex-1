TimeTrex can be easily installed on both Windows and Linux based operating systems:

Windows
(or newer)	Linux
(or newer)
Windows 7	Ubuntu 14.04 / Debian 8
Windows Server 2008	CentOS 7 / RHEL 6 / Fedora 24

System Requirements
Minimum	Recommended
2.0GHZ or faster dual-core CPU.
2GB or more of memory.
1GB or more of disk space.
2.0GHZ or faster quad-core CPU.
4GB or more of memory.
10GB or more of disk space.

Windows:
How to Install TimeTrex on WindowsHome / Installation Help
Installing TimeTrex on Windows or Windows Server:
Download the TimeTrex installer to your computer.
Run the downloaded executable file by double clicking on it.
Follow the on screen instructions that will walk you through the installation wizard.


Linux:
How to Install TimeTrex on LinuxHome / Installation Help
TimeTrex can be installed on Ubuntu / Debian Linux
using either a .DEB or .ZIP file.

Installing TimeTrex from the .DEB file:
Download the TimeTrex .deb package to your computer.
Move the package into the apt archives directory:
mv <TimeTrex_Package>.deb /var/cache/apt/archives/<TimeTrex_Package>.deb
Install the package:
apt-get install /var/cache/apt/archives/<TimeTrex_Package>.deb
During the installation you will be prompted to configure a database that TimeTrex will use, choose Yes.
Point your web browser to the TimeTrex web-based installer:
http://<web server address>/<timetrex directory>/interface/install/install.php
ie: http://www.my-company.com/timetrex/interface/install/install.php
Follow the on screen instructions that will walk you through the installation wizard.

Installing TimeTrex from the .ZIP file:
Install the prerequisite packages:
apt-get install apache2 libapache2-mod-php php php7.0-cgi php7.0-cli php7.0-pgsql php7.0-pspell php7.0-gd php7.0-gettext php7.0-imap php7.0-intl php7.0-json php7.0-soap php7.0-zip php7.0-mcrypt php7.0-curl php7.0-ldap php7.0-xml php7.0-xsl php7.0-mbstring php7.0-bcmath php7.0-process postgresql
Restart Apache after all packages are installed:
service apache2 restart
Download the TimeTrex .ZIP file to your computer.
Unzip the TimeTrex .ZIP file to the root web directory:
unzip <TimeTrex-installer>.zip -d /var/www/html/
Rename the unzipped directory:
mv /var/www/html/TimeTrex_v<version>/ /var/www/html/timetrex
Rename the TimeTrex.ini.php file:
mv /var/www/html/timetrex/timetrex.ini.php-example_linux /var/www/html/timetrex/timetrex.ini.php
Edit the timetrex.ini.php and confirm all paths are correct: 
nano /var/www/html/timetrex/timetrex.ini.php
Note: Make sure the log directory and storage paths are created and that Apache can write to them.

If you are using the default directories you can use these commands:
mkdir -p /var/timetrex/storage
mkdir /var/log/timetrex
chgrp -R www-data /var/timetrex/
chmod 775 -R /var/timetrex
chgrp www-data /var/log/timetrex/
chmod 775 /var/log/timetrex
Give Apache access to the timetrex web directory:
chgrp www-data -R /var/www/html/timetrex/
Create a user and database for TimeTrex to use:
sudo su postgres
psql
CREATE USER timetrex WITH CREATEDB CREATEROLE LOGIN PASSWORD 'password_here';
CREATE DATABASE timetrex;
\q
Point your web browser to the TimeTrex web-based installer:
http://<web server address>/<timetrex directory>/interface/install/install.php
ie: http://www.my-company.com/timetrex/interface/install/install.php
Follow the on screen instructions that will walk you through the installation wizard.


