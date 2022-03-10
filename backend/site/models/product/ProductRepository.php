<?php
class ProductRepository extends BaseRepository{

	function fetchAll($condition = null, $sort = null, $limit = null)
	{
		global $conn;
		$products = array();
		$sql = "SELECT * FROM product";
		if ($condition) 
		{
			$sql .= " WHERE $condition"; 
		}
		if ($sort) 
		{
			$sql .= " $sort"; 
		}
		if ($limit) 
		{
			$sql .= " LIMIT $limit"; 
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$product = new Product(
					$row["id"], $row["name"], $row["price"],
					$row["price_128GB"], $row["price_256GB"], $row["price_512GB"], $row["old_price"],
					$row["old_price_128GB"], $row["old_price_256GB"], $row["old_price_512GB"], 
					$row["discount_percentage"], 
					$row["discount_from_date"], $row["discount_to_date"],
					$row["featured_image"], $row["inventory_qty"], 
					$row["created_date"], $row["description"], $row["star"], $row["featured"], 
					$row["category_id"], $row["brand_id"]);
				$products[] = $product;
			}
		}

		return $products;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		$condition = "id = $id";
		$products = $this->fetchAll($condition);
		$product = current($products);
		return $product;
	}

}