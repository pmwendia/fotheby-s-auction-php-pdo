<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Register';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';

/*If submit is clicked then the asccount details added by the user are added to the users table  */
if(isset($_POST['submit'])) {
    $stmt = $pdo->prepare('INSERT INTO userRequests(title, firstname,surname,telephone, email, address, password) 
                                       VALUES(:title, :firstname, :surname, :telephone, :email, :address, :password)
    ');

    //the password entered is hashed and salted using the code belwo
    $hashing = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $values = [
    'title' => $_POST['title'],
    'firstname'=> $_POST['firstname'],
    'surname'=> $_POST['surname'],
    'telephone'=> $_POST['telephone'],
    'email'=> $_POST['email'],
    'address'=> $_POST['address'],
    'password' => $hashing,
    ];

    $stmt->execute($values);
    //when executed the user will be given a prompt telling them that they're request has been received
    echo '<p> Your Request Has Been Submitted </p>';
}

//the else statement is used to generate the empty form when the user hasn't pressed submit
else {
    echo '<article>
    <form action="register.php" method="POST">
        <p>Register for an Account:</p>
    
        <label>Title: </label> <input name = "title" type="text" required/>
        <label>First Name: </label> <input name = "firstname" type="text" required />
        <label>Surname: </label> <input name = "surname" type="text" required />
        <label>Telephone: </label> <input name = "telephone" type="text" required />
        <label>Email: </label> <input name = "email" type="text" required />
        <label>Address: </label> <input name = "address" type="text" required />
        <label>Password: </label> <input name = "password" type = "password" required>
        <input type="submit" name="submit" value="submit" />
    </form>';  
}

require '../foot.php';
?>