<h1>Reservas</h1>
<form>
	<label>Ingrese su código de reserva:</label>
	<input type="text" name="codigo" autofocus>
	<input type="submit", value="Buscar">
</form

<?php
	require("connection.php");
	
	$query = "SELECT reserva.id,reserva.codigo, comprador.nombre, pasajero.nombre, vuelo.codigo, ticket.clase, ticket.numero_asiento, costo.valor FROM reserva JOIN ticket ON reserva.id = ticket.reserva_id JOIN vuelo ON ticket.vuelo_id = vuelo.id JOIN aeronave ON vuelo.aeronave_codigo = aeronave.codigo JOIN costo ON aeronave.peso = costo.peso AND vuelo.ruta_id = costo.ruta_id JOIN persona AS pasajero ON ticket.persona_id = pasajero.id JOIN persona AS comprador ON reserva.cliente_id = comprador.id WHERE reserva.codigo ILIKE :codigo ORDER BY reserva.id;";
	//$query = "SELECT * FROM aerodromo;";
	$result = $db -> prepare($query);

	$codigo = "%";
	if (isset($_GET["codigo"])) {
		$codigo = "%".$_GET["codigo"]."%";
	}
	$result -> bindParam("codigo", $codigo);
        $result -> execute();
	$data = $result -> fetchAll();
	
	$current_id = "";
	echo "<ul>";
	foreach($data as $row) {
		if ($row[0] != $current_id) {
			if ($current_id != "") {
				echo "</ul></li>";
			}
			$current_id = $row[0];
			echo "<li>".$row[1]." ".$row[2]."<ul>";
		}
		echo "<li>"." ".$row[3]." ".$row[4]." ".$row[5]." ".$row[6]." ".$row[7]."</li>";
	}
	echo "</ul>";
?>
