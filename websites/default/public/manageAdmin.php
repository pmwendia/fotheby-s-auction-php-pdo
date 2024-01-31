<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s Manage Admin';
require '../head.php';
require '../nav.php';
require '../sideNavBar.php';
require '../databaseJoin.php';
?>

<article>
	<!--This div is used to give the user a link to create a new admin -->
	<div>
		<a href = "addAdmin.php">Add a New Staff Account</a>
	</div>

	<div>
<?php 
	//The query below selects all the fields from admins
	$results = $pdo->query('SELECT * FROM admin');

	/*This foreach leap is used to look through each admin and display the username, first name,  surname, and email
	//the last two links are used to generate a unique link to edit or delete the admin, the email is used as the 
	identifier to ensure that the right admin is edited or deleted.*/
	foreach ($results as $row) {
		echo  '<li><p> User Name: ' . $row['username'] . '</p>' . '<p> First Name: ' . $row['firstname'] . '</p>'; 
		echo  '<p> Surname: ' . $row['surname'] . '</p>'. '<p> Email: ' .  $row['email'].'</p></li>';
		echo  '<p><a href = "editAdmin.php?email=' . $row['email'] . '">  Edit Admin </a></p>';
		echo  '<p><a href = "deleteAdmin.php?email='. $row['email'] . '"> Delete Admin</a></p>';
		}
	
	echo '</div>';

require '../foot.php';
?>