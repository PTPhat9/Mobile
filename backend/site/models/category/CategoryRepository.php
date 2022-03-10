<?php 
    class CategoryRepository extends BaseRepository{
        
        function fetchAll($condition = null) {
            global $conn;
            $sql = "SELECT * FROM category";
            if($condition) {
                $sql .= " WHERE $condition";
            }
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $category = new Category($row["id"], $row["name"]);
                    $categories[] = $category;
                }
            }
            return $categories;
        }

        function find($id) {
            $condition = "id = $id";
            $categories = $this->fetchAll($condition);
            $category = current($categories);
            return $category;
        }
    }
?>