<h3>Installation Guide</h3>

Otakool – Anime store

Project - Group III – T1.2109.E0
•	Unzip Otakool.zip and open it up in IDE of choice (VSCode recommended)
•	Open file environment.env to setup connect database mysql.
o	DB_CONNECTION=mysql
o	DB_HOST=127.0.0.1
o	DB_PORT=3306
o	DB_DATABASE=otakool
o	DB_USERNAME=root
o	DB_PASSWORD=
•	Change DB_USERNAME and DB_PASSWORD if you have anything different in file xampp\phpMyAdmin\config.inc.php (default is ‘root’ and password is empty)
	 
•	Go to phpMyAdmin create Database name like DB_DATABASE (Example: otakool)


Open XAMPP and make sure Apache and MySQL are started and running
Open Otakool-demo in terminal (in VSCode recommended) 
Run command > php artisan db:seed
This will generate a main admin base on file (database\factories\AdminFactory.php):
Run command > php artisan serve 
 
 When setup success access link http://127.0.0.1:8000 (or if you are using VSCode: Ctrl + left Click the link shown)

Go to 0-documents for more information
