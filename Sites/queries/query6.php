<?php
require("./queries/connection.php");

$query = "
WITH vuelos_count as (
        SELECT compania_aerea.codigo, count(estado) FROM compania_aerea
        LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo
        WHERE estado = 'aceptado'
        GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado
), total as (
        SELECT compania_codigo, COUNT(vuelo.id) FROM vuelo GROUP BY compania_codigo
)
SELECT compania_aerea.codigo, compania_aerea.nombre,
        extremes.extreme as count, extremes.extreme/total.count::float as percent, total.count as total FROM (
                SELECT max(count) as extreme FROM vuelos_count
        ) as extremes
LEFT JOIN vuelos_count ON vuelos_count.count = extremes.extreme
LEFT JOIN compania_aerea ON vuelos_count.codigo = compania_aerea.codigo
LEFT JOIN total ON compania_aerea.codigo = total.compania_codigo;
";

$result = $db -> prepare($query);
$result -> execute();
$data = $result -> fetchAll();
?>
