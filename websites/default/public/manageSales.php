<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s Manage Sales';
require '../head.php';
require '../nav.php';
require '../sideNavBar.php';
require '../databaseJoin.php';
?>

<article>
	<!--This div is used to give the user a link to create a new admin -->
	<div>
		<a href = "addSales.php">Add a New Sale</a>
	</div>

	<div>
<?php 
	//The query below selects all the fields from admins
	$results = $pdo->query('SELECT * FROM sales');

	/*This foreach leap is used to look through each admin and display the username, first name,  surname, and email
	//the last two links are used to generate a unique link to edit or delete the admin, the email is used as the 
	identifier to ensure that the right admin is edited or deleted.*/
	foreach ($results as $row) {
		echo  '<li><p>Lot Number: ' . $row['lotNumber'] . '</p>' . '<p> Piece Title: ' . $row['pieceTitle'] . '</p>'; 
		echo  '<p> Commission Bids: ' . $row['commissionBids'] . '</p>'. '<p> Reserve Price: ' .  $row['reservePrice'].'</p></li>';
		echo  '<p> Sold: ' . $row['sold'] . '</p>'. '<p> Price: ' .  $row['price'].'</p></li>';
		echo  '<p> Client Email: ' . $row['clientEmail'] . '</p>'. '<p> Auction Comments: ' .  $row['auctionComments'].'</p></li>';
		echo  '<p><a href = "editSales.php?idsales=' . $row['idsales'] . '">  Edit Sales </a></p>';
		echo  '<p><a href = "deleteSales.php?idsales='. $row['idsales'] . '"> Delete Sales</a></p>';
		}
	echo '</div>';

require '../foot.php';
?>