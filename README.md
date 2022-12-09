# INF_653_Final
How to Import sql into phpMyAdmin
1. Create a database and name it as offwind 
2. Click on the Import at the top of the page and Choose the offwind.sql file then click Import button. 

To connect to the database with php: 
1. Import the offwind.sql by into phpMyAdmin/mamp
2. Move the cloned project into the xampp/htdocs folder in order to run on the local host. 
3. Configure the connection to the database in config folder, click on the constants.php. 
4. Configure the change for the 5 defined methods 
define('SITEURL', 'TheSiteUrlonYourLocalHost'); Example: ('SITEURL', 'http://localhost:8080/INF_653_Final/offwind'); 

*You can leave the other 4 methods as it is as follows: *'

define('LOCALHOST', 'localhost');

define('DB_USERNAME', 'root');

define('DB_PASSWORD', ''); 

define('DB_NAME', 'offwind'); 
 
