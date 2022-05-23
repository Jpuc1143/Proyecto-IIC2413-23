<?php
require("./queries/connection.php");

if (isset($_GET["orden"]) && $_GET["orden"] == "menor") {
        $orden = "min";
} else {
        $orden = "max";
}

if (isset($_GET["metrica"]) && $_GET["metrica"] == "cantidad") {
        $metrica = "count";
} else {
        $metrica = "percent";
}

if (isset($_GET["estado"]) && in_array($_GET["estado"],array("aceptado","rechazado","borrador","pendiente","publicado"))) {
        $estado = $_GET["estado"];
} else {
        $estado = "aceptado";
}

$query = "
WITH total as (
        SELECT compania_codigo, COUNT(vuelo.id) FROM vuelo GROUP BY compania_codigo
), vuelos_count as (
        SELECT compania_aerea.codigo, estado, count(estado), count(estado)/total.count::float as percent FROM compania_aerea
        LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo
        JOIN total ON total.compania_codigo = compania_aerea.codigo
        WHERE estado = :estado
        GROUP BY compania_aerea.codigo, estado, total.count
)
SELECT compania_aerea.codigo, compania_aerea.nombre, :estado,
        coalesce(vuelos_count.count,0), coalesce(vuelos_count.percent,0), total.count as total
        FROM vuelos_count
FULL JOIN total ON vuelos_count.codigo = total.compania_codigo
LEFT JOIN compania_aerea ON compania_aerea.codigo = total.compania_codigo
WHERE coalesce(vuelos_count.$metrica,0)= (
                SELECT $orden(coalesce(vuelos_count.$metrica,0)) as extreme FROM vuelos_count
                FULL JOIN total ON vuelos_count.codigo = total.compania_codigo
        );

";

$result = $db -> prepare($query);
$result -> bindParam("estado", $estado);

$result -> execute();
$header = array("COD", "Aerolinea", "Estado", "Cantidad", "%", "Total");
$data = $result -> fetchAll(PDO::FETCH_NUM);
foreach($data as &$row) {
	$row[4] = round(100*$row[4])."%";
}

?>
