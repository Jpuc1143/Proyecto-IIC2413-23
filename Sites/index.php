<?php include("header.html") ?>

<h2>Index</h2>
<hr>
<div align="center">
  <img src = "avion.jpg" height="300" width="500">
</div>
<hr>
<div align="center">
  <p> A continuación puede buscar los vuelos pendientes de ser aprobados por la DGAC</p>
<form>
  <input type="submit" name="vuelos_pendientes" value="Buscar Vuelos Pendientes">
</form>
</div>
<hr>
<div align="center">
  <p> A continuación puede buscar los vuelos que son aceptados por cierta aerolínea y que tienen como destino un aeródromo con cierto código ICAO específico:</p>
<form method="get">
  <label for="icao">Código ICAO:</label><br>
  <input type="text" id="icao" name="icao" value=""><br>
  <label for="aerolinea">Aerolínea:</label><br>
  <input type="text" id="aerolinea" name="aerolinea" value=""><br><br>
  <input type="submit" name ="boton_submit" value="Submit">
</form> 
</div>
<hr>
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
			include("queries/query1.php")
			break;
		case "2":
			include("queries/query2.php")
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
<style>
body {
  background-color: lightblue;
}

h1 {
  color: black;
  text-align: center;
}

p {
  font-family: verdana;
  font-size: 15px;
}
</style>

<?php include("footer.html") ?>
