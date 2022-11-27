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
<br>
<div class="container">
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ujRekord">
		Új raktár hozzáadása
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
	<form method="POST" action="upload_raktar.php" accept-charset="utf-8">
	    <div class="form-group">
   			<label>Ország: </label>
            <input type="text" name="orszag" class="form-control" required/>
   		</div>
   		<br>
           <div class="form-group">
   			<label>Irányítószám: </label>
   			<input type="text" name="irsz" class="form-control" required/>
		</div>
		<br>
        <div class="form-group">
   			<label>Város: </label>
   			<input type="text" name="varos" class="form-control" required/>
		</div>
		<br>
	    <div class="form-group">
   			<label>Utca: </label>
   			<input type="text" name="utca" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Házszám: </label>
   			<input type="text" name="hazszam" class="form-control" required/>
		</div>
		<br>
        <div class="form-group">
   			<label>Kapacitás: </label>
   			<input type="text" name="kapacitas" class="form-control" required/>
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
<?php if(isset($_GET['id']) && $szerk_fetch = mysqli_fetch_assoc(specific_raktar_lekerdez($_GET['id']))) : ?>
<div class="modal fade" id="szerkesztesModal" tabindex="-1" aria-labelledby="szerkesztesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="szerkesztesModalLabel">Áru szerkesztése</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	  <div class="container" style="width:400px;">
	<form method="POST" action="update_raktar.php" accept-charset="utf-8">
		<div class="form-group">

		<input type="hidden" name="azonosito" value="<?= $szerk_fetch['azonosito'] ?>" class="form-control"/>

		<label>Ország: </label>
            <input type="text" name="orszag" value="<?= $szerk_fetch['orszag'] ?>" class="form-control" required/>
   		</div>
   		<br>
           <div class="form-group">
   			<label>Irányítószám: </label>
   			<input type="text" name="irsz" value="<?= $szerk_fetch['irsz'] ?>" class="form-control" required/>
		</div>
		<br>
        <div class="form-group">
   			<label>Város: </label>
   			<input type="text" name="varos" value="<?= $szerk_fetch['varos'] ?>" class="form-control" required/>
		</div>
		<br>
	    <div class="form-group">
   			<label>Utca: </label>
   			<input type="text" name="utca" value="<?= $szerk_fetch['utca'] ?>" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Házszám: </label>
   			<input type="text" name="hazszam" value="<?= $szerk_fetch['hazszam'] ?>" class="form-control" required/>
		</div>
		<br>
        <div class="form-group">
   			<label>Kapacitás: </label>
   			<input type="text" name="kapacitas" value="<?= $szerk_fetch['kapacitas'] ?>" class="form-control" required/>
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
	<h1>Elérhető raktárak</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
			<th>Kijelölés
				<?php if(isset($_GET['id'])) : ?>
					<a href="raktar.php">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				<?php endif ?>
			</th>

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
			echo '<td><input type="radio" class="form-check-input" onclick="window.location=\'raktar.php?id='. $fetch['azonosito'] .'\'" name="select" value="'. $fetch['azonosito'] .'" ';
			if(isset($_GET['id']) && $_GET['id'] == $fetch['azonosito']) { echo 'checked'; }
			echo '>';
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
