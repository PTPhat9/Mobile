<?php 
class OrderItem
{
	protected $product_id;
	protected $order_id;
	protected $qty;
	protected $unit_price;
	protected $total_price;
	protected $order_email;
	protected $color;


	function __construct($product_id, $order_id, $color, $qty, $unit_price, $total_price, $order_email){
		$this->product_id = $product_id;
		$this->order_id = $order_id;
		$this->qty = $qty;
		$this->unit_price = $unit_price;
		$this->total_price = $total_price;
		$this->order_email = $order_email;
		$this->color = $color;
	}

	function getProductId(){
		return $this->product_id;
	}

	function getOrderId(){
		return $this->order_id;
	}

	function getQty(){
		return $this->qty;
	}

	function getUnitPrice(){
		return $this->unit_price;
	}

	function getTotalPrice(){
		return $this->total_price;
	}

	function getOrderEmail(){
		return $this->order_email;
	}
	function getColor(){
		return $this->color;
	}


	function getProduct() {
		$productRepository = new ProductRepository();
		$product = $productRepository->find($this->product_id);
		return $product;
	}

	function getOrder() {
		$orderRepository = new OrderRepository();
		$order = $orderRepository->find($this->order_id);
		return $order;
	}
}