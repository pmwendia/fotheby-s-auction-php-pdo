<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Manage Auction Lots';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';

//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['adminloggedin'])) {

	/*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
	require '../sideNavBar.php';
?>
<article>
	<!--This div is used to give the user a link to create a new article -->
	<div>
		<a href = "addArticle.php">Add a New Article</a>
	</div>

	<div>
		<?php
		/*This selects all articles that are in the database, they are added to the 
		page in order of descending publish date to make them easier to search through*/
		$results = $pdo->query('SELECT * FROM article ORDER BY lotReference DESC');

		/*For each article that is pulled out it is displayed with a heading and a publish date.
		There are two links displayed below it that allow the user to edit or delete that article. 
		The article ID is used to make sure that when these options are clicked the user is taken to the right 
		edit and delete page */
		foreach ($results as $row) {
			echo  '<li><h3>' . $row['pieceTitle'] . '</h3>' . '<p> Lot Number: ' . $row['lotNumber'] .'</p></li>';
			echo  '<p><a href = "editArticle.php?lotReference=' . $row['lotReference'] . '"> Edit Lot </a></p>';
			echo  '<p><a href = "deleteArticle.php?lotReference=' . $row['lotReference'] . '"> Delete Lot</a></p>';
		}
		?>
	</div>
<?php
}

//if an admin is not logged in then error messages are echo'd asking for a admin log in to continue
else {
	echo '<h3>You need to be logged into a Staff Account to access this page</h3>';
    echo '<h3>Please Log in as Staff to try again</h3>';
}
require '../foot.php';
?>