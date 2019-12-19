<?php
require_once('./dao/mailingListDAO.php');

if(!isset($_GET['_id'])){
//Send the user back to the main page
header("Location: contact.php");
exit;

} else{
    $mailingListDAO = new mailingListDAO();
    $mailingList = $mailingListDAO->getMailingList($_GET['_id']);
    if($mailingList){
?>    
        
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>WP Eatery - Edit Mailing List - <?php echo $mailingList->getCustomerName();?></title>
        <script type="text/javascript">
            function confirmDelete(_id, customerName){
                return confirm("Do you wish to delete " + _id + " " + customerName + "?");
            }
        </script>
    </head>
    <body>
        
		<?php
        if(isset($_GET['recordsUpdated'])){
                if(is_numeric($_GET['recordsUpdated'])){
                    echo '<h3> '. $_GET['recordsUpdated']. ' Mailing List Updated.</h3>';
                }
        }
        if(isset($_GET['missingFields'])){
                if($_GET['missingFields']){
                    echo '<h3 style="color:red;"> Please enter all the informaton.</h3>';
                }
        }?>
        <h3>Edit Mailing List</h3>
        <form name="editMailingList" method="post" action="process_mailingList.php?action=edit">
            <table>
                <tr>
                    <td>Customer ID:</td>
                    <td><input type="hidden" name="customerId" id="customerId" 
                               value="<?php echo $mailingList->getID();?>"><?php echo $mailingList->getID();?>
					</td>
                </tr>
				<tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="customerName" id="customerName" 
                               value="<?php echo $mailingList->getCustomerName();?>">
					</td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="text" name="phoneNumber" id="phoneNumber" 
                               value="<?php echo $mailingList->getPhoneNumber();?>">
					</td>
                </tr>
                <tr>
                    <td>Email Address:</td>
                    <td><input type="text" name="emailAddress" id="emailAddress" 
                               value="<?php echo $mailingList->getEmailAddress();?>">
					</td>
                </tr>
				<tr>
                    <td>Referrer:</td>
                    <td><input type="text" name="referrer" id="referrer" 
                               value="<?php echo $mailingList->getReferrer();?>">
					</td>
                </tr>
				<tr>
                    <td cospan="2"><a onclick="return confirmDelete('<?php echo $mailingList->getID();?>', '<?php echo $mailingList->getCustomerName();?>')" href="process_mailingList.php?action=delete&_id=<?php echo $mailingList->getID();?>">
					Delete Mailing List <?php echo $mailingList->getID() . ' ' . $mailingList->getCustomerName();?></a></td>
                </tr>
				<tr>
					<td cospan="2"><a href="userlogout.php">Log Out</a></td>
				</tr>
				<tr>
                    <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Update Mailing List"></td>
                    <td><input type="reset" name="btnReset" id="btnReset" value="Reset"></td>
                </tr>
            </table>
        </form>
        <h4><a href="mailing_list.php">Back to List page</a></h4>
    </body>
</html>
<?php } else{
//Send the user back to the main page
header("Location: contact.php");
exit;
}

} ?>