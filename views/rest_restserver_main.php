<?php

$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=mozimusor', 'mozimusor', 'mozimozi',
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM mozi";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th></th><th>Mozinév</th><th>Irányítószám</th><th>Cím</th><th>Telefon</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			break;
		case "POST":
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "insert into mozi values (DEFAULT, :mozinev, :irszam, :cim, :telefon)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":mozinev"=>$data["mozinev"], ":irszam"=>$data["irszam"], ":cim"=>$data["cim"], ":telefon"=>$data["telefon"]));		
				$newmoziazon = $dbh->lastInsertId();
				$eredmeny .= $count."A hozzáadott mozi: ".$newmoziazon;
			break;
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$modositando = "moziazon=moziazon"; $params = Array(":moziazon"=>$data["moziazon"]);
				if($data['mozinev'] != "") {$modositando .= ", mozinev = :mozinev"; $params[":mozinev"] = $data["mozinev"];}
				if($data['irszam'] != "") {$modositando .= ", irszam = :irszam"; $params[":irszam"] = $data["irszam"];}
				if($data['cim'] != "") {$modositando .= ", cim = :cim"; $params[":cim"] = $data["cim"];}
				if($data['telefon'] != "") {$modositando .= ", telefon = :telefon"; $params[":telefon"] = $data["telefon"];}
				$sql = "update mozi set ".$modositando." where moziazon=:moziazon";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute($params);
				$eredmeny .= $count." darab mozi módosításra került, azonosítója: ".$data["moziazon"];
			break;
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from mozi where moziazon=:moziazon";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":moziazon" => $data["moziazon"]));
				$eredmeny .= $count."A mozi törölve. Azonosítója:".$data["moziazon"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;

?>