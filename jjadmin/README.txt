
Database:
- Prod backups with myPhpAdmin: file name template %Y%m%d%H%M%S-__DB__
- Prod Backups to /bkup/websites/dbdata
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


=== Edit image names to item names. ===

1. Used to use Picasa to convert images. Now use Photoshop.
2. Edit filenames to the item number -sml 154px x 107px, -lrg 640px x 430px


8. FTP img files to jenandjane.com/img
9. Update neck/arm/ear/ankle show.config files with item names.
10. FTP show.config files to jenandjane.com
11. http://www.jenandjane.com/jjadmin/register_new_ear_items.php
12. http://www.jenandjane.com/jjadmin/generate_config.php?site=ear
13. Test

jjadmin/login.php jenjane

Note: Editor is notepad++


=== FTP ===
 ftp -n -s:do.ftp jenandjane.com

 contents...

 user <username> <password>
 cd httpdocs
 cd img
 put file1.jpg
 quit