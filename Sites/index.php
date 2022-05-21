<?php include("header.html") ?>

<h2>Index</h2>

<form>
        <label>Ingrese su código de reserva:</label>
        <input type="text" name="codigo">
	<button type="submit" name="query" value="3">Buscar</button>
</form>

<form>
	<label>Clientes Frequentes</label>
	<button type="submit" name="query" value="4">Buscar</button>
</form>

<form>
	<label>Estados de vuelos por nombre de aerolinea</label></br>
	<label>Nombre aerolinea: </label>
	<input type="text" name="compania">
	<button type="submit" name="query" value="5">Buscar</button>
</form>

<form>
	<label>Aerolinea con mayor porcentaje de vuelos aceptados</label>
	<button type="submit" name="query" value="6">Buscar</button>
</form>

<?php
if (isset($_GET["query"])) {
	switch ($_GET["query"]) {
		case "1":
			break;
		case "2":
			break;
		case "3":
			include("queries/query3.php");
			break;
		case "4":
			include("queries/query4.php");
			break;
		case "5":
			include("queries/query5.php");
			break;
		case "6":
			include("queries/query6.php");
			break;
	}
}
if (isset($data)) {
	echo '<table class="table table-striped table-hover">';
	// theader foreach header
	echo '<tbody>';
	foreach($data as $row) {
		echo "<tr>";
		foreach($row as $cell) {
			echo "<td>$cell</td>";
		}
		echo "</tr>";
	}
	echo "</tbody></table>";
}
?>

<?php include("footer.html") ?>
