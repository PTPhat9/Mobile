<?php
class OrderItemRepository{
	function fetchAll($condition = null)
	{
		global $conn;
		$orderItems = array();
		$sql = "SELECT * FROM order_item";
		if ($condition) 
		{
			$sql .= " WHERE  $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$orderItem = new OrderItem($row["product_id"], $row["order_id"], $row["color"], $row["qty"], $row["unit_price"], $row["total_price"], $row["order_email"]);
				$orderItems[] = $orderItem;
			}
		}
		return $orderItems;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function getByOrderId($order_id) {
		global $conn; 
		$condition = "order_id = $order_id";
		$orderItems = $this->fetchAll($condition);
		return $orderItems;
	}

	function find($order_id, $product_id) {
		global $conn; 
		$condition = "order_id = $order_id AND product_id = $product_id";
		$orderItems = $this->fetchAll($condition);
		$orderItem = current($orderItems);
		return $orderItem;
	}

	function save($orderId, $item) {
		global $conn;
		$product_id 	= $item["product_id"]; 
		$color 			= $item["color"];
		$qty 			= $item["qty"];
		$unit_price 	= $item["unit_price"];
		$total_price 	= $item["total_price"];
		$order_email 	= $_SESSION["email"]; 
		$sql = "INSERT INTO order_item (order_id, product_id, color, qty, unit_price, total_price, order_email) 
		VALUES ($orderId, $product_id, $color, $qty, $unit_price, $total_price, '$order_email')";
		if ($conn->query($sql)) {
			return true;
		} 
		echo "Error: " . $sql . $conn->error;
		return false;
	}

}