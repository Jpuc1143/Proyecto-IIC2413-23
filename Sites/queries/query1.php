<?php
require("./queries/connection.php");

$query = "
SELECT codigo, compania_codigo, aeronave_codigo, fecha_salida, fecha_llegada
FROM vuelo WHERE estado = 'pendiente';
";

$result = $db -> prepare($query);
$result -> execute();
$header = array("Vuelo","COD", "Aerolinea", "Fecha Salida", "Fecha Llegada");
$data = $result -> fetchAll(PDO::FETCH_NUM);
?>
