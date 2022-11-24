<?php
include_once('use/u_dao.php');
?>
<!doctype html>
<html lang="hu">
<head>
	<title>Raktárak</title>
	<?php include_once('use/head_imports.php'); ?>
</head>

<body>
	
<?php include_once('use/navbar.php'); ?>

<div class="container">
	<h1>Új raktár hozzáadása</h1>
</div>

<div class="container" style="width:500px;">
	<form method="POST" action="upload_raktar.php" accept-charset="utf-8">
	    <div class="form-group">
   			<label>Ország: </label>
            <input type="text" name="orszag" class="form-control" />
   		</div>
   		<br>
           <div class="form-group">
   			<label>Irányítószám: </label>
   			<input type="text" name="irsz" class="form-control" />
		</div>
		<br>
        <div class="form-group">
   			<label>Város: </label>
   			<input type="text" name="varos" class="form-control" />
		</div>
		<br>
	    <div class="form-group">
   			<label>Utca: </label>
   			<input type="text" name="utca" class="form-control" />
		</div>
		<br>
		<div class="form-group">
   			<label>Házszám: </label>
   			<input type="text" name="hazszam" class="form-control" />
		</div>
		<br>
        <div class="form-group">
   			<label>Kapacitás: </label>
   			<input type="text" name="kapacitas" class="form-control" />
		</div>
		<br>
		<div class="form-group">
   			<input type="submit" value="Elküld" class="form-control"/>
		</div>
	</form>
</div>

<hr>
<div class="container">
	<h1>Elérhető raktárak</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
			<th>Azonosító</th>
			<th>Ország</th>
			<th>Irányítószám</th>
			<th>Város</th>
            <th>Utca</th>
            <th>Házszám</th>
            <th>Kapacitás</th>
            <th>Műveletek</th>
		</tr>

	<?php

		$raktar = raktar_lekerdez();

		while($fetch = mysqli_fetch_assoc($raktar)) {			
			echo '<tr>';
			echo '<td>'. $fetch['azonosito'] .'</td>';
			echo '<td>'. $fetch["orszag"] .'</td>';
			echo '<td>'. $fetch["irsz"] .'</td>';
            echo '<td>'. $fetch["varos"] .'</td>';
            echo '<td>'. $fetch["utca"] .'</td>';
            echo '<td>'. $fetch["hazszam"] .'</td>';
            echo '<td>'. $fetch["kapacitas"] .'</td>';
			echo '<td><a href="delete_raktar.php?id='.$fetch['azonosito'].'">Törlés</a></td>';
			echo '</tr>';
		} 
		mysqli_free_result($raktar);

	?>
</table>


</body>
</html>
