<?php
require_once('./dao/mailingListDAO.php');
if(isset($_GET['action'])){
    if($_GET['action'] == "edit"){
        if( isset($_POST['customerName']) && 
			isset($_POST['phoneNumber']) &&
			isset($_POST['emailAddress']) && 
			isset($_POST['referrer'])){
        
        if( $_POST['customerName'] != "" &&
			$_POST['phoneNumber'] != "" &&
			$_POST['emailAddress'] != "" &&
			$_POST['referrer'] != ""){    
               
                $mailingListNew = new mailingListDAO();
                $result = $mailingListNew->editMailingList($_POST['customerId'], $_POST['customerName'], $_POST['phoneNumber'], $_POST['emailAddress'], $_POST['referrer']);
                if($result > 0){
                    header('Location:edit_mailingList.php?recordsUpdated='.$result.'&_id=' . $_POST['customerId']);
                } else {
                    header('Location:edit_mailingList.php?_id=' . $_POST['customerId']);
                }
            } else {
                header('Location:edit_mailingList.php?missingFields=true&_id=' . $_POST['customerId']);
            }
        } else {
            header('Location:edit_mailingList.php?error=true&_id=' . $_POST['customerId']);
        }
    }
    
    if($_GET['action'] == "delete"){
        if(isset($_GET['_id'])){
            $mailingListDAO = new mailingListDAO();
            $success = $mailingListDAO->deleteMailingList($_GET['_id']);
            echo $success;
            if($success){
                header('Location:contact.php?deleted=true');
            } else {
                header('Location:contact.php?deleted=false');
            }
        }
    }
}
?>
