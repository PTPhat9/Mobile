<?php 
    class ProductCapacityRepository {
        
        function fetchAll($condition) {
            global $conn;
            $capacities = array();
            $sql = "SELECT * FROM product_capacity";
            if($condition) {
                $sql .= " WHERE $condition";
            }
            $result = $conn->query($sql);
            $capacities = [];
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $capacity = new ProductCapacity($row["id"], $row["product_id"], $row["capacity"], $row["price"], $row["old_price"]);
                    $capacities[] = $capacity;
                }
            }
            return $capacities;
        }

        function getByProductId($product_id) {
            return $this->fetchAll("product_id = $product_id");
        }
    }
?>