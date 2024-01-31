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
    if (isset($_GET['name'])) {

        //the category Id from the URL is fetched and used as the header for the page
        echo '<h3>' . $_GET['name'] . '</h3>';

        /*this prepare statemnt is used to match the URL to the Id in the database, 
        this is used to ensure the correct category is retrieved */
        $selectCat = $pdo->prepare('SELECT * FROM emailTemplates WHERE name= :name');
        $value = [
            'name' => $_GET['name'],
        ];

        $selectCat -> execute($value);

        foreach($selectCat->fetchAll() as $row) {
            echo '<br>';
	        echo $row['mainContent'] . '</p>';
        }
    require '../foot.php';
    }
?>
