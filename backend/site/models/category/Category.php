<?php 
    class Category {
        protected $id;
        protected $name;

        function __construct($id, $name) {
            $this->id = $id;
            $this->name = $name;
        }

        function getId() {
            return $this->id;
        }

        function getName() {
            return $this->name;
        }

        function getProducts() {
            $productRepository = new ProductRepository();
            $id = $this->id;
            $conds = "category_id = $id";
            $products = $productRepository->getBy($conds);
            return $products;
        }
    }
?>