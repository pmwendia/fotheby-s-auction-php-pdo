<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Delete Auction Lot';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';

//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['adminloggedin'])) {

	/*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
	require '../sideNavBar.php';

    /*When the article delete is clicked the articleId is used as the iD to ensure the right article gets deleted*/
    if(isset($_GET['lotReference'])) {
        $removeCategory = $pdo->prepare('DELETE FROM article WHERE lotReference= :lotReference');
        $removeCategory ->execute($_GET);

    echo '<p>Auction Lot Deleted</p>';
    }
}
//if an admin is not logged in then error messages are echo'd asking for a admin log in to continue
else {
    echo '<h3>You need to be logged into a Staff Account to access this page</h3>';
    echo '<h3>Please Log in as Staff to try again</h3>';
}
require '../foot.php';
?>