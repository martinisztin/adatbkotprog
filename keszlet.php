<?php
include_once('use/u_dao.php');
?>
<!doctype html>
<html lang="hu">
<head>
	<title>Készlet</title>
	<?php include_once('use/head_imports.php'); ?>
</head>

<body>
	
<?php include_once('use/navbar.php'); ?>

<div class="container">
	<h1>Új készlet nyilvántartása</h1>
</div>

<div class="container" style="width:500px;">
	<form method="POST" action="upload_keszlet.php" accept-charset="utf-8">
	<div class="form-group">
   			<label>Áru azonosítója: </label>
   			<select name="aru_azonosito" class="form-control">
				<?php 
				$aruk = aruk_lekerdez();
				while($fetch = mysqli_fetch_assoc($aruk)) {
					echo '<option value='.$fetch['azonosito'].'>'.$fetch['azonosito'].' - '.$fetch['marka']. ' ' . $fetch['nev'] .'</option>';
				}
				?>
			</select>
   		</div>
   		<br>
	   <div class="form-group">
   			<label>Mennyiség: </label>
   			<input type="text" name="mennyiseg" class="form-control" />
		</div>
		<br>
		<div class="form-group">
   			<label>Következő érkezés: </label>
   			<input type="date" name="kovetkezo_erkezes" class="form-control" />
		</div>
		<br>
		<div class="form-group">
   			<input type="submit" value="Elküld" class="form-control"/>
		</div>
	</form>
</div>

<hr>
<div class="container">
	<h1>Készlet állapota</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
			<th>Termék</th>
			<th>Készleten</th>
			<th>Következő érkezés</th>
			<th>Műveletek</th>
		</tr>

	<?php

		$keszlet = keszlet_lekerdez();

		while($fetch = mysqli_fetch_assoc($keszlet)) {
			$adottAru = mysqli_fetch_assoc(specific_aru_lekerdez($fetch['aru_azonosito']));
			
			echo '<tr>';
			echo '<td>'. $adottAru["marka"] . ' ' . $adottAru['nev'] . ' (' . $fetch['aru_azonosito'] .')</td>';
			echo '<td>'. $fetch["mennyiseg"] .'</td>';
			echo '<td>'. $fetch["kovetkezo_erkezes"] .'</td>';
			echo '<td><a href="delete_keszlet.php?id='.$fetch['aru_azonosito'].'">Törlés</a></td>';
			echo '</tr>';
		} 
		mysqli_free_result($keszlet);

	?>
</table>


</body>
</html>
