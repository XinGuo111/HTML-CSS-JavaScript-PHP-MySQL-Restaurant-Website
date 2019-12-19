<?php include 'header.php';?>
<?php include 'menuitem.php'; ?>
	<div id="content" class="clearfix">
		<aside>
			<?php
				$i = 0;
				$menuItem = Array();
				
				while($i<4) {
					if($i==0)
						$menuItem[] = new Menuitem("The WP Burger*1", "Freshly made all-beef patty served up with homefries", "$14");
					if($i==1)
						$menuItem[] = new Menuitem("WP Kebabs**2", "Tender cuts of beef and chicken, served with your choice of side", "$17");
					if($i==2)
						$menuItem[] = new Menuitem("The WP Burger***3", "Freshly made all-beef patty served up with homefries", "$14");
					if($i==3)
						$menuItem[] = new Menuitem("WP Kebabs****4", "Tender cuts of beef and chicken, served with your choice of side", "$17");
					$i++;
				}
				//var_dump($menuItem);
			?>
				<h2><?php echo date("l"); ?>'s Specials</h2>
				<hr>
				<img src="images/burger_small.jpg" alt="Burger" title="Monday's Special - Burger">
				<h3><?php echo $menuItem[0]->get_itemName();?></h3>
				<p><?php echo $menuItem[0]->get_description()." - ".$menuItem[0]->get_price();?></p>
				<hr>
				<img src="images/kebobs.jpg" alt="Kebobs" title="WP Kebobs">
				<h3><?php echo $menuItem[1]->get_itemName();?></h3>
				<p><?php echo $menuItem[1]->get_description()." - ".$menuItem[1]->get_price();?></p>
				<hr>
				<img src="images/burger_small.jpg" alt="Burger" title="Monday's Special - Burger">
				<h3><?php echo $menuItem[2]->get_itemName();?></h3>
				<p><?php echo $menuItem[2]->get_description()." - ".$menuItem[2]->get_price();?></p>
				<hr>
				<img src="images/kebobs.jpg" alt="Kebobs" title="WP Kebobs">
				<h3><?php echo $menuItem[3]->get_itemName();?></h3>
				<p><?php echo $menuItem[3]->get_description()." - ".$menuItem[3]->get_price();?></p>
				<hr>

		</aside>
		<div class="main">
			<h1>Welcome</h1>
			<img src="images/dining_room.jpg" alt="Dining Room" title="The WP Eatery Dining Room" class="content_pic">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			<h2>Book your Christmas Party!</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
		</div><!-- End Main -->
	</div><!-- End Content -->
<?php include 'footer.php'; ?>
