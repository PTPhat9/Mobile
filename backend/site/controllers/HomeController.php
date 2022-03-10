<?php 
class HomeController {
    function index() {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->fetchAll();

        // $brandRepository = new BrandRepository();
        // $brands = $brandRepository->fetchAll();

        $productRepository = new ProductRepository();
        
        //sp nổi bật
        $sort = null;
        $conds = "featured = 1";
        $limit = 10;
        $featuredProducts = $productRepository->fetchAll($conds, $sort, $limit);
        
        $categoryProducts = [];
        $limit = 5;
        foreach ($categories as $category) {
            $id = $category->getId();
            $conds = "category_id = $id";
            $products = $productRepository->fetchAll($conds,$sort, $limit);
            $categoryProducts[$category->getName()] = $products;
        }
        
        require "views/home/index.php";
    }
}
?>