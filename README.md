Farsi BigBlueButton Control Panel
to install:
1. clone this codes
2. create a database and user an insert the database.sql file in database
3. open /incl/dbconn.php and enter your DB porperties
4. open /incl/functions.php and enter your bigbluebutton url, endpoint and secret in variables and also set $surl to your web root address with / at end
5. create a user by this SQL, do not forgot to MD5 your password befor inserting

INSERT INTO `admins` (`name`, `fname`, `email`, `pass`, `role`, `visible`) VALUES
('admin', 'user', 'admin@gmail.com', 'YOUR_MD5_PASSWORD', 2, 1);

6. open your web root directory and login with your user, if everything ok, delete database.php and start using panel
