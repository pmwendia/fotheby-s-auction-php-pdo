<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Seat Booking Request';
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
        $stmt = $pdo->prepare('INSERT INTO seatBookingRequests(collectionTitle, location, clientEmail, considerations) 
                                           VALUES(:collectionTitle, :location, :clientEmail, :considerations)
        ');

        $values = [
        'collectionTitle' => $_POST['collectionTitle'],
        'location'=> $_POST['location'],
        'clientEmail'=> $_POST['clientEmail'],
        'considerations'=> $_POST['considerations']
        ];
    
        $stmt->execute($values);
        //when executed the user will be given a prompt telling them that they're request has been received
        echo '<p> Your Seat Booking has been submitted, we\'ll get back to you as soon as we can </p>';
    }
    
    //the else statement is used to generate the empty form when the user hasn't pressed submit
    else {
        echo '<article>
        <form action="seatBookings.php" method="POST">
            <p>Request an Auction Seat Booking:</p>
        
            <label>Collection Title: </label> <select name = "collectionTitle" required />';
			$results = $pdo->query('SELECT * FROM collections');
				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($results as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
                echo '<input type="hidden" name="submit" value="Submit" />';
                ?>
            <label>Location: </label> <select name = "location" required />
            <?php
			$resultsLoc = $pdo->query('SELECT * FROM locations');
				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($resultsLoc as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />
            <label>Email Address: </label> <input name = "clientEmail" type="text" required />
            <label>Considerations: </label> <input name = "considerations" type="text"/>
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