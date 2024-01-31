<?php
	// the require is needed to allow categories to be seen as well as allowing options for those logged in
	require 'databaseJoin.php';
?>
<nav>
	<ul>
		<li><a href="index.php">Auction E-Catalogue</a></li>
		<li><a href="#">Search By Category</a>
			<ul>
				<?php 
					// below selects all values from the category table, this is achieved by a foreach loop
					$results = $pdo->query('SELECT * FROM category');
					foreach ($results as $row) {
						/*after a category is selected, the name is pulled out and added to the href to create a new page for that category
						the second use of the name is to give a clickable link to the user*/
						echo '<li><a class="articleLink" href="categoryPages.php?categoryId=' . $row['name'] . '">' . $row['name'] .'</a></li>';
					}
				?>
			</ul>

		<li><a href="#">Search By Location</a>
			<ul>
				<?php 
					// below selects all values from the category table, this is achieved by a foreach loop
					$results = $pdo->query('SELECT * FROM locations');
					foreach ($results as $row) {
						/*after a category is selected, the name is pulled out and added to the href to create a new page for that category
						the second use of the name is to give a clickable link to the user*/
						echo '<li><a class="articleLink" href="locationPages.php?locationId=' . $row['name'] . '">' . $row['name'] .'</a></li>';
					}
				?>
			</ul>

		<li><a href="#">Search By Auction Period</a>
			<ul>
				<?php 
					// below selects all values from the category table, this is achieved by a foreach loop
					$results = $pdo->query('SELECT * FROM auctionPeriods');
					foreach ($results as $row) {
						/*after a category is selected, the name is pulled out and added to the href to create a new page for that category
						the second use of the name is to give a clickable link to the user*/
						echo '<li><a class="articleLink" href="periodPages.php?periodId=' . $row['name'] . '">' . $row['name'] .'</a></li>';
					}
				?>
			</ul>

			<li><a href="#">Search By Collection</a>
			<ul>
				<?php 
					// below selects all values from the category table, this is achieved by a foreach loop
					$results = $pdo->query('SELECT * FROM collections');
					foreach ($results as $row) {
						/*after a category is selected, the name is pulled out and added to the href to create a new page for that category
						the second use of the name is to give a clickable link to the user*/
						echo '<li><a class="articleLink" href="collectionPages.php?collectionId=' . $row['name'] . '">' . $row['name'] .'</a></li>';
					}
				?>
			</ul>

		<!--these are needed to allow users to login into the site -->
		<li><a class="articleLink" href="register.php">Register </a></li>
		<li><a class="articleLink" href="login.php">Log in </a></li>

			<?php 
				/*If a standard user is logged in a logout button is created as well as a Welcome back message
				The welcome message is added so the user can see when they are logged in while viewing the sites*/
				if(isset($_SESSION['loggedin']))  {
					echo '<li><a class="articleLink" href="logout.php">Log Out</a></li>';
					echo '<li><a class="articleLink" href="userHub.php">User Hub</a></li>';
					echo '<li>Welcome Back</li>';
				}
				/*If a admin is logged the following is created, a log out feature, the Admin Hub and a welcome message.
				 The admin hub is used to access all the admin options, such as addin,editing and deleting articles, categories and admins
				 The welcome back message is changed so it is easy to identify an admin vs user account */
				if(isset($_SESSION['adminloggedin'])){
					echo '<li><a class="articleLink" href="logout.php">Log Out</a></li>';
					echo '<li><a class="articleLink" href="adminArticles.php"> Staff Hub</a></li>';
					echo '<li>Welcome Back Staff</li>';
				} 
			?>
	</ul>
</nav>
<!--The below is used to create the banner image below the nav, this is randomised -->
<img src="images\banners\randombanner.php" alt = "a banner image that changes"/>
<main>