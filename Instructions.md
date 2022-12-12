# Instructions
## Database Config
### 1. Place the code directory in your "htdocs" folder of your "xampp"  directory then start Apache and MySQL servers through the XAMPP Control Panel.
### 2. Type in "localhost" in your web browser. This will take you to your Apache server dashboard.
### 3. In the top right-hand side of the webpage, select "phpMyAdmin" and log in to your account.
### 4. Click "New" on the left-handle side of the webpage to create a new database.
### 5. Name this database "foodorderdb".
### 6. Head to the tab titled "SQL" which is located at the top of the webpage.
### 7. Input all the code within the file "foodorderdb.sql" in the first large text box then press "Go" at the bottom of the webpage.
### 8. The SQL database is now structured and filled with data. In order to connect to the database with the code, change the data within "config/connection-details.txt" to match your username and password you used to sign into phpMyAdmin. The data in the text file is formatted as follows: "host,username,password,database".
### 9. The text file is read by "util/db.php" so that its data is used to connect to the database once the code is run. With all the steps completed, input "localhost/foodorderapp/index.php" into your web browser and the website will be displayed.