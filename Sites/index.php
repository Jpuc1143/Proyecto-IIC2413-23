<?php include("header.html") ?>

<h2>Index</h2>

<?php

include("queries/query5.php");
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
