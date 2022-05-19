<!DOCTYPE html>
<html>
<head>
    <title>Sección Vuelos</title>
</head>
<body>
    <h1>Vuelos</h1>
<div align="center">
  <img src = "avion.jpg" height="300" width="500">
</div>
<hr>
<?php 
        $data = array(array(98,39,71,213,'TPUYDBP','COG','2022-04-21 13:35:00','2022-04-22 12:11:00',275,12577,'publicado'),array(99,56,50,263,'ZQZKYVL','QAF','2022-04-30 13:20:00','2022-05-02 12:00:00',275,12577,'pendiente')); 
    ?>

<div align="center">
  <p> A continuación puede buscar los vuelos pendientes de ser aprobados por la DGAC</p>
<button onclick="VuelosPendientes()"style="background-color:white;color:black;border-radius:5px">Buscar vuelos pendientes</button>
<p id="pendiente"> </p>
<script>
var data = array(array(98,39,71,213,'TPUYDBP','COG','2022-04-21 13:35:00','2022-04-22 12:11:00',275,12577,'publicado'),array(99,56,50,263,'ZQZKYVL','QAF','2022-04-30 13:20:00','2022-05-02 12:00:00',275,12577,'pendiente'))
  function VuelosPendientes(){
    document.getElementById("pendiente").innerHTML = data[0][0]
  }
</script>
</div>
<hr>
<div align="center">
  <p> A continuación puede buscar los vuelos que son aceptados por cierta aerolínea y que tienen como destino un aeródromo con cierto código ICAO específico:</p>
<form method="get">
  <label for="icao">Código ICAO:</label><br>
  <input type="text" id="icao" name="icao" value=""><br>
  <label for="aerolinea">Aerolínea:</label><br>
  <input type="text" id="aerolinea" name="aerolinea" value=""><br><br>
  <input type="submit" value="Submit">
</form> 
</div>
<hr>
<div align="center">
<button onclick="PagPrincipal_Return()"style="background-color:white;color:black;border-radius:5px">Regresar a la página principal</button>
</div>
<?php
if (isset($_GET["submit"])) {
  if ($_GET["submit"] == "Vuelos Pendientes") {
    for($i=0;$i!=$data.length;$i++) {
      if ($data[i][0] == 'pendiente'); {
       echo $data[i][10];
      }
    }
  } 
  else {
  echo "No hay vuelos pendientes de ser aprobados";
}
}
?>
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
