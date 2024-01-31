<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s  - Add User Account';
require '../head.php';
require '../nav.php';

//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['adminloggedin'])) {

    /*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
    require '../sideNavBar.php';

    //When the submit button is clicked all the values entered are added as a new record to the database
    if(isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT INTO users(title, firstname, surname,address, telephone, email, clientStatus, buyerApproved, bankAccount,bankSortCode, password) 
                                       VALUES(:title, :firstname, :surname, :address, :telephone, :email, :clientStatus,:buyerApproved, :bankAccount, :bankSortCode, :password)
    ');
    
    //the hashing statement, hashes and salts the password to make the password more secure
    $hashing = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $hashingSortCode = password_hash($_POST['bankSortCode'], PASSWORD_DEFAULT);
    $hashingBankAcc = password_hash($_POST['bankAccount'], PASSWORD_DEFAULT);

    $values = [
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

    $stmt->execute($values);
    //Once the statement is executed and been successful the user is notified with a message that displays in a P tag
    echo '<p> Your Request Has Been Submitted </p>';
    }
    //if the submit button is not pressed the empty form is displayed
    else {
        echo '<article>
        <form action="addUser.php" method="POST">
            <p>Create a New User Account:</p>
            <label>Title: </label> <input name = "title" type="text" required/>
            <label>First Name: </label> <input name = "firstname" type="text" required/>
            <label>Surname: </label> <input name = "surname" type="text" required/>
            <label>Address: </label> <textarea name = "address" type="text" required> </textarea>
            <label>Telephone: </label> <input name ="telephone" type="text" required/>
            <label>Email Address: </label> <input name = "email" type="text" required />
            <label>Client Status: </label> <select name = "clientStatus" required >';
			
            $results = $pdo->query('SELECT * FROM clientStatus');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($results as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />';
			?>
            <label>Buyer Approved </label> <select name = "buyerApproved" required >';
            <?php
            $results = $pdo->query('SELECT * FROM buyerApproval');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($results as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />';
			?>
            <label>Bank Account: </label> <input name = "bankAccount" type="text" required/>
            <label>Bank Sort Code: </label> <input name ="bankSortCode" type = "text" required>
            <label>Password: </label> <input name ="password" type = "password" required>
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
