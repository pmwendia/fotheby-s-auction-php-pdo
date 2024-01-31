<?php
    session_start();
    /*The requires are used to generate the templates as well as connect to the database
    These are not stored in the public directory as they user should not be able to directly access these*/
    $title = 'Fotheby\'s';
    require '../databaseJoin.php';
    require '../head.php';
    require '../nav.php';
	require  '../goBack.php';

?>
    <!--This file is used to generate a page for all the articles in the database,
     This is achieved by using links that have the article Id as an identifier, 
     please see index.php to see how this works-->
<article>

<?php
    /*the if statement and the prpare statement are used to select the correct article,
    the article Id from the URL is used to select the matching article within the database*/
    if (isset($_GET['lotReference'])) {

        $selectArt = $pdo->prepare('SELECT * FROM article WHERE lotReference= :lotReference');
        $value = [
            'lotReference' => $_GET['lotReference']
        ];

        $selectArt -> execute($value);

        /*A foreach loop is used to select all the values from within the database record,
        these are then echo'd so they display on the page, a title is shown as well as a image,
        publis date, articles content and the category it resides in */
        foreach($selectArt->fetchAll() as $row) {
            echo '<h1>' . $row['pieceTitle'] . '</h1>' ;
            //a image width and height is added to ensure the image does not overload the template boundaries
            echo '<image src="images/articles/' . $row['imageName'] . '" width = 800px height = 500px >';
	        echo '<p>Lot Number: ' .$row['lotNumber'] . '</p>';
	        echo '<p>Auction Collection: ' .$row['collectionTitle'] . '</p>';
	        echo '<p>Artist: ' .$row['artist'] . '</p>';
            echo '<p>Category: ' .$row['categoryId'] . '</p>';
	        echo '<p>Lot Number: ' .$row['lotNumber'] . '</p>';
            echo '<p>Piece Description: ' .$row['pieceDescription'] . '</p>';
            echo '<p>Date of Production: ' .$row['dateOfProduction'] . '</p>';
            echo '<h3>Auction Details</h3>';
	        echo '<p>Auction Date: ' .$row['auctionDate'] . '</p>';
	        echo '<p>Auction Period: ' .$row['auctionPeriod'] . '</p>';
	        echo '<p>Auction Location: ' .$row['locationId'] . '</p>';
            echo '<h3>Additional Details (If Applicable)</h3>';
            echo '<p>Estimated Price: ' .$row['estimate'] . '</p>';
            echo '<p>Dimensions (CM\'s): ' .$row['dimensions'] . '</p>';
            echo '<p>Framed: ' .$row['framed'] . '</p>';
            echo '<p>Material: ' .$row['material'] . '</p>';
            echo '<p>Weight (KG\'s): ' .$row['pieceWeight'] . '</p>';
            echo '<p>Medium: ' .$row['medium'] . '</p>';
            echo '<p>Piece Type: ' .$row['pieceType'] . '</p>';
        }
    }
?>