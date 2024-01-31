<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s- Edit Staff Account';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';


//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['adminloggedin'])) {

	/*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
	require '../sideNavBar.php';

	//When the submit button is pressed all the current values in the form replace the old ones 
	if (isset($_POST['submit'])) {
    	$stmt = $pdo-> prepare('UPDATE admin SET username = :username, firstname = :firstname, surname = :surname, email = :email 
							WHERE email = :email');
    	unset($_POST['submit']);
    	$stmt ->execute($_POST);
		//an echo statement is used so the user knows that the changes to the admin have been made
        echo '<p>Admin Edited</p>';
	}
	
	//if the submit button is not pressed then this code fetches all the values from the selecte record
	else if(isset($_GET['email'])) {

	$selectAdmin = $pdo->prepare('SELECT * FROM admin WHERE email = :email');

    	$value = [
			'email' => $_GET['email'],
    	];

    $selectAdmin -> execute($value);
    $admin = $selectAdmin->fetch();
     
?>
	<!--This displays the form needed to edit the admins, 
	the php echo statements are used to display the original values for that admin within the database,
	without these the form would be empty -->
	<form action="editAdmin.php" method= "POST">
    	<p>Edit Admin Details:</p>

		<label>Username</label>
		<input type="text" name = "username" value = "<?php echo $admin['username']; ?>" required />
		<label>Firstname</label>
		<input type="text" name = "firstname" value = "<?php echo $admin['firstname']; ?>" required />
		<label>Surname</label>
		<input type="text" name = "surname" value = "<?php echo $admin['surname']; ?>" required />
		<label>Email</label>
		<input type="text" name = "email" value = "<?php echo $admin['email']; ?>" required />
		<input type="submit" name="submit" value="Submit" />
	</form>


<?php
	}
}
//if an admin is not logged in then error messages are echo'd asking for a admin log in to continue
else {
    echo '<h3>You need to be logged into a Staff Account to access this page</h3>';
    echo '<h3>Please Log in as Staff to try again</h3>';
}
require '../foot.php';
?>