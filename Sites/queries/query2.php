<?php
require("./queries/connection.php");

if (isset($_GET["aerolinea"])) {
	$aerolinea = "%".$_GET["aerolinea"]."%";
} else {
	$aerolinea = "%";
}
if (isset($_GET["icao"])) {
	$icao = "%".$_GET["icao"]."%";
} else {
	$icao = "%";
}

$query = "
SELECT compania_aerea.codigo, compania_aerea.nombre, vuelo.codigo, vuelo.estado, aerodromo.nombre, aerodromo.icao
FROM vuelo
LEFT JOIN aerodromo ON aerodromo.id = vuelo.aerodromo_llegada_id
LEFT JOIN compania_aerea ON compania_aerea.codigo = vuelo.compania_codigo
WHERE estado = 'aceptado' AND
compania_aerea.nombre ILIKE :aerolinea AND aerodromo.icao ILIKE :icao;
";
$result = $db -> prepare($query);
$result -> bindParam("aerolinea", $aerolinea);
$result -> bindParam("icao", $icao);

$result -> execute();
$header = array("COD", "Aerolinea", "Vuelo", "Estado", "Aerodromo Destino", "ICAO");
$data = $result -> fetchAll(PDO::FETCH_NUM);
?>
