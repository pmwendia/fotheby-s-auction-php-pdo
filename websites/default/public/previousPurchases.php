<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Previous Purchases';
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

		$results = $pdo->prepare('SELECT * FROM sales WHERE clientEmail = :clientEmail');
		
		$values = [
			'clientEmail' => $userEmail['userEmail']
		];

		$results->execute($values);

		foreach ($results as $row) {
			echo  '<li><h3> Purchase Details: </h3></li>';
			echo  '<p>Sale ID: '. $row['idsales'] .'</p>';
			echo  '<p>Lot Number: '. $row['lotNumber'] .'</p>';
			echo  '<p>Piece Title: '. $row['pieceTitle'] .'</p>';
			echo  '<p>Commission Bids: '. $row['commissionBids'] .'</p>';
			echo  '<p>Reserve Price: '. $row['reservePrice'] .'</p>';
			echo  '<p>Sold: '. $row['sold'] .'</p>';
			echo  '<p>Price: '. $row['price'] .'</p>';
			echo  '<p>Auction Comments: '. $row['auctionComments'] .'</p>';
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