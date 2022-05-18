<!DOCTYPE html>
<html>
<head>
    <title>Sección Vuelos</title>
</head>
<body>
    <h1>Vuelos</h1>
    <hr>
    <p> Primero seleccione el estado del vuelo que desea visualizar para los vuelos:</p>
<form action="action_page.php" method="GET">
  <input type="radio" id="Aceptado" name="estado_vuelo" value="Aceptado">
  <label for="aceptado">Aceptado</label><br>
  <input type="radio" id="Borrado" name="estado_vuelo" value="Borrado">
  <label for="borrado">Borrado</label><br>
  <input type="radio" id="Publicado" name="estado_vuelo" value="Publicado">
  <label for="publicado">Publicado</label>
  <input type="radio" id="Pendiente" name="estado_vuelo" value="Pendiente">
  <label for="pendiente">Pendiente</label>
</form
<?php
if (isset($_GET["estado_vuelo"])) {
  if ($_GET["estado_vuelo"] == "Aceptado") {
    echo "Aceptado";
  } else {
  echo "No Aceptado";
}
}
?>
</form>
</body>
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
<?php 
        $data = array(array(45,43,'Amsterdam'),array(46,42,'New York')); 
        echo $data[0][2]; 
    ?> 

</html>
