<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s Manage Seat Bookings';
require '../head.php';
require '../nav.php';
require '../sideNavBar.php';
require '../databaseJoin.php';
?>

<article>
	<div>
<?php 
	//The query below selects all the fields from admins
	$results = $pdo->query('SELECT * FROM seatBookingRequests');

	/*This foreach leap is used to look through each admin and display the username, first name,  surname, and email
	//the last two links are used to generate a unique link to edit or delete the admin, the email is used as the 
	identifier to ensure that the right admin is edited or deleted.*/
	foreach ($results as $row) {
		echo  '<li><p> Booking ID: ' . $row['bookingID'] . '</p>';
		echo  '<p> Collection Title: ' . $row['collectionTitle'] .'</p>';
		echo  '<p> Location: ' . $row['location'] . '</p>';
		echo  '<p> Client Email: ' . $row['clientEmail'] . '</p>';
		echo  '<p> Considerations: ' . $row['considerations'] . '</p>';
		echo  '<p><a href = "deleteSeatBooking.php?bookingID='. $row['bookingID'] . '"> Delete Request</a></p></li>';
		}
	
	echo '</div>';

require '../foot.php';
?>
