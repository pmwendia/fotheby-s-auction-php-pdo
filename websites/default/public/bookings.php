<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Appraisal Requests';
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
	
        if(isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT INTO bookings(pieceTitle, dateOfPiece, condition, estimate, itemDescription. artist) 
                                       VALUES(:pieceTitle,:dateOfPiece,:condition,:estimate,:itemDescription, :artist)
        ');

        $values = [
        'pieceTitle' => $_POST['pieceTitle'],
        'dateOfPiece' => $_POST['dateOfPiece'],
        'condition' => $_POST['condition'],
        'estimate' => $_POST['estimate'],
        'itemDescription' => $_POST['itemDescription'],
        'artist' => $_POST['artist']
        ];
    
        $stmt->execute($values);
        //when executed the user will be given a prompt telling them that they're request has been received
        echo '<p> Your Appraisal Request has been submitted, we\'ll get back to you as soon as we can </p>';
    }
    
    //the else statement is used to generate the empty form when the user hasn't pressed submit
    else {
        echo '<article>
        <form action="bookings.php" method="POST">
            <p>Request an Appraisal :</p>
            <label>Piece Title: </label> <input name = "pieceTitle" type="text" required />
            <label>Date of Piece (If Known): </label> <input name = "dateOfPiece" type="text" />
            <label>Condition: </label> <input name = "condition" type="text" required/>
            <label>Estimate (If known): </label> <input name = "estimate" type="text"/>
            <label>Description: </label> <input name = "itemDescription" type="text" required/>
            <label>Artist: </label> <input name = "artist" type="text" required/>
            <input type="submit" name="submit" value="submit" />
        </form>';  
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