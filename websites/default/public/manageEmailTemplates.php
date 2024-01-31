<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s Manage Appraisals';
require '../head.php';
require '../nav.php';
require '../sideNavBar.php';
require '../databaseJoin.php';
?>

<article>
	<div>
		<h3>Email Templates</h3>
<?php 
	//The query below selects all the fields from admins
	$results = $pdo->query('SELECT * FROM emailTemplatesCategory');

	/*This foreach leap is used to look through each admin and display the username, first name,  surname, and email
	//the last two links are used to generate a unique link to edit or delete the admin, the email is used as the 
	identifier to ensure that the right admin is edited or deleted.*/
	foreach ($results as $row) {
		echo  '<li><p>' .  $row['name'] . '</p>';
		echo  '<p><a href = "emailTemplate.php?name='. $row['name'] . '"> Load Template</a></p></li>';
		}
	
	echo '</div>';

require '../foot.php';
?>
