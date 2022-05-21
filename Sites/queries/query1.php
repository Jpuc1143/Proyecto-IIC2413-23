<?php
require("./queries/connection.php");

$query = "
SELECT id,codigo
FROM vuelos WHERE estado ILIKE 'pendiente'
";

$result = $db -> prepare($query);
$result -> execute();
$data = $result -> fetchAll(PDO::FETCH_NUM);
if (isset($_GET["vuelos_pendientes"])) {
    if ($_GET["vuelos_pendientes"] == "Buscar Vuelos Pendientes") {
      foreach($data as $arreglo) {
        if ($arreglo[10] == "pendiente"){
          echo "<tr> <td> $arreglo[0]</td> <td>$arreglo[11]</td></tr><br>";
        }
      }
    }
  }
?>