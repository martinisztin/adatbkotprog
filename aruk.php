<?php
include_once('use/u_dao.php');
?>
<!doctype html>
<html lang="hu">
<head>
	<title>Áruk</title>
	<?php include_once('use/head_imports.php'); ?>
</head>

<body>
	
<?php include_once('use/navbar.php'); ?>

<div class="container">
	<h1>Új áru hozzáadása</h1>
</div>

<div class="container" style="width:500px;">
	<form method="POST" action="upload_aru.php" accept-charset="utf-8">
		<div class="form-group">
   			<label>Márka: </label>
   			<input type="text" name="marka" class="form-control" />
		</div>
   		<br>
	   <div class="form-group">
   			<label>Neve: </label>
   			<input type="text" name="nev" class="form-control" />
		</div>
		<br>
		<div class="form-group">
   			<label>Beszerzési ára: </label>
   			<input type="text" name="beszerzesi_ar" class="form-control" />
		</div>
		<br>
		<div class="form-group">
   			<label>Szín: </label>
   			<input type="text" name="szin" class="form-control" />
   		</div>
		<br>
		<div class="form-group">
   			<label>Elhelyezkedése (melyik raktár): </label>
   			<select name="raktar_azonosito" class="form-control">
				<?php 
				$raktarak = raktar_lekerdez();
				while($fetch = mysqli_fetch_assoc($raktarak)) {
					echo '<option value='.$fetch['azonosito'].'>'.$fetch['azonosito'].' - '.$fetch['varos'].'</option>';
				}
				?>
			</select>
   		</div>
		<br>
		<div class="form-group">
   			<input type="submit" value="Elküld" class="form-control"/>
		</div>
	</form>
</div>

<hr>
<div class="container">
	<h1>Nyilvántartott áruk listája</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
			<th>Márka</th>
			<th>Név</th>
			<th>Beszerzési ár</th>
			<th>Szín</th>
			<th>Raktár</th>
			<th>Műveletek</th>
		</tr>

	<?php

		$aruk = aruk_lekerdez();

		while($fetch = mysqli_fetch_assoc($aruk)) {
			$adottRaktar = mysqli_fetch_assoc(specific_raktar_lekerdez($fetch['raktar_azonosito']));
			
			echo '<tr>';
			echo '<td>'. $fetch["marka"] .'</td>';
			echo '<td>'. $fetch["nev"] .'</td>';
			echo '<td>'. $fetch["beszerzesi_ar"] .'</td>';
			echo '<td>'. $fetch["szin"] .'</td>';
			echo '<td>'. $fetch["raktar_azonosito"]. ' - ' . $adottRaktar['varos'] .'</td>';
			echo '<td><a href="delete_aru.php?id='.$fetch['azonosito'].'">Törlés</a></td>';
			echo '</tr>';
		} 
		mysqli_free_result($aruk);

	?>
</table>


</body>
</html>
