<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s  - Add Staff Account';
require '../head.php';
require '../nav.php';

//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['adminloggedin'])) {

    /*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
    require '../sideNavBar.php';

    //When the submit button is clicked all the values entered are added as a new record to the database
    if(isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT INTO admin(username, email, password, firstname, surname) 
                                       VALUES(:username,:email,:password, :firstname, :surname)
    ');
    
    //the hashing statement, hashes and salts the password to make the password more secure
    $hashing = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $values = [
    'username' => $_POST['username'],
    'email'=> $_POST['email'],
    'password' => $hashing,
    'firstname' => $_POST['firstname'],
    'surname' => $_POST['surname']
    ];

    $stmt->execute($values);
    //Once the statement is executed and been successful the user is notified with a message that displays in a P tag
    echo '<p> Your Request Has Been Submitted </p>';
    }

    //if the submit button is not pressed the empty form is displayed
    else {
        echo '<article>
        <form action="addAdmin.php" method="POST">
            <p>Create a New Staff Account:</p>

            <label>First Name</label> <input name = "firstname" type="text" required/>
            <label>Surname</label> <input name = "surname" type="text" required/>
            <label>User Name</label> <input name = "username" type="text" required/>
            <label>Email Address</label> <input name = "email" type="text" required />
            <label>Password</label> <input name = "password" type = "password" required>
            <input type="submit" name="submit" value="Submit" />
        </form>';
    }
}

//if an admin is not logged in then error messages are echo'd asking for a admin log in to continue
else {
    echo '<h3>You need to be logged into a Staff Account to access this page</h3>';
    echo '<h3>Please Log in as Staff to try again</h3>';
}
require '../foot.php';
?>
