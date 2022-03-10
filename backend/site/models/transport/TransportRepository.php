<?php
class TransportRepository{
	protected $error;

	function fetchAll($condition = null)
	{
		global $conn;
		$transports = array();
		$sql = "SELECT * FROM transport";
		if ($condition) 
		{
			$sql .= " WHERE $condition";
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while ($row = $result->fetch_assoc()) 
			{
				$transport = new Transport($row["id"], $row["province_id"], $row["price"]);
				$transports[] = $transport;
			}
		}

		return $transports;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "id = $id";
		$transports = $this->fetchAll($condition);
		$transport = current($transports);
		return $transport;
	}

	function findByProvinceId($province_id) {
		global $conn; 
		$condition = "province_id = '$province_id'";
		$transports = $this->fetchAll($condition);
		$transport = current($transports);
		return $transport;
	}

}