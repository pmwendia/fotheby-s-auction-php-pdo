<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s  - Add Sales Record';
require '../head.php';
require '../nav.php';

//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['adminloggedin'])) {

    /*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
    require '../sideNavBar.php';

    //When the submit button is clicked all the values entered are added as a new record to the database
    if(isset($_POST['submit'])) {
        $stmt = $pdo->prepare('INSERT INTO sales(lotNumber, pieceTitle, commissionBids, reservePrice, sold, price, clientEmail, auctionComments  ) 
                                       VALUES(:lotNumber,:pieceTitle, :commissionBids, :reservePrice, :sold, :price, :clientEmail, :auctionComments)
    ');
    
    $values = [
    'lotNumber' => $_POST['lotNumber'],
    'pieceTitle'=> $_POST['pieceTitle'],
    'commissionBids' => $_POST['commissionBids'] ,
    'reservePrice' => $_POST['reservePrice'],
    'sold' => $_POST['sold'],
    'price' => $_POST['price'],
    'clientEmail' => $_POST['clientEmail'],
    'auctionComments' => $_POST['auctionComments']
    ];

    $stmt->execute($values);
    //Once the statement is executed and been successful the user is notified with a message that displays in a P tag
    echo '<p> Your Sales Receipt Has Been Submitted </p>';
    }

    //if the submit button is not pressed the empty form is displayed
    else {
        echo '<article>
        <form action="addSales.php" method="POST">
            <p>Create a New Sales Record:</p>

            <label>Lot Number</label> <input name = "lotNumber" type="text" required/>
            <label>Piece Title</label> <input name = "pieceTitle" type="text" required/>
            <label>Commission Bids</label> <input name = "commissionBids" type="text" />
            <label>Reserve Price</label> <input name = "reservePrice" type="text" />
            <label>Sold </label><select name = "sold" required >';
            $results = $pdo->query('SELECT * FROM salesYesNo');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($results as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />
            <label>Price</label> <input name = "price" type="text" required/>
            <label>Client Email</label> <input name = "clientEmail" type="text" required/>
            <label>Auction Comments</label> <textarea name = "auctionComments"> </textarea>
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
