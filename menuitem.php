<?php
    class Menuitem
    {
        private $itemName, $description, $price;
        
        public function __construct($itemName, $description, $price)
        {
            $this->set_itemName($itemName);
            $this->set_description($description);
            $this->set_price($price);
        }

        public function set_itemName($itemName)
        {
            $this->itemName = $itemName;
        }
        public function get_itemName()
        {
            return $this->itemName;
        }

        public function set_description($description)
        {
            $this->description = $description;
        }
        public function get_description()
        {
            return $this->description;
        }

        public function set_price($price)
        {
            $this->price = $price;
        }
        public function get_price()
        {
            return $this->price;
        }
    }
?>