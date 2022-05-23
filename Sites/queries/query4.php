<?php
require("./queries/connection.php");

$query = "
WITH conteo as (
        SELECT compania_aerea.codigo, persona.id, count(ticket.numero) FROM compania_aerea
        JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo
        JOIN ticket ON vuelo.id = ticket.vuelo_id
        JOIN reserva ON ticket.reserva_id = reserva.id
        JOIN persona ON reserva.cliente_id = persona.id
        GROUP BY compania_aerea.codigo, persona.id
)
SELECT compania_aerea.codigo, compania_aerea.nombre, persona.nombre, conteo.count FROM (
        SELECT conteo.codigo, max(conteo.count) FROM conteo GROUP BY conteo.codigo
) as maxs 
LEFT JOIN conteo ON conteo.count = maxs.max AND conteo.codigo = maxs.codigo
LEFT JOIN persona ON conteo.id = persona.id
LEFT JOIN compania_aerea ON compania_aerea.codigo = conteo.codigo
ORDER BY conteo.codigo;
";

$result = $db -> prepare($query);
$result -> execute();
$header = array("COD", "Aerolinea", "Cliente Frequente", "Tickets comprados");
$data = $result -> fetchAll(PDO::FETCH_NUM);
?>
