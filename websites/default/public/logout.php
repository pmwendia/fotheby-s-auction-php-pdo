<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Log Out';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';

/*The unsets end the sessions for the users and admin when log out is clicked
This stops the user from being to access functions hidden behind logins,
such as adding comments or viewing the admin hub*/
unset($_SESSION['loggedin']);
unset($_SESSION['adminloggedin']);
echo '<p>You Have Been Logged Out</p>';

require '../foot.php';
?>