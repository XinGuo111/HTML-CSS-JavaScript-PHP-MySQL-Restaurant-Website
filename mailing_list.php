<?php include 'header.php'; ?>
<?php include 'PasswordHash.php'; ?>
<div id="content" class="clearfix">
<?php
	require_once('./dao/abstractDAO.php');
	session_start();
	session_regenerate_id(false);
	//echo session_id();

	if(isset($_SESSION['websiteUser'])){
		if(!$_SESSION['websiteUser']->isAuthenticated()){
		   header('Location:userlogin.php'); 
		} else {
			require_once('./dao/mailingListDAO.php');
			$mailingListNew = new mailingListDAO();
			$mailingLists = $mailingListNew->getMailingLists();
			if($mailingLists){
				//We only want to output the table if we have mailingLists.
				//If there are none, this code will not run.
				//echo '<table id="list" style="display:none;" border=\'1\'>';
				echo '<p>Session AdminID = ' . $_SESSION['websiteUser']->getAdminid() . '</p>';
			    echo '<p>Last Login Date = ' . $_SESSION['websiteUser']->getLastlogin() . '</p>';
				//var_dump($_SESSION['websiteUser']->getAdminid());
				echo '<table border=\'1\'>';
				echo '<tr><th>ID</th><th>Customer Name</th><th>Phone Number</th><th>Email Address</th><th>Referrer</th></tr>';
				foreach($mailingLists as $mailingList){
					echo '<tr>';
					echo '<td><a href=\'edit_mailingList.php?_id='. $mailingList->getID() . '\'>' . $mailingList->getID() . '</a></td>';
					//echo '<td>' . $mailingList->getID() . '</td>';
					echo '<td>' . $mailingList->getCustomerName() . '</td>';
					echo '<td>' . $mailingList->getPhoneNumber() . '</td>';
					$hashed_password = password_hash($mailingList->getEmailAddress(), PASSWORD_DEFAULT);
					echo '<td>' . $hashed_password . '</td>';
					// encode
					//$email_encoded = rtrim(strtr(base64_encode($mailingList->getEmailAddress()), '+/', '-_'), '=');
					//echo '<td>' . $email_encoded . '</td>';
					// decode
					//$email_decoded = base64_decode(strtr($email_encoded, '-_', '+/'));
					echo '<td>' . $mailingList->getReferrer() . '</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		}
	} else {
		header('Location:userlogin.php');
	}
?>
</div><!-- End Content -->
<?php include 'footer.php'; ?>