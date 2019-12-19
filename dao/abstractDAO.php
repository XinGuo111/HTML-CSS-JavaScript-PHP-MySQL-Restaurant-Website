<?php

//Used to throw mysqli_sql_exceptions for database
//errors instead or printing them to the screen.
mysqli_report(MYSQLI_REPORT_STRICT);
/**
 * Abstract data access class. Holds all of the database
 * connection information, and initializes a mysqli object
 * on instantiation.
 * 
 * @author Matt
 */
class abstractDAO {
    protected $mysqli;
    
    /* Host address for the database */
    protected static $DB_HOST = "127.0.0.1";
    /* Database username */
    protected static $DB_USERNAME = "wp_eatery";
    /* Database password */
    protected static $DB_PASSWORD = "password";
    /* Name of database */
    protected static $DB_DATABASE = "wp_eatery";
	
	public function updateEmail() {
	$sql = "ALTER TABLE mailingList MODIFY emailAddress VARCHAR(70) NOT NULL";
	$stmt = $this->mysqli->prepare($sql);
    $stmt->execute(); }
		
	private $adminid;
	private $username;
    private $password;
	private $lastlogin;
    //private $mysqli;
    private $dbError;
    private $authenticated = false;
    /*
     * Constructor. Instantiates a new MySQLi object.
     * Throws an exception if there is an issue connecting
     * to the database.
     */
    function __construct() {
		$this->mysqli = new mysqli(self::$DB_HOST, self::$DB_USERNAME, 
			self::$DB_PASSWORD, self::$DB_DATABASE);
        if($this->mysqli->errno){
            $this->dbError = true;
        }else{
            $this->dbError = false;
        }
    }
    
    public function getMysqli(){
        return $this->mysqli;    
    }
	
	public function authenticate($username, $password){
        $loginQuery = "SELECT * FROM adminusers WHERE username = ? AND password =?";
        $stmt = $this->mysqli->prepare($loginQuery);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
		$row = mysqli_fetch_assoc($result);
        if($result->num_rows == 1){
			date_default_timezone_set('EST');
			$this->adminid = $row['AdminID'];
            $this->username = $username;
            $this->password = $password;
			$this->lastlogin = date('m/d/Y h:i:s', time());
            $this->authenticated = true;
        }
        $stmt->free_result();
    }
    public function isAuthenticated(){
        return $this->authenticated;
    }
    public function hasDbError(){
        return $this->dbError;
    }
    public function getUsername(){
        return $this->username;
    }
	public function getLastlogin() {
		return $this->lastlogin;
	}
	public function getAdminid() {
		return $this->adminid;
	}
 }

?>
