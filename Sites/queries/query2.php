<?php
require("./queries/connection.php");

if (isset($_GET["aerolinea"])) {
	$aerolinea = "%".$_GET["aerolinea"]."%";
} else {
	$aerolinea = "%";
}
if (isset($_GET["icao"])) {
	$icao = "%".$_GET["icao"]."%";
} else {
	$icao = "%";
}

$query = "
SELECT vuelo.id, vuelo.codigo
FROM vuelo,aerodromo,compania_aerea
WHERE aerodromo.id = vuelo.aerodromo_llegada AND
compania_aerea.codigo = vuelo.compania_aerea.codigo AND
compania_aerea.nombre ILIKE:aerolinea AND
aeodromo.icao ILIKE:icao
";
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