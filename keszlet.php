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
<br>
<div class="container">
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ujRekord">
		Új készlet nyilvántartása
	</button>
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#szerkesztesModal" <?php if(!isset($_GET['id'])) {echo 'disabled';} ?>>
  		Szerkesztés
	</button>
</div>

<!-- Modal -->
<div class="modal fade" id="ujRekord" tabindex="-1" aria-labelledby="ujRekordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ujRekordLabel">Új áru hozzáadása</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="container" style="width:400px;">
	<form method="POST" action="upload_keszlet.php" accept-charset="utf-8">
	<div class="form-group">
   			<label>Áru azonosítója: </label>
   			<select name="aru_azonosito" class="form-control form-select">
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
   			<input type="text" name="mennyiseg" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Következő érkezés: </label>
   			<input type="date" name="kovetkezo_erkezes" class="form-control" required/>
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
<?php if(isset($_GET['id']) && $szerk_fetch = mysqli_fetch_assoc(specific_keszlet_lekerdez($_GET['id']))) : ?>
<div class="modal fade" id="szerkesztesModal" tabindex="-1" aria-labelledby="szerkesztesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="szerkesztesModalLabel">Áru szerkesztése</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	  <div class="container" style="width:400px;">
	<form method="POST" action="update_keszlet.php" accept-charset="utf-8">
		<div class="form-group">

		<label>Áru azonosítója: </label>
   			<select name="aru_azonosito" class="form-control form-select">
				<?php 
				$aruk = aruk_lekerdez();
				while($fetch = mysqli_fetch_assoc($aruk)) {
					if($fetch['azonosito'] == $szerk_fetch['aru_azonosito']) {
						echo '<option value='.$fetch['azonosito'].' selected>'.$fetch['azonosito'].' - '.$fetch['marka']. ' ' . $fetch['nev'] .'</option>';
					}
					else {
						echo '<option value='.$fetch['azonosito'].'>'.$fetch['azonosito'].' - '.$fetch['marka']. ' ' . $fetch['nev'] .'</option>';
						}
					}
				?>
			</select>
   		</div>
   		<br>
	   <div class="form-group">
   			<label>Mennyiség: </label>
   			<input type="text" name="mennyiseg" value="<?= $szerk_fetch['mennyiseg'] ?>" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Következő érkezés: </label>
   			<input type="date" name="kovetkezo_erkezes" value="<?= $szerk_fetch['kovetkezo_erkezes'] ?>" class="form-control" required/>
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
<?php endif ?>

<hr>
<div class="container">
	<h1>Készlet állapota</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
			<th>Kijelölés
				<?php if(isset($_GET['id'])) : ?>
					<a href="keszlet.php">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				<?php endif ?>
			</th>

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
			echo '<td><input type="radio" class="form-check-input" onclick="window.location=\'keszlet.php?id='. $fetch['aru_azonosito'] .'\'" name="select" value="'. $fetch['aru_azonosito'] .'" ';
			if(isset($_GET['id']) && $_GET['id'] == $fetch['aru_azonosito']) { echo 'checked'; }
			echo '>';
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
