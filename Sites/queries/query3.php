<?php
require("./queries/connection.php");

if (isset($_GET["codigo"])) {
	$codigo = "%".$_GET["codigo"]."%";
} else {
	$codigo = "%";
}

$query = "
SELECT reserva.codigo, comprador.nombre, pasajero.nombre, vuelo.codigo, ticket.clase, ticket.numero_asiento, costo.valor FROM reserva
LEFT JOIN ticket ON reserva.id = ticket.reserva_id
LEFT JOIN vuelo ON ticket.vuelo_id = vuelo.id
LEFT JOIN aeronave ON vuelo.aeronave_codigo = aeronave.codigo
LEFT JOIN costo ON aeronave.peso = costo.peso AND vuelo.ruta_id = costo.ruta_id
LEFT JOIN persona AS pasajero ON ticket.persona_id = pasajero.id
LEFT JOIN persona AS comprador ON reserva.cliente_id = comprador.id
WHERE reserva.codigo ILIKE :codigo
ORDER BY reserva.id;
";

$result = $db -> prepare($query);
$result -> bindParam("codigo", $codigo);

$result -> execute();
$header = array("Reserva", "Comprador", "Pasajero", "Vuelo", "Clase", "Asiento", "Valor");
$data = $result -> fetchAll(PDO::FETCH_NUM);
foreach($data as &$row) {
	$row[6] = "$".$row[6];
}
?>
