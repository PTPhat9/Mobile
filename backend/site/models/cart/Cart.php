<?php 
class Cart
{
	protected $items;
	protected $total_price;
	protected $total_product_number;

	function __construct($items = array(), $total_price = 0, $total_product_number = 0){
		$this->items = $items;
		$this->total_price = $total_price;
		$this->total_product_number = $total_product_number;
	}

	function getItems(){
		return $this->items;
	}

	function getTotalPrice(){
		return $this->total_price;
	}

	function getTotalProductNumber(){
		return $this->total_product_number;
	}

	function addProduct($product_code, $qty, $item) {
		
		$unit_price 	= $item["unit_price"];
		$total_price 	= $item["unit_price"] * $qty;

		if (!array_key_exists($product_code, $this->items)) {
			$this->items[$product_code] = array(
				"product_id" => $item["product_id"],
				"img" => $item["img"],
				"name" => $item["name"],
				"qty" => $item["qty"],
				"unit_price" => $item["unit_price"], 
				"color" => $item["color"],
				"product_code" => $item["product_code"],
				"total_price" => $total_price,
			);
		}
		else {
			$this->items[$product_code]["qty"]+= $qty;
			$this->items[$product_code]["total_price"] = $this->items[$product_code]["qty"] * $unit_price;
		}

		$this->total_price += $unit_price * $qty;
		$this->total_product_number += $qty;
	}
	function deleteProduct($product_id) {
		if (array_key_exists($product_id, $this->items)) {
			unset($this->items[$product_id]);
		}
		$this->total_price = 0;
		$this->total_product_number = 0;
		foreach ($this->items as $id => $item) {
			$this->total_price += $item["unit_price"] * $item["qty"];
			$this->total_product_number += $item["qty"];
		}
	}

	function convertToArray() {
		$a = array();
		$a["items"] = $this->items;
		$a["total_product_number"] = $this->total_product_number;
		$a["total_price"] = $this->total_price;
		return $a;
	}
}