<?php
session_start();
/*The requires are used to generate the templates as well as connect to the database
These are not stored in the public directory as they user should not be able to directly access these*/
$title = 'Fotheby\'s - Edit Category';
require '../head.php';
require '../nav.php';
require '../databaseJoin.php';

echo '<article>';

//The if statement below checks if an admin is logged in, the code for the page will only run if an admin is logged in
if(isset($_SESSION['adminloggedin'])) {

    /*the side bar require is not with the rest of the templates as access to this could 
    allow non-admins to get access to admin only areas */
	require '../sideNavBar.php';

    /*when submit is pressed the prepare statment gets the old category name replaces it with the old name
    this is different to the other edits as the name is used as the category identifier so you cannot change it
    with the other simpler method */
    if (isset($_POST['submit'])) {
        $stmt = $pdo-> prepare('UPDATE category SET name=:newName WHERE name=:oldName');

        unset($_POST['submit']);
        $stmt ->execute($_POST);

        //this is to let the user know that their changes have been made
        echo '<p>Category Edited</p>';
    }

    /*if the submit button is not pressed then the record is selected from the database using the name as the identifier
    the name from the URL is matched to the one in the database to make sure the right one is being selected */
    else if(isset($_GET['name'])) {

    $selectName = $pdo->prepare('SELECT * FROM category WHERE name = :name');
        $value = [
            'name' => $_GET['name']
        ];

        $selectName -> execute($value);
        $category = $selectName->fetch();  
?>

    <!--This displays the form needed to edit the categories, 
	the php echo statements are used to display the original values within the database,
	without these the form would be empty -->
    <form action="editCategory.php" method= "POST">
        <p>Edit Category:</p>

        <label>Name</label> <input type="text" name = "newName" value= "<?php echo $category['name']; ?>" required />
        <!--This value is hidden as the user should not be able to see the oldname and cannot edit this,
	    however this has to be on the form in order to match the update query, if it does not match then the updates
	    will not be added to the database -->
        <input type = "hidden" name = "oldName" value = "<?php echo $category['name']; ?>" required/>
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
