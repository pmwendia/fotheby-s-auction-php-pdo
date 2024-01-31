<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s Manage Users';
require '../head.php';
require '../nav.php';
require '../sideNavBar.php';
require '../databaseJoin.php';
?>

<article>
	<!--This div is used to give the user a link to create a new admin -->
	<div>
		<a href = "addUser.php">Add a New User</a>
	</div>

	<div>
<?php 
	//The query below selects all the fields from admins
	$results = $pdo->query('SELECT * FROM users');

	/*This foreach leap is used to look through each admin and display the username, first name,  surname, and email
	//the last two links are used to generate a unique link to edit or delete the admin, the email is used as the 
	identifier to ensure that the right admin is edited or deleted.*/
	foreach ($results as $row) {
		echo  '<li><p> First Name: ' . $row['firstname'] . '</p>'; 
		echo  '<p> Surname: ' . $row['surname'] . '</p>'. '<p> Email: ' .  $row['email'].'</p></li>';
		echo  '<p><a href = "editUser.php?id=' . $row['id'] . '">  Edit User </a></p>';
		echo  '<p><a href = "deleteUser.php?id='. $row['id'] . '"> Delete User</a></p>';
		}
	
	echo '</div>';

require '../foot.php';
?>