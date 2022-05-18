<h1>Listado de Aerolineas</h1>

<?php
	require("connection.php");

	$query = "WITH aceptado as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'aceptado'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), rechazado as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'rechazado'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), borrador as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'borrador'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), pendiente as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'pendiente'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), publicado as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'publicado'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ) SELECT compania_aerea.codigo, nombre, aceptado.count as aceptado, rechazado.count as rechazado, borrador.count as borrador,  pendiente.count as pendiente, publicado.count as publicado FROM compania_aerea LEFT JOIN aceptado ON compania_aerea.codigo = aceptado.codigo LEFT JOIN rechazado ON compania_aerea.codigo = rechazado.codigo LEFT JOIN borrador ON compania_aerea.codigo = borrador.codigo LEFT JOIN pendiente ON compania_aerea.codigo = pendiente.codigo LEFT JOIN publicado ON compania_aerea.codigo = publicado.codigo;";
	
	$result = $db -> prepare($query);
	$codigo = "%";
	if (isset($_GET["codigo"])) {
		$codigo = "%".$_GET["codigo"]."%";
	}
	$result -> bindParam("codigo", $codigo);
	$result -> execute();
	$data = $result -> fetchAll();
	
	echo "<ul>";
	foreach($data as $row) {
		echo "<li>".$row[0].",".$row[1].":".$row[2].",".$row[3].",".$row[4].",".$row[5].",".$row[6]."</li>";
	}
	echo "</ul>";
?>
