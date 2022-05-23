<?php include("header.html") ?>
<body>
	<h1>Consultas AirInfo</h1>
</body>
<div align="center">
  <img src = "avion.jpg" height="300" width="500">
</div>
<hr>
<div align="center">
  <p> A continuación puede buscar los vuelos pendientes de ser aprobados por la DGAC</p>
<form>
  <button type="submit" name="query" value="1">Buscar Vuelos Pendientes</button>
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
  <button type="submit" name="query" value="2">Buscar</button>
</form> 
</div>
<hr>
<div align="center">
<form>
	<label>Ingrese su código de reserva:</label>
        <input type="text" name="codigo"><br>
		<br>
	<button type="submit" name="query" value="3">Buscar</button>
</form>
</div>
<hr>
<div align="center">
<form>
	<label>Clientes Frecuentes</label><br>
	<br>
	<button type="submit" name="query" value="4">Buscar</button>
</form>
</div>
<hr>
<div align="center">
	<p>Estados de vuelos por nombre de aerolínea</p>
<form>
	<label>Nombre aerolinea: </label>
	<input type="text" name="compania"><br>
	<br>
	<button type="submit" name="query" value="5">Buscar</button>
</form>
</div>
<hr>
<div align="center">
<form>
	<label>Aerolinea con</label>
	<select name="orden">
		<option value="mayor">mayor</option>
		<option value="menor">menor</option>
	</select>
	<select name="metrica">
		<option value="porcentaje">porcentaje</option>
		<option value="cantidad">cantidad</option>
	</select>
	<label>de vuelos aceptados</label>
	<select name="estado">
		<option value="aceptado">aceptados</option>
		<option value="rechazado">rechazados</option>
		<option value="borrador">borradores</option>
		<option value="pendiente">pendientes</option>
		<option value="publicado">publicados</option>
	</select>
	<br>
	<br> 
	<button type="submit" name="query" value="6">Buscar</button>
</form>
</div>
<hr>

<?php
if (isset($_GET["query"])) {
	switch ($_GET["query"]) {
		case "1":
			include("queries/query1.php");
			break;
		case "2":
			include("queries/query2.php");
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
	// Aparentemente el meme de php es horrible es verdad y por eso tuve que usar un for en vez del foreach por 
	// un "propiedad" no-intuitiva.
	for($i=0;$i<count($data);$i++) {
		echo "<tr>";
		foreach($data[$i] as $cell) {
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
