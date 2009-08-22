
Database:
- Backups to /bkup/websites/dbdata
- Test backups to /bkup/websites/dbdata/test

Production Database Backups:
- Log in on www.dredom.com/admin
- Select jenandjane.com
- Select Databases
- Select jjdb
- Look on top line, select Webadmin
- Export with drop/create tables, data.
 
Database Conversion:
1. Back up database with myPhpAdmin: file name template %Y%m%d%H%M%S-__DB__
2. Change permissions on jewel/<site> directory to rwx.
3. Change permissions on jewel/<site>/images.config to rwx.
2. Log in with /jjadmin/login.php
2. /jjadmin/register_new_arm_items.php
3. /jjadmin/convert_arm_descriptions.php
4. Verify and fix descriptions, prices.
5. Back up database.