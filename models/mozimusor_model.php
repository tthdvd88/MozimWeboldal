<?php

class Mozimusor_Model
{
	function get_data()
	{
		$retData = [];
        try {
            $connection = Database::getConnection();
            $sql = "SELECT * FROM film"; 
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $retData = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            die("Error fetching data: " . $e->getMessage());
        }
        return $retData; 
    }
	}


?>