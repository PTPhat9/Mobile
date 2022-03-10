<?php 
class Product {
	protected $id;
	protected $name;
	protected $price;
	protected $price_128GB;
	protected $price_256GB;
	protected $price_512GB;
	protected $old_price;
	protected $old_price_128GB;
	protected $old_price_256GB;
	protected $old_price_512GB;

	protected $discount_percentage;
	protected $discount_from_date;
	protected $discount_to_date;
	protected $featured_image;
	protected $inventory_qty;
	protected $created_date;
	protected $description;
	protected $star;
	protected $featured;
	protected $category_id;
	protected $brand_id;

	function __construct($id, $name, $price, $price_128GB, $price_256GB, $price_512GB, 
		$old_price, $old_price_128GB, $old_price_256GB, $old_price_512GB, 
		$discount_percentage, $discount_from_date, 
		$discount_to_date, $featured_image, 
		$inventory_qty, $created_date, $description, 
		$star, $featured, $category_id, $brand_id){

		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
		$this->price_128GB = $price_128GB;
		$this->price_256GB = $price_256GB;
		$this->price_512GB = $price_512GB;
		$this->old_price = $old_price;
		$this->old_price_128GB = $old_price_128GB;
		$this->old_price_256GB = $old_price_256GB;
		$this->old_price_512GB = $old_price_512GB;

		$this->discount_percentage = $discount_percentage;
		$this->discount_from_date = $discount_from_date;
		$this->discount_to_date = $discount_to_date;
		$this->featured_image = $featured_image;
		$this->inventory_qty = $inventory_qty;
		$this->created_date = $created_date;
		$this->description = $description;
		$this->star = $star;
		$this->featured = $featured;
		$this->category_id = $category_id;
		$this->brand_id = $brand_id;
	}

	function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}


	function getPrice() {
		return $this->price;
	}

	function getPrice128GB() {
		return $this->price_128GB;
	}

	function getPrice256GB() {
		return $this->price_256GB;
	}

	function getPrice512GB() {
		return $this->price_512GB;
	}

	function getOldPrice() {
		return $this->old_price;
	}

	function getOldPrice128GB() {
		return $this->price_128GB;
	}

	function getOldPrice256GB() {
		return $this->price_256GB;
	}

	function getOldPrice512GB() {
		return $this->price_512GB;
	}



	function getDiscountPercentage() {
		return $this->discount_percentage;
	}

	function getDiscountFromDate() {
		return $this->discount_from_date;
	}

	function getDiscountToDate() {
		return $this->discount_to_date;
	}


	function getFeaturedImage() {
		return $this->featured_image;
	}

	function getInventoryQty() {
		return $this->inventory_qty;
	}

	function getCreatedDate() {
		return $this->created_date;
	}

	function getDescription() {
		return $this->description;
	}

	function getStar() {
		return $this->star;
	}

	function getFeatured() {
		return $this->featured;
	}

	function getCategoryId() {
		return $this->category_id;
	}

	function getBrandId() {
		return $this->brand_id;
	}

	function getCategory() {
		$categoryRepository = new CategoryRepository();
		$category = $categoryRepository->find($this->category_id);
		return $category;
	}

	function getBrand() {
		$brandRepository = new BrandRepository();
		$brand = $brandRepository->find($this->brand_id);
		return $brand;
	}

	function getComments() {
		$commentRepository = new CommentRepository();
		$comments = $commentRepository->getByProductId($this->id);
		return $comments;
	}

	function getProductColors() {
		$productColorRepository = new ProductColorRepository();
		$productColors = $productColorRepository->getByProductId($this->id);
		return $productColors;
	}
	function getProductCapacities() {
		$productCapacityRepository = new ProductCapacityRepository();
		$productCapacities = $productCapacityRepository->getByProductId($this->id);
		return $productCapacities;
	}

	
}