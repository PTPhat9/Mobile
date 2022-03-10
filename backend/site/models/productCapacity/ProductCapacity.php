<?php 
    class ProductCapacity {
        protected $id;
        protected $product_id;
        protected $capacity;
        protected $price;
        protected $old_price;

        function __construct($id, $product_id, $capacity, $price, $old_price) {
            $this->id = $id;
            $this->product_id = $product_id;
            $this->capacity = $capacity;
            $this->price = $price;
            $this->old_price = $old_price;
        }

        function getId() {
            return $this->id;
        }

        function getProductId() {
            return $this->product_id;
        }
        
        function getCapacity() {
            return $this->capacity;
        }

        function getPrice() {
            return $this->price;
        }

        function getOldPrice() {
            return $this->old_price;
        }
    }
?>