<?php
require_once('abstractDAO.php');
require_once('./model/mailingList.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mailingListDAO
 *
 * @author Matt
 */
class mailingListDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }
    
    /*
     * This is an example of how to use the query() method of a mysqli object.
     * 
     * Returns an array of <code>MailingList</code> objects. If no mailingLists exist, returns false.
     */
    public function getMailingLists(){
        
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM mailingList');
        $mailingLists = Array();
		
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new mailingList object, and add it to the array.
                $mailingList = new MailingList($row['_id'], $row['customerName'], $row['phoneNumber'], $row['emailAddress'], $row['referrer']);
                $mailingLists[] = $mailingList;
            }
            $result->free();
            return $mailingLists;
        }
        $result->free();
        return false;
    }
    
    /*
     * This is an example of how to use a prepared statement
     * with a select query.
     */
    public function getMailingList($_id){
        $query = 'SELECT * FROM mailingList WHERE _id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $mailingList = new MailingList($temp['_id'], $temp['customerName'], $temp['phoneNumber'], $temp['emailAddress'], $temp['referrer']);
            $result->free();
            return $mailingList;
        }
        $result->free();
        return false;
    }

    public function addMailingList($mailingList){
        // if(!is_numeric($customer->getEmployeeId())){
            // return 'EmployeeId must be a number.';
        // }
        if(!$this->mysqli->connect_errno){
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            $query = 'INSERT INTO mailingList VALUES (?,?,?,?,?)';
            //The prepare method of the mysqli object returns
            //a mysqli_stmt object. It takes a parameterized 
            //query as a parameter.
            $stmt = $this->mysqli->prepare($query);
            //The first parameter of bind_param takes a string
            //describing the data. In this case, we are passing 
            //three variables: an integer(employeeId), and two
            //strings (firstName and lastName).
            //
            //The string contains a one-letter datatype description
            //for each parameter. 'i' is used for integers, and 's'
            //is used for strings.
			$customerName = $mailingList->getCustomerName();
			$phoneNumber = $mailingList->getPhoneNumber();
			$emailAddress = $mailingList->getEmailAddress();
			$referrer = $mailingList->getReferrer();
            $stmt->bind_param('issss',
					$DEFAULT,
                    $customerName, 
                    $phoneNumber,
					$emailAddress, 
                    $referrer);
            //Execute the statement
            $stmt->execute();
            //If there are errors, they will be in the error property of the
            //mysqli_stmt object.
            if($stmt->error){
                return $stmt->error;
            } else {
                return $mailingList->getCustomerName() . ' ' . ' added successfully!';
            }
        } else {
            return 'Could not connect to Database.';
        }
    }
    
    public function deleteMailingList($_id){
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM mailingList WHERE _id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $_id);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public function editMailingList($_id, $customerName, $phoneNumber, $emailAddress, $referrer){
        if(!$this->mysqli->connect_errno){
            $query = 'UPDATE mailingList SET customerName = ?, phoneNumber = ?, emailAddress = ?, referrer = ? WHERE _id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('ssssi', $customerName, $phoneNumber, $emailAddress, $referrer, $_id);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return $stmt->affected_rows;
            }
        } else {
            return false;
        }
    }
}

?>
