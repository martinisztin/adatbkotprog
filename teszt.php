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

<br>
<div class="container">
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ujRekord">
        Új áru hozzáadása
    </button>
</div>



<!-- hozzaadas modal -->
<div class="modal fade" id="ujRekord" tabindex="-1" aria-labelledby="ujRekordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ujRekordLabel">Új áru hozzáadása</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="container" style="width:400px;">
	<form method="POST" action="upload_aru.php" accept-charset="utf-8">
		<div class="form-group">
   			<label>Márka: </label>
   			<input type="text" name="marka" class="form-control" required/>
		</div>
   		<br>
	   <div class="form-group">
   			<label>Neve: </label>
   			<input type="text" name="nev" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Beszerzési ára: </label>
   			<input type="text" name="beszerzesi_ar" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Szín: </label>
   			<input type="text" name="szin" class="form-control" required/>
   		</div>
		<br>
		<div class="form-group">
   			<label>Elhelyezkedése (melyik raktár): </label>
   			<select name="raktar_azonosito" class="form-control form-select">
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
   			<input type="submit" value="Elküld" class="form-control btn btn-primary"/>
		</div>
	</form>
</div>
      </div>
    </div>
  </div>
</div>
<!-- modal end -->

<!-- szerkesztes modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- szerjesztes modal end -->



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
			echo '<td><a class="btn btn-link" href="delete_aru.php?id='.$fetch['azonosito'].'">Törlés</a> <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">Szerkesztés</button></td>';
			echo '</tr>';
		} 
		mysqli_free_result($aruk);

	?>
</table>


</body>
</html>
