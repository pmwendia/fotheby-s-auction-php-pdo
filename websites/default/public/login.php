<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Login';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';

echo '<article>';

/*If the submit button is pressed then the email entered is compared to the database and its stored emails 
to find a match,
this first isset block is to search for a normal user in the user table in the database*/ 
if(isset($_POST['submit'])) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');

    $values = [
        'email' => $_POST['email'],
    ];

    $stmt->execute($values);

    //checks whether there are any records in the database, if 0 then nothin will happen due to the > operator
    if($stmt->rowCount() > 0) {
        $user = $stmt ->fetch();

        //below compares the password entered to the ones stored, if it finds a match then a login session is started
        if(password_verify($_POST['password'], $user['password'])) {
            $_SESSION['loggedin'] = $user['email'];
            //displays a message letting the user know they are logged in
            echo '<p>You have been logged in </p>';
        }
    else {
        //lets the user know that the login was unsuccessful 
        echo '<p>Sorry, Incorrect Username or Password</p>';
        }
    }   
}

/*the code below is mostly the same as the isset above, however this looks through the admin table to find 
a login match for a admin instead of a user */
if(isset($_POST['submit'])) {
    $stmt = $pdo->prepare('SELECT * FROM admin WHERE email = :email');

    $values = [
        'email' => $_POST['email'],
    ];

    $stmt->execute($values);

    if($stmt->rowCount() > 0) {
        $admin = $stmt ->fetch();

        if(password_verify($_POST['password'], $admin['password'])) {
            unset($_SESSION['loggedin']);
            $_SESSION['adminloggedin'] = $admin['email'];
            echo '<p>You have been logged in </p>';
        }
    else {
        echo '<p>Sorry, Incorrect Username or Password</p>';
        }
    }   
}

//if submit is not pressed then the empty form is displayed for the user to enter thier login details
else { 
?>
    <form action="login.php" method="POST" >
    <p>Log into your account:</p>

    <label>Email</label> <input type="text" name = "email" />
    <label>Password</label> <input type="password" name = "password" />

    <input type="submit" name="submit" value="Log In" />
</form>
</article>

<?php
}
require '../foot.php';
?>