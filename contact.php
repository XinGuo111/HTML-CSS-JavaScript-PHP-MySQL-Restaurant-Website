<?php require_once('./dao/mailingListDAO.php'); ?>
<?php include 'header.php'; ?>
	<div id="content" class="clearfix">
		<aside>
			<h2>Mailing Address</h2>
			<h3>1385 Woodroffe Ave<br>
				Ottawa, ON K4C1A4</h3>
			<h2>Phone Number</h2>
			<h3>(613)727-4723</h3>
			<h2>Fax Number</h2>
			<h3>(613)555-1212</h3>
			<h2>Email Address</h2>
			<h3>info@wpeatery.com</h3>
		</aside>
		<div class="main">
			<h1>Sign up for our newsletter</h1>
			<p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
			
			<?php
				$new = new abstractDAO();
				$new->updateEmail();
				
				//The abstractDAO and mailingListDAO will throw exceptions
				//if there is a problem with the database connection.
				//The entire web page is contained in the try block, so
				//if there is any issue, the page does not load, and instead
				//informs the user about the error.
				
				try {
				$mailingListDAO = new mailingListDAO();
				//Tracks errors with the form fields
				$hasError = false;
				//Array for our error messages
				$errorMessages = Array();
				
				if(isset($_POST['btnSubmit'])) {
					if(isset($_POST['customerName']) || isset($_POST['phoneNumber']) || isset($_POST['emailAddress']) || isset($_POST['referral'])) {
						if($_POST['customerName'] == "") {
							$hasError = true;
							$errorMessages['customerNameError'] = 'Please enter a customer name.';
						}
						
						if($_POST['phoneNumber'] == "") {
							$hasError = true;
							$errorMessages['phoneNumberError'] = 'Please enter a phone number.';
						}
						
						if($_POST['emailAddress'] == "") {
							$hasError = true;
							$errorMessages['emailAddressError'] = 'Please enter an email address.';
						}
						
						if(!isset($_POST['referral'])) {
							$hasError = true;
							$errorMessages['referralError'] = 'Please select a radio button.';
						}
						
						if($_FILES['fileToUpload']) {
							$target_dir = './files/';
							$target_name = $_FILES['fileToUpload']['name'];
							$target_tmp_name = $_FILES['fileToUpload']['tmp_name'];
							$upload_path = $target_dir . basename($target_name);
							move_uploaded_file($target_tmp_name, $upload_path);
							echo $target_name . ' uploaded successfully';
						}
						
						if(!$hasError) {
							$mailingList = new MailingList(null, $_POST['customerName'], $_POST['phoneNumber'], $_POST['emailAddress'], $_POST['referral']);
							$addSuccess = $mailingListDAO->addMailingList($mailingList);
							echo '<h3>' . $addSuccess . '</h3>';
						}
					}
					
					//The code that deletes a user directs them
					//back to this page with a parameter in the 
					//URL called 'deleted'. If this is set,
					//display a confirmation message.
					if(isset($_GET['deleted'])){
						if($_GET['deleted'] == true){
							echo '<h3>MailingList Deleted</h3>';
						}
					}
				}
			?>

			<!-- <form name="frmNewsletter" id="frmNewsletter" method="post" action="newsletterSignup.php"> -->
			<form name="frmNewsletter" id="frmNewsletter" enctype="multipart/form-data" method="post" action="contact.php">
				<table>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="customerName" id="customerName" size='40'>
						<?php
						// If there was an error with the customerName field, display the message
						if(isset($errorMessages['customerNameError'])) {
							echo '<span style=\'color:red\'>' . $errorMessages['customerNameError'] . '</span>';
						}
						?>
						</td>
					</tr>
					<tr>
						<td>Phone Number:</td>
						<td><input type="text" name="phoneNumber" id="phoneNumber" size='40'>
						<?php
						// If there was an error with the phoneNumber field, display the message
						if(isset($errorMessages['phoneNumberError'])) {
							echo '<span style=\'color:red\'>' . $errorMessages['phoneNumberError'] . '</span>';
						}
						?>
						</td>
					</tr>
					<tr>
						<td>Email Address:</td>
						<td><input type="text" name="emailAddress" id="emailAddress" size='40'>
						<?php
						// If there was an error with the emailAddress field, display the message
						if(isset($errorMessages['emailAddressError'])) {
							echo '<span style=\'color:red\'>' . $errorMessages['emailAddressError'] . '</span>';
						}
						?>
						</td>
					</tr>
					<tr>
						<td>How did you hear<br> about us?</td>
						<td>Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper">
							Radio<input type="radio" name='referral' id='referralRadio' value='radio'>
							TV<input type='radio' name='referral' id='referralTV' value='TV'>
							Other<input type='radio' name='referral' id='referralOther' value='other'>
						<?php
						// If there was an error with the referral field, display the message
						if(isset($errorMessages['referralError'])) {
							echo '<span style=\'color:red\'>' . $errorMessages['referralError'] . '</span>';
						}
						?>
						</td>
					</tr>
					<tr>
						<td>Choose a file to upload</td>
					</tr>
					<tr>
						<td colspan='3'><input type='file' name='fileToUpload' id='fileToUpload'></td>	
					</tr>
					<tr>
						<td colspan='3'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;
						<input type='reset' name="btnReset" id="btnReset" value="Reset Form">&nbsp;&nbsp;
						<!--input type='button' name="btnDisplay" id="btnDisplay" value="Display Mailing List" onclick="document.getElementById('list').style.display = 'block'"-->
						</td>
					</tr>
				</table>
			</form>
			
			
			<?php
			//require('./mailing_list.php');
			} catch(Exception $e) {
				//If there were any database connection/sql issues,
				//an error message will be displayed to the user.
				echo '<h3>Error on page.</h3>';
				echo '<p>' . $e->getMessage() . '</p>';            
			}
			?>
		</div><!-- End Main -->
	</div><!-- End Content -->
<?php include 'footer.php'; ?>
