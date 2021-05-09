# rainloop-vmail-mysql-change-password
based on [https://github.com/wake/rainloop-plugin-mysql-change-password]

## Description

If you are using Vmail + Postfix + Dovecot + MySQL as mail server with virtual users and want to allow user update their email password directly on Rainloop Wabmail, then this repo may help you. 

## Installation

1. Download the repo to your rainloop plugins folder `[rainloop root]/data/_data_/_default_/plugins/` and name as `mysql-change-password`.
2. Open `MysqlChangePasswordDriver.php` file to fill your MySQL connection info in $config parameter, save.
3. Log-in Rainloop admin and enable `mysql-change-password` plugin.

It works.
