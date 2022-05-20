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
        $data = array(array(98,39,71,213,'TPUYDBP','COG','2022-04-21 13:35:00','2022-04-22 12:11:00',275,12577,'publicado','XLE1416'),array(99,56,50,263,'ZQZKYVL','QAF','2022-04-30 13:20:00','2022-05-02 12:00:00',275,12577,'pendiente','QAF8273'));
        $data2 = array(array(98,39,71,213,'TPUYDBP','COG','2022-04-21 13:35:00','2022-04-22 12:11:00',275,12577,'publicado','XLE1416',71,'Miami','La Cascada','IC34','34E','Latitud','Longitud','TPUYDBP','Compañia 1'),array(99,56,50,263,'ZQZKYVL','QAF','2022-04-30 13:20:00','2022-05-02 12:00:00',275,12577,'pendiente','QAF8273',50,'Chile','Arturo','IC44','34U','Latitud','Longitud','ZQZKYVL','Compañia 2')) 
    ?>

<div align="center">
  <p> A continuación puede buscar los vuelos pendientes de ser aprobados por la DGAC</p>
<form>
  <input type="submit" name="vuelos_pendientes" value="Buscar Vuelos Pendientes">
</form>
</div>
<?php
if (isset($_GET["vuelos_pendientes"])) {
  if ($_GET["vuelos_pendientes"] == "Buscar Vuelos Pendientes") {
    foreach($data as $arreglo) {
      if ($arreglo[10] == "pendiente"){
        echo "<tr> <td> $arreglo[0]</td> <td>$arreglo[11]</td></tr><br>";
      }
    }
  }
}
?>
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
<?php
if (isset($_GET["boton_submit"])) {
  if (isset($_GET["icao"])){
    if (isset($_GET["aerolinea"])){
      foreach($data2 as $arreglo){
        if ($_GET["icao"]==$arreglo[15] AND $_GET["aerolinea"]==$arreglo[20]){
          echo "<tr> <td> $arreglo[0]</td> <td>$arreglo[11]</td></tr><br>"; 
        }
      }
    }
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
