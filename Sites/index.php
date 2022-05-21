<?php include("header.html") ?>

<h2>Index</h2>

<form>
	<label>Estados de vuelos por nombre de aerolinea</label></br>
	<label>Aerolinea: </label>
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
			break;
		case "4":
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
	echo "<table>";
	foreach($data as $row) {
		echo "<tr>";
		foreach($row as $cell) {
			echo "<td>$cell</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
?>

<?php include("footer.html") ?>
