<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - User Hub';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';

//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['loggedin'])) {

	/*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
	require '../sideNavBarUsers.php';
?>
<article>
	<div>
		<?php
	
		$userEmail = ['userEmail' => $_SESSION['loggedin']];

		$results = $pdo->prepare('SELECT * FROM users WHERE email = :email');
		
		$values = [
			'email' => $userEmail['userEmail']
		];

		$results->execute($values);

		foreach ($results as $row) {
			echo  '<li><h3> User Details: </h3></li>';
			echo  '<p>User ID: '. $row['id'] .'</p>';
			echo  '<p>Title: '. $row['title'] .'</p>';
			echo  '<p>First Name: '. $row['firstname'] .'</p>';
			echo  '<p>Surname: '. $row['surname'] .'</p>';
			echo  '<p>Address: '. $row['address'] .'</p>';
			echo  '<p>Telephone: '. $row['telephone'] .'</p>';
			echo  '<p>Email: '. $row['email'] .'</p>';
			echo  '<p>Client Status: '. $row['clientStatus'] .'</p>';
			echo  '<p>Buyer Approved: '. $row['buyerApproved'] .'</p>';
		}

		?>
	</div>
<?php
//if an admin is not logged in then error messages are echo'd asking for a admin log in to continue
	}
else {
	echo '<h3>You need to be logged into a User Account to access this page</h3>';
    echo '<h3>Please Log into your account to try again</h3>';
	}
require '../foot.php';
?>