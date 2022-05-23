<?php
require("./queries/connection.php");

if (isset($_GET["compania"])) {
	$compania = "%".$_GET["compania"]."%";
} else {
	$compania = "%";
}

$query = "
WITH aceptado as (
        SELECT compania_aerea.codigo, count(estado) FROM compania_aerea
        LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo
        WHERE estado = 'aceptado'
        GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado
), rechazado as (
        SELECT compania_aerea.codigo, count(estado) FROM compania_aerea
        LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo
        WHERE estado = 'rechazado'
        GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado
), borrador as (
        SELECT compania_aerea.codigo, count(estado) FROM compania_aerea
        LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo
        WHERE estado = 'borrador'
        GROUP BY compania_aerea.codigo, estado
), pendiente as (
        SELECT compania_aerea.codigo, count(estado) FROM compania_aerea
        LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo
        WHERE estado = 'pendiente'
        GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado
), publicado as (
        SELECT compania_aerea.codigo, count(estado) FROM compania_aerea
        LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo
        WHERE estado = 'publicado'
        GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado
), total as (
        SELECT compania_codigo, COUNT(vuelo.id) FROM vuelo GROUP BY compania_codigo
)
SELECT compania_aerea.codigo, compania_aerea.nombre as compania_nombre,
        coalesce(aceptado.count,0) as aceptado, coalesce(aceptado.count,0)/total.count::float as aceptado_percent,
        coalesce(rechazado.count,0) as rechazado, coalesce(rechazado.count,0)/total.count::float as rechazado_percent,
        coalesce(borrador.count,0) as borrador, coalesce(borrador.count,0)/total.count::float as borrador_percent,
        coalesce(pendiente.count,0) as pendiente, coalesce(pendiente.count,0)/total.count::float as pendiente_percent,
        coalesce(publicado.count,0) as publicado, coalesce(publicado.count,0)/total.count::float as publicado_percent,
        total.count as total FROM compania_aerea
LEFT JOIN aceptado ON compania_aerea.codigo = aceptado.codigo
LEFT JOIN rechazado ON compania_aerea.codigo = rechazado.codigo
LEFT JOIN borrador ON compania_aerea.codigo = borrador.codigo
LEFT JOIN pendiente ON compania_aerea.codigo = pendiente.codigo
LEFT JOIN publicado ON compania_aerea.codigo = publicado.codigo
LEFT JOIN total ON compania_aerea.codigo = total.compania_codigo
WHERE compania_aerea.nombre ILIKE :compania
ORDER BY compania_aerea.codigo;
";

$result = $db -> prepare($query);
$result -> bindParam("compania", $compania);

$result -> execute();
$data = $result -> fetchAll(PDO::FETCH_NUM);
foreach($data as &$row) {
	for($i = 3; $i<count($row); $i += 2) {
		$row[$i] = round(100*$row[$i])."%";
	}
}
?>
