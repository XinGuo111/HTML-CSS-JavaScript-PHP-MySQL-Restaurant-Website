<?php
	class MailingList{
		private $_id;
		private $customerName;
		private $phoneNumber;
		private $emailAddress;
		private $referrer;
		
		function __construct($_id, $customerName, $phoneNumber, $emailAddress, $referrer){
			$this->setID($_id);
			$this->setCustomerName($customerName);
			$this->setPhoneNumber($phoneNumber);
			$this->setEmailAddress($emailAddress);
			$this->setReferrer($referrer);
		}
		
		public function getID(){
			return $this->_id;
		}
		
		public function setID($_id){
			$this->_id = $_id;
		}
		
		public function getCustomerName(){
			return $this->customerName;
		}
		
		public function setCustomerName($customerName){
			$this->customerName = $customerName;
		}
		
		public function getPhoneNumber(){
			return $this->phoneNumber;
		}
		
		public function setPhoneNumber($phoneNumber){
			$this->phoneNumber = $phoneNumber;
		}
		
		public function getEmailAddress(){
			return $this->emailAddress;
		}
		
		public function setEmailAddress($emailAddress){
			$this->emailAddress = $emailAddress;
		}
		
		public function getReferrer(){
			return $this->referrer;
		}
		
		public function setReferrer($referrer){
			$this->referrer = $referrer;
		}
	}
?>