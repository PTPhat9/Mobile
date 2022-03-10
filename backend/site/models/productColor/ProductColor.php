<?php 
    class ProductColor {
        protected $id;
        protected $product_id;
        protected $color;
        protected $image;

        function __construct($id, $product_id, $color, $image) {
            $this->id = $id;
            $this->product_id = $product_id;
            $this->color = $color;
            $this->image = $image;
        }

        function getId() {
            return $this->id;
        }

        function getProductId() {
            return $this->product_id;
        }
        
        function getColor() {
            return $this->color;
        }

        function getImage() {
            return $this->image;
        }
    }
?>