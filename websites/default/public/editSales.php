<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s- Edit Sales Record';
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
    	$stmt = $pdo-> prepare('UPDATE sales SET lotNumber = :lotNumber, pieceTitle = :pieceTitle, commissionBids = :commissionBids,
		 reservePrice = :reservePrice, sold = :sold, price = :price, clientEmail = :clientEmail, auctionComments = :auctionComments
							WHERE idsales = :idsales');
		$value = [
			'idsales' => $_POST['idsales'],
			'lotNumber' => $_POST['lotNumber'],
    		'pieceTitle'=> $_POST['pieceTitle'],
    		'commissionBids' => $_POST['commissionBids'] ,
    		'reservePrice' => $_POST['reservePrice'],
    		'sold' => $_POST['sold'],
    		'price' => $_POST['price'],
    		'clientEmail' => $_POST['clientEmail'],
    		'auctionComments' => $_POST['auctionComments']
		];

    	$stmt ->execute($value);
    	
		//an echo statement is used so the user knows that the changes to the admin have been made
        echo '<p>Sales Record Updated</p>';
	}
	
	//if the submit button is not pressed then this code fetches all the values from the selecte record
	else if(isset($_GET['idsales'])) {

	$selectSales = $pdo->prepare('SELECT * FROM sales WHERE idsales = :idsales');

    $value = [
		'idsales' => $_GET['idsales'],
		
		];
    $selectSales ->execute($value);
    $sales = $selectSales->fetch();


?>
	<!--This displays the form needed to edit the admins, 
	the php echo statements are used to display the original values for that admin within the database,
	without these the form would be empty -->
	<form action="editSales.php" method= "POST" enctype = "multipart/form-data">
    	<p>Edit Sales Record:</p>
		<input type = "hidden" name = "idsales" value = "<?php echo $sales['idsales']; ?>" required />
		<label>Lot Number: </label>
		<input type="text" name = "lotNumber" value = "<?php echo $sales['lotNumber']; ?>" required />
		<label>Piece Title: </label>
		<input type="text" name = "pieceTitle" value = "<?php echo $sales['pieceTitle']; ?>" required />
		<label>Commission Bids: </label>
		<input type="text" name = "commissionBids" value = "<?php echo $sales['commissionBids']; ?>"/>
		<label>Reserve Price: </label>
		<input type="text" name = "reservePrice" value = "<?php echo $sales['reservePrice']; ?>"/>
		<label>Sold: </label>
		<input type="text" name = "sold" value = "<?php echo $sales['sold']; ?>"/>
		<label>Price: </label>
		<input type="text" name = "price" value = "<?php echo $sales['price']; ?>" required/>
		<label>Client Number: </label>
		<input type="text" name = "clientEmail" value = "<?php echo $sales['clientEmail']; ?>" required/>
		<label>Auction Comments: </label>
		<textarea name = "auctionComments"><?php echo $sales['auctionComments']; ?></textarea>
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