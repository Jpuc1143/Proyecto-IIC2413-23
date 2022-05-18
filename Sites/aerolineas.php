<h1>Listado de Aerolineas</h1>

<form>         
	<label>Nombre de Aerolinea:</label>
	<input type="text" name="compania" autofocus>
	<input type="submit", value="Buscar"></br>
	<label>Ordenar por:</label>
	<select name="orden">
		<option value="compania">Nombre Aerolinea</option>
		<option value="codigo">Código Aerolinea</option>
		<option value="total">Cantidad de Vuelos</option>
		<option value="aceptado">Cantidad Vuelos Aceptados</option>
		<option value="aceptado_percent">Porcentaje Vuelos Aceptados</option>
		<option value="rechazado">Cantidad Vuelos Rechazados</option>
		<option value="rechazado_percent">Porcentaje Vuelos Rechazados</option>
		<option value="pendiente">Cantidad Vuelos Pendiente</option>
		<option value="pendiente_percent">Porcentaje Vuelos Pendientes</option>
		<option value="borrador">Cantidad Vuelos Borradoress</option>
		<option value="borrador_percent">Porcentaje Vuelos Borradores</option>
		<option value="publicado">Cantidad Vuelos Publicados</option>
		<option value="publicado_percent">Porcentaje Vuelos Publicados</option>
	</select>
</form>


<?php
	require("connection.php");

	$query = "WITH aceptado as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'aceptado'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), rechazado as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'rechazado'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), borrador as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'borrador'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), pendiente as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'pendiente'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), publicado as (         SELECT compania_aerea.codigo, count(estado) FROM compania_aerea         LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo         WHERE estado = 'publicado'         GROUP BY compania_aerea.codigo, compania_aerea.nombre, estado ), frequente as (         WITH conteo as (                 SELECT compania_aerea.codigo, persona.id, count(ticket.numero) FROM compania_aerea                 LEFT JOIN vuelo ON compania_aerea.codigo = vuelo.compania_codigo                 LEFT JOIN ticket ON vuelo.id = ticket.vuelo_id                 LEFT JOIN reserva ON ticket.reserva_id = reserva.id                 LEFT JOIN persona ON reserva.cliente_id = persona.id                 GROUP BY compania_aerea.codigo, persona.id          )         SELECT conteo.codigo, max(conteo.id) as id, conteo.count FROM conteo         INNER JOIN (                 SELECT codigo, max(count) FROM conteo                 GROUP BY codigo         ) as max_conteo ON conteo.codigo = max_conteo.codigo AND conteo.count = max_conteo.max         GROUP BY conteo.codigo, conteo.count ), total as (         SELECT compania_codigo, COUNT(vuelo.id) FROM vuelo GROUP BY compania_codigo ) SELECT compania_aerea.codigo, compania_aerea.nombre as compania_nombre, total.count as total,         aceptado.count as aceptado, aceptado.count/total.count::float as aceptado_percent,         rechazado.count as rechazado, rechazado.count/total.count::float as rechazado_percent,         borrador.count as borrador, borrador.count/total.count::float as borrador_percent,         pendiente.count as pendiente, pendiente.count/total.count::float as pendiente_percent,         publicado.count as publicado, publicado.count/total.count::float as publicado_percent,         persona.nombre as cliente, frequente.count as cliente_count FROM compania_aerea LEFT JOIN aceptado ON compania_aerea.codigo = aceptado.codigo LEFT JOIN rechazado ON compania_aerea.codigo = rechazado.codigo LEFT JOIN borrador ON compania_aerea.codigo = borrador.codigo LEFT JOIN pendiente ON compania_aerea.codigo = pendiente.codigo LEFT JOIN publicado ON compania_aerea.codigo = publicado.codigo LEFT JOIN frequente ON compania_aerea.codigo = frequente.codigo LEFT JOIN persona ON frequente.id = persona.id LEFT JOIN total ON compania_aerea.codigo = total.compania_codigo WHERE compania_aerea.nombre ILIKE :compania";

	
	$compania = "%";
	if (isset($_GET["compania"])) {
		$compania = "%".$_GET["compania"]."%";
	}

	$orden = " ORDER BY ";
	if (isset($_GET["orden"])) {
		switch($_GET["orden"]) {
			default:
			case "compania":
				$orden .= "compania_aerea.nombre";
				break;
			case "codigo":
				$orden .= "compania_aerea.codigo";
				break;
			case "total":
				$orden .= "total.count DESC";
				break;
			case "aceptado":
				$orden .= "aceptado DESC";
				break;
			case "aceptado_percent":
				$orden .= "aceptado_percent DESC";
				break;
			case "rechazado":
				$orden .= "rechazado DESC";
				break;
			case "rechazado_percent":
				$orden .= "rechazado_percent DESC";
				break;
			case "pendiente":
				$orden .= "pendiente DESC";
				break;
			case "pendiente_percent":
				$orden .= "pendiente_percent DESC";
				break;
			case "borrador":
				$orden .= "borrador DESC";
				break;
			case "borrador_percent":
				$orden .= "borrador_percent DESC";
				break;
			case "publicado":
				$orden .= "publicado DESC";
				break;
			case "publicado_percent":
				$orden .= "publicado_percent DESC";
				break;





		}
	}
	$query .= $orden.";";	

	$result = $db -> prepare($query);
	$result -> bindParam("compania", $compania);
	$result -> execute();
	$data = $result -> fetchAll();
	
	echo "<ul>";
	foreach($data as $row) {
		echo "<li>".$row[0].",".$row[1].":".$row[2].",".$row[3].",".$row[4].",".$row[5].",".$row[6]."</li>";
	}
	echo "</ul>";
?>
