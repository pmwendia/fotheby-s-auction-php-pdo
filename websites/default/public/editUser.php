<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s- Edit User Account';
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
    	$stmt = $pdo-> prepare('UPDATE users SET title = :title, firstname = :firstname, surname = :surname, 
		address = :address, telephone = :telephone, email = :email, clientStatus = :clientStatus, buyerApproved = :buyerApproved,
		bankAccount = :bankAccount, bankSortCode = :bankSortCode, password = :password
							WHERE id = :id');
		
		$hashing = password_hash($_POST['password'], PASSWORD_DEFAULT);
    	$hashingSortCode = password_hash($_POST['bankSortCode'], PASSWORD_DEFAULT);
    	$hashingBankAcc = password_hash($_POST['bankAccount'], PASSWORD_DEFAULT);

    	$value = [
		'id' => $_POST['id'],
		'title' => $_POST['title'],
        'firstname' => $_POST['firstname'],
        'surname' => $_POST['surname'],
        'address' => $_POST['address'],
        'telephone' => $_POST['telephone'],
        'email'=> $_POST['email'],
        'clientStatus'=> $_POST['clientStatus'],
        'buyerApproved'=> $_POST['buyerApproved'],
        'bankAccount' => $hashingBankAcc,
        'bankSortCode' => $hashingSortCode,
        'password' => $hashing
		];
    	$stmt ->execute($value);
		//an echo statement is used so the user knows that the changes to the admin have been made
        echo '<p>User Edited</p>';
	}
	
	//if the submit button is not pressed then this code fetches all the values from the selecte record
	else if(isset($_GET['id'])) {

	$selectUser = $pdo->prepare('SELECT * FROM users WHERE id = :id');

    	$value = [
			'id' => $_GET['id'],
    	];

    $selectUser -> execute($value);
    $user = $selectUser->fetch();
     
?>
	<!--This displays the form needed to edit the admins, 
	the php echo statements are used to display the original values for that admin within the database,
	without these the form would be empty -->
	<form action="editUser.php" method= "POST">
    	<p>Edit User Details:</p>

		<input type = "hidden" name = "id" value = "<?php echo $user['id']; ?>" />
		<label>Title: </label>
		<input type="text" name = "title" value = "<?php echo $user['title']; ?>" required />
		<label>Firstname: </label>
		<input type="text" name = "firstname" value = "<?php echo $user['firstname']; ?>" required />
		<label>Surname: </label>
		<input type="text" name = "surname" value = "<?php echo $user['surname']; ?>" required />
		<label>Address: : </label>
		<input type="text" name = "address" value = "<?php echo $user['address']; ?>" required />
		<label>Telephone: </label>
		<input type="text" name = "telephone" value = "<?php echo $user['telephone']; ?>" required />
		<label>Email: </label>
		<input type="text" name = "email" value = "<?php echo $user['email']; ?>" required />
		<label>Client Status: </label> <select name = "clientStatusId" required >
			<?php
            $results = $pdo->query('SELECT * FROM clientStatus');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($results as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />';
			?>
            <label>Buyer Approved </label> <select name = "buyerApprovedId" required >';
            <?php
            $results = $pdo->query('SELECT * FROM buyerApproval');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($results as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />';
			?>
	
		<input type="hidden" name = "bankAccount" value = "<?php echo $user['bankAccount']; ?>" />
		<input type="hidden" name = "bankSortCode" value = "<?php echo $user['bankSortCode']; ?>"/>
		<input type="hidden" name = "password" value = "<?php echo $user['password']; ?>" />
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