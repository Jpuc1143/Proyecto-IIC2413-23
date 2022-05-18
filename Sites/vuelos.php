<!DOCTYPE html>
<html>
<head>
    <title>Sección Vuelos</title>
</head>
<body>
    <h1>Vuelos</h1>
    <hr>
<form method="GET">
<label> Primero seleccione el estado del vuelo que desea visualizar:</label>
<br>
<input type="radio" id="Aceptado" name="estado_vuelo" value="Aceptado">
<label for="aceptado">Aceptado</label><br>
<input type="radio" id="Borrado" name="estado_vuelo" value="Borrado">
<label for="borrado">Borrado</label><br>
<input type="radio" id="Publicado" name="estado_vuelo" value="Publicado">
<label for="publicado">Publicado</label>
<br>
<input type="radio" id="Pendiente" name="estado_vuelo" value="Pendiente">
<label for="pendiente">Pendiente</label>
<br>
<input type="submit" value="Submit">
</form>
<?php 
        $data = array(array(98,39,71,213,'TPUYDBP','COG','2022-04-21 13:35:00','2022-04-22 12:11:00',275,12577,'publicado'),array(99,56,50,263,'ZQZKYVL','QAF','2022-04-30 13:20:00','2022-05-02 12:00:00',275,12577,'pendiente')); 
    ?> 
<?php
if (isset($_GET["estado_vuelo"])) {
  if ($_GET["estado_vuelo"] == "Pendiente") {
    for(;$data;) {
      if ($data[i][0] == 'pendiente'); {
        echo $data[i][10];
      }
    }
  } else {
  echo "No hay vuelos pendientes de ser aprobados";
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

</html>

