<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Home';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';

/*this query selects all articles and then orders them by publish date in descending order, 
it then selects the first 10 as per the briefs requirements
*/
$results = $pdo->query('SELECT * FROM article ORDER BY lotNumber DESC');

/*for each article that is pulled a unique link is made for them which uses it's articleId as the identifier,
a title is show which can be clicked to take you to the full articles page, a smaller version as the image
is shown as the thumbnail as well as the publish date*/
foreach ($results as $row) {
	echo '<li><a class="articleLink" href="articlePages.php?lotReference=' . $row['lotReference'] . '">' .$row['pieceTitle'] . '</a></li>';
	echo '<image src="images/articles/' . $row['imageName'] . '" width = 200px height = 200px >';
	echo '<p>Lot Number: ' .$row['lotNumber'] . '</p>';
	echo '<p>Auction Collection: ' .$row['collectionTitle'] . '</p>';
	echo '<p>Artist: ' .$row['artist'] . '</p>';
	echo '<p>Lot Number: ' .$row['lotNumber'] . '</p>';
	echo '<p>Auction Date: ' .$row['auctionDate'] . '</p>';
	echo '<p>Auction Period: ' .$row['auctionPeriod'] . '</p>';
	echo '<p>Auction Location: ' .$row['locationId'] . '</p>';
	echo '<p>Piece Description: ' .$row['pieceDescription'] . '</p>';
}

require '../foot.php';
?>