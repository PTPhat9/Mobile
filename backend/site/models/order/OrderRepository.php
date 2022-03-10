<?php
class OrderRepository extends BaseRepository{
	function fetchAll($condition = null, $sort = null)
	{
		global $conn;
		$orders = array();
		$sql = "SELECT * FROM `order`";
		if ($condition) 
		{
			$sql .= " WHERE  $condition";
		}
		if ($sort) {
			$sql .= " $sort";
		}
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$order = new Order($row["id"], $row["created_date"], $row["order_status_id"], $row["customer_id"], $row["shipping_fullname"], $row["shipping_mobile"], $row["payment_method"], $row["shipping_ward_id"], $row["shipping_housenumber_street"], $row["shipping_fee"], $row["delivered_date"]);
				$orders[] = $order;
			}
		}
		return $orders;
	}

	function getAll() {
		return $this->fetchAll();
	}
	
	function getByCustomerId($customer_id) {
		global $conn; 
		$condition = "customer_id = $customer_id";
		$sort = "ORDER BY id DESC";
		return $this->fetchAll($condition, $sort);
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$orders = $this->fetchAll($condition);
		$order = current($orders);
		return $order;
	}

	function save($customer_id, $data, $shipping_fee) {
		global $conn;
		$created_date = date("Y-m-d H:i:s"); 
		$order_status_id = 1;
		$shipping_fullname = $data["fullname"];
		$shipping_mobile = $data["mobile"];
		$payment_method = $data["payment_method"];
		$shipping_ward_id = $data["ward"];
		$shipping_housenumber_street = $data["address"];
		$delivered_date = date("Y-m-d H:i:s", strtotime("+3 days"));

		$sql = "INSERT INTO `order` (created_date, order_status_id, customer_id, shipping_fullname, shipping_mobile, payment_method, shipping_ward_id, shipping_housenumber_street, shipping_fee, delivered_date) 
		VALUES ('$created_date', $order_status_id, $customer_id, '$shipping_fullname', '$shipping_mobile', '$payment_method', '$shipping_ward_id', '$shipping_housenumber_street', $shipping_fee, '$delivered_date')";
		if ($conn->query($sql)) {
		    $last_id = $conn->insert_id;
		    return $last_id;
		} 
		echo "Error: " . $sql . $conn->error;
		return false;
	}

}