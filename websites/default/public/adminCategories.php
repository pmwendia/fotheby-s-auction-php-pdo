<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Manage Categories';
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
		<!--This div is used to give the user a link to create a new category -->
		<div>
			<a href = "addCategory.php">Add a New Category</a>
		</div>

<?php 		
			//This gets all the categories out of the categories table
			$results = $pdo->query('SELECT * FROM category');

			/*The category name is displayed
			There are two links displayed below it that allow the user to edit or delete the category. 
			The name is used to make sure that when clicked the user is taken to the right 
			edit and delete page */
			foreach ($results as $row) {
				echo  '<li><p>' . $row['name'].'</p></li>';
				echo  '<p><a href = "editCategory.php?name=' . $row['name'] . '"> Edit Category </a></p>';
				echo  '<p><a href = "deleteCategory.php?name=' . $row['name'] . '"> Delete Category</a></p>';
			}
}
//if an admin is not logged in then error messages are echo'd asking for a admin log in to continue
else {
	echo '<h3>You need to be logged into a Staff Account to access this page</h3>';
    echo '<h3>Please Log in as Staff to try again</h3>';
}
require '../foot.php';
?>