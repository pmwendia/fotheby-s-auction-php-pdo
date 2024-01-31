<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s- Edit Article';
require '../head.php';
require '../nav.php'; 
require '../databaseJoin.php';

echo '<article>';

//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['adminloggedin'])) {

	/*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
	require '../sideNavBar.php';

	//if the submit button is clicked then the prepare statment updates all the fields in the form and replaces the old ones
	if (isset($_POST['submit'])) {


		//Two sources were used for adding the images
		//Code for adding the images from https://www.geeksforgeeks.org/how-to-upload-image-into-database-and-display-it-using-php/
		//Code for adding the images from https://www.codegrepper.com/code-examples/php/php+upload+image+to+database
			
		//the following three statments are used to get the article image name and location updated
		$imageName = $_FILES['imageName']['name'];
		$tempName = $_FILES['imageName']['tmp_name'];
		$folder = "images/articles/" .$imageName;

    	$stmt = $pdo-> prepare('UPDATE article SET pieceTitle = :pieceTitle, imageName = :imageName, pieceDescription = :pieceDescription, categoryId = :categoryId, auctionDate = :auctionDate,
		collectionTitle = :collectionTitle, lotNumber = :lotNumber, dateOfProduction = :dateOfProduction, estimate = :estimate, dimensions = :dimensions, 
		auctionPeriod = :auctionPeriod, framed = :framed, artist = :artist, material = :material, pieceWeight = :pieceWeight, medium = :medium, pieceType = :pieceType, locationId = :locationId
							WHERE lotReference = :lotReference');
	
		$value = [
			'lotReference' => $_POST['lotReference'],
			'pieceTitle' => $_POST['pieceTitle'],
			'pieceDescription' => $_POST['pieceDescription'],
			'categoryId' => $_POST['categoryId'],
			'auctionDate' => $_POST['auctionDate'],
			'imageName'=> $imageName,
			'collectionTitle' => $_POST['collectionTitle'],
			'lotNumber' => $_POST['lotNumber'],
			'dateOfProduction' => $_POST['dateOfProduction'],
			'estimate' => $_POST['estimate'],
			'dimensions' => $_POST['dimensions'],
			'auctionPeriod' => $_POST['auctionPeriod'],
			'framed' => $_POST['framed'],
			'artist' => $_POST['artist'],
			'material' => $_POST['material'],
			'pieceWeight' => $_POST['pieceWeight'],
			'medium' => $_POST['medium'],
			'pieceType' => $_POST['pieceType'],
			'locationId' => $_POST['locationId']
		];

		//this is needed in order to move the image file to the right folder and make it findable by the system
		move_uploaded_file($tempName, $folder);

    	$stmt ->execute($value);
		
		//this is to let the user know that their changes have been made
        echo '<p>Auction Lot Edited</p>';
	}
	
	/*if the submit is not pressed then this selects the relevant article using the articleId
	as well as selecting an empty form*/
	else if(isset($_GET['lotReference'])) {

	$selectArticleFields = $pdo->prepare('SELECT * FROM article WHERE lotReference = :lotReference');
    	$value = [
            'lotReference' => $_GET['lotReference']
    	];

        $selectArticleFields -> execute($value);
        $article = $selectArticleFields->fetch();
        
?>
	<!--This displays the form needed to edit the admins, 
	the php echo statements are used to display the original values for that admin within the database,
	without these the form would be empty -->
	<form action="editArticle.php" method= "POST" enctype = "multipart/form-data">
    	<p>Edit Auction Lot:</p>

		<label>Piece Title</label>
		
		<!--This value is hidden as the user should not be able to see any articleIds and cannot edit this,
		however this has to be on the form in order to match the database, if it does not match then the updates
		will not be added to the database -->
		<input type = "hidden" name = "lotReference" value = "<?php echo $article['lotReference']; ?>" required />
		
		<input type="text" name = "pieceTitle" value = "<?php echo $article['pieceTitle']; ?>" required />

		<label>Collection Title</label> <select name = "collectionTitle" required >
			<?php $resultsCol = $pdo->query('SELECT * FROM collections');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($resultsCol as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />';
			?>
		<label>Lot Number</label>
		<input type="text" name = "lotNumber" value = "<?php echo $article['lotNumber']; ?>" required />

		<label>Artist</label>
		<input type="text" name = "artist" value = "<?php echo $article['artist']; ?>" required />

		<label>Estimate</label>
		<input type="text" name = "estimate" value = "<?php echo $article['estimate']; ?>" required />

		<label>Dimensions</label>
		<input type="text" name = "dimensions" value = "<?php echo $article['dimensions']; ?>" required />

		<label>Date of Production</label>
		<input type="text" name = "dateOfProduction" value = "<?php echo $article['dateOfProduction']; ?>" required />

		<label>Auction Date</label>
		<input type="text" name = "auctionDate" value = "<?php echo $article['auctionDate']; ?>" required />

		<label>Auction Period</label><select name = "auctionPeriods" required >
			<?php $resultsAP = $pdo->query('SELECT * FROM auctionPeriods');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($resultsAP as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />';
			?>
		<label>Framed</label>
		<input type="text" name = "framed" value = "<?php echo $article['framed']; ?>" required />

		<label>Material</label>
		<input type="text" name = "material" value = "<?php echo $article['material']; ?>" required />

		<label>Weight (KG's)</label>
		<input type="text" name = "pieceWeight" value = "<?php echo $article['pieceWeight']; ?>" required />

		<label>Medium</label>
		<input type="text" name = "medium" value = "<?php echo $article['medium']; ?>" required />

		<label>Piece Type</label>
		<input type="text" name = "pieceType" value = "<?php echo $article['pieceType']; ?>" required />

		<label>Image (Please only Add PNGs to limit Website Size)</label>
		<input type = "file" name = "imageName" accept = ".png" required />

		<label>Piece Description</label>
		<textarea name = "pieceDescription" required><?php echo $article['pieceDescription']; ?></textarea>
		
		<label>Category<label> <select name = "categoryId" required >

			<?php $results = $pdo->query('SELECT * FROM category');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($results as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="hidden" name="submit" value="Submit" />';
			?>

			<label>Auction Location<label> <select name = "locationId" required >

			<?php $results = $pdo->query('SELECT * FROM locations');

				/*The foreach loop is used to select all the category options that have been added to the site. 
				This ensures that articles can't be added to a category that doesn't exist */ 
				foreach ($results as $row) {
					echo '<option value ="'. $row['name'] . '">' . $row['name'] . '</option>';
				}
			echo '<input type="submit" name="submit" value="Submit" />';
			?>
	</form>

<?php
	}
}
//if an admin is not logged in then error messages are echo'd asking for a admin log in to continue
else {
    echo '<h3>You need to be logged in with a Staff Account to access this page</h3>';
    echo '<h3>Please Log in as staff to try again</h3>';
}
require '../foot.php';
?>