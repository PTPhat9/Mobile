<?php
class CommentRepository extends BaseRepository{
	
	function fetchAll($condition = null, $sort = null)
	{
		global $conn;
		$comments = array();
		$sql = "SELECT * FROM comment";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}
		if ($sort) {
			$sql .= " $sort";
		}
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$comment = new Comment($row["id"], $row["email"], $row["fullname"], $row["star"], $row["created_date"], $row["description"], $row["product_id"]);
				$comments[] = $comment;
			}
		}
		return $comments;
	}

	function find($id) {
		global $conn; 
		$conds = " id = $id";
		$comments = $this->fetchAll($conds);
		$comment = current($comments);
		return $comment;
	}

	function getByProductId($product_id) {
		return $this->fetchAll("product_id = $product_id", "ORDER BY created_date DESC");
	}

	function save($data) {
		global $conn;
		$product_id = $data["product_id"];
		$email = $data["email"];
		$fullname = $data["fullname"];
		$star = $data["star-rating"];
		$created_date = date("Y-m-d H:i:s");
		$description = $data["description"];

		$sql = "INSERT INTO comment(product_id, email,
		fullname, star, created_date, description) 
		VALUES($product_id, '$email', '$fullname', '$star', '$created_date', '$description')";
		if ($conn->query($sql)) {
            return true;
        }
		$this->error = "Error: " . $sql . $conn->error;
		return false;
	}
}