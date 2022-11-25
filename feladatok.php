<?php
include_once('use/u_dao.php');
?>
<!doctype html>
<html lang="hu">
<head>
	<title>Feladatok</title>
	<?php include_once('use/head_imports.php'); ?>
</head>

<body>
	
<?php include_once('use/navbar.php'); ?>
<br>
<div class="container">
	<h1>Jogkörök és feladataik</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
			<th>Jogkör neve</th>
			<th>Feladatai</th>
		</tr>

	<?php

		$feladatok = feladatok_lekerdez();

		while($fetch = mysqli_fetch_assoc($feladatok)) {
			echo '<tr>';
			echo '<td>'. $fetch['jogkor_nev'].'</td>';
			echo '<td>'. $fetch["feladat"] .'</td>';
			echo '</tr>';
		} 
		mysqli_free_result($feladatok);

	?>
</table>

</body>
</html>