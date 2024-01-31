<?php
    session_start();
    /*The requires are used to generate the templates as well as connect to the database
    These are not stored in the public directory as they user should not be able to directly access these*/
    $title = 'Fotheby\'s';
    require '../databaseJoin.php';
    require '../head.php';
    require '../nav.php';
    require '../goBack.php';

    /*This file is used to generate a page for all the categories in the database*/

    /*The category Id from the URL is fetched when the category is clicked */
    if (isset($_GET['locationId'])) {

        //the category Id from the URL is fetched and used as the header for the page
        echo '<h3> Auction Location: ' . $_GET['locationId'] . ' </h3>';

        /*this prepare statemnt is used to match the URL to the Id in the database, 
        this is used to ensure the correct category is retrieved */
        $selectLoc = $pdo->prepare('SELECT * FROM article WHERE locationId= :locationId');
        $value = [
            'locationId' => $_GET['locationId'],
        ];

        $selectLoc -> execute($value);

        /*For the selected category all values about that category are retrieved, 
        the title uses a link that when clicked takes the user to the correct article page, 
        the correct page is identified using the article Id. 
        The title and the publish date are also displayed */
        foreach($selectLoc->fetchAll() as $row) {
            echo '<a class="articleLink" href="articlePages.php?lotReference=' . $row['lotReference'] . '">' 
            . '<p>'.$row['pieceTitle'] . '</a>' .' Lot Number: '.$row['lotNumber'] . '</p>';
            echo '<image src="images/articles/' . $row['imageName'] . '" width = 200px height = 200px >';
	        echo '<p>Auction Collection ' .$row['collectionTitle'] . '</p>';
	        echo '<p>Artist ' .$row['artist'] . '</p>';
	        echo '<p>Lot Number ' .$row['lotNumber'] . '</p>';
	        echo '<p>Auction Date ' .$row['auctionDate'] . '</p>';
	        echo '<p>Auction Period ' .$row['auctionPeriod'] . '</p>';
	        echo '<p>Auction Location ' .$row['locationId'] . '</p>';
	        echo '<p>Piece Description ' .$row['pieceDescription'] . '</p>';
        }
       }
    require '../foot.php';
?>
