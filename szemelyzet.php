<?php
include_once('use/u_dao.php');
?>
<!doctype html>
<html lang="hu">
<head>
	<title>Személyzet</title>
	<?php include_once('use/head_imports.php'); ?>
</head>

<body>
	
<?php include_once('use/navbar.php'); ?>
<br>
<div class="container">
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ujRekord">
        Új munkatárs felvétele
	</button>
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#szerkesztesModal" <?php if(!isset($_GET['id'])) {echo 'disabled';} ?>>
  		Szerkesztés
	</button>
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#kepSzerkesztesModal" <?php if(!isset($_GET['id'])) {echo 'disabled';} ?>>
  		Fénykép szerkesztése
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
	<form enctype="multipart/form-data" method="POST" action="upload_szemely.php" accept-charset="utf-8">
	   <div class="form-group">
   			<label>Személyigazolványszám: </label>
   			<input type="text" name="szigszam" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Vezetéknév: </label>
   			<input type="text" name="vezeteknev" class="form-control" required/>
		</div>
		<br>
        <div class="form-group">
   			<label>Keresztnév: </label>
   			<input type="text" name="keresztnev" class="form-control" required/>
		</div>
        <br>
        <div class="form-group">
   			<label>Nem: </label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="nem" value="ferfi" checked>
                <label class="form-check-label" for="ferfi">Férfi</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="nem" value="no">
                <label class="form-check-label" for="no">Nő</label>
            </div>
		</div>
        <br>
        <div class="form-group">
   			<label>Születési dátum: </label>
   			<input type="date" name="szulido" class="form-control" required/>
		</div>
        <br>
        <div class="form-group">
   			<label>Személyt ábrázoló fotó: </label>
   			<input type="file" name="image" class="form-control"/>
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
<?php if(isset($_GET['id']) && $szerk_fetch = mysqli_fetch_assoc(specific_szemely_lekerdez($_GET['id']))) : ?>
	<div class="modal fade" id="szerkesztesModal" tabindex="-1" aria-labelledby="szerkesztesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="szerkesztesModalLabel">Személyi adatok szerkesztése</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	  <div class="container" style="width:400px;">
	<form method="POST" action="update_szemely.php" accept-charset="utf-8">
		<div class="form-group">

		<input type="hidden" name="szigszam" value="<?= $szerk_fetch['szigszam'] ?>" class="form-control"/>

		<label>Személyigazolványszám: </label>
   			<input type="text" name="szigszam" value="<?= $szerk_fetch['szigszam'] ?>" class="form-control" disabled/>
		</div>
		<br>
		<div class="form-group">
   			<label>Vezetéknév: </label>
   			<input type="text" name="vezeteknev" value="<?= $szerk_fetch['vezeteknev'] ?>" class="form-control" required/>
		</div>
		<br>
        <div class="form-group">
   			<label>Keresztnév: </label>
   			<input type="text" name="keresztnev" value="<?= $szerk_fetch['keresztnev'] ?>" class="form-control" required/>
		</div>
        <br>
        <div class="form-group">
   			<label>Nem: </label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="nem" value="ferfi" <?= $szerk_fetch['nem'] == 1 ? "checked" : "" ?>>
                <label class="form-check-label" for="ferfi">Férfi</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="nem" value="no" <?= $szerk_fetch['nem'] == 0 ? "checked" : "" ?>>
                <label class="form-check-label" for="no">Nő</label>
            </div>
		</div>
        <br>
        <div class="form-group">
   			<label>Születési dátum: </label>
   			<input type="date" name="szulido" value="<?= $szerk_fetch['szulido'] ?>" class="form-control" required/>
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

<!-- szerkesztes modal -->
<?php if(isset($_GET['id']) && $szerk_fetch = mysqli_fetch_assoc(specific_szemely_lekerdez($_GET['id']))) : ?>
	<div class="modal fade" id="kepSzerkesztesModal" tabindex="-1" aria-labelledby="kepSzerkesztesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kepSzerkesztesModalLabel">Személyi adatok szerkesztése</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	  <div class="container" style="width:400px;">
	<form enctype="multipart/form-data" method="POST" action="update_szemelykep.php" accept-charset="utf-8">
		<div class="form-group">

		<input type="hidden" name="szigszam" value="<?= $szerk_fetch['szigszam'] ?>" class="form-control"/>

		<div class="form-group">
   			<label>Fénykép: </label>
   			<input type="file" name="image" value="<?= $szerk_fetch['image'] ?>" class="form-control" required/>
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
</div>
<!-- modal end -->
<?php endif ?>

<hr>
<div class="container">
	<h1>Munkatársak</h1>
</div>
<div class="container">
	<table class="table table-responsive">
		<tr>
		<th>Kijelölés
				<?php if(isset($_GET['id'])) : ?>
					<a href="szemelyzet.php">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				<?php endif ?>
			</th>

			<th>Fénykép</th>

			<th>Személyigazolványszám</th>
			<th>Vezetéknév</th>
			<th>Keresztnév</th>
            <th>Nem</th>
            <th>Születési dátum</th>
            <th>Beosztás</th>
			<th>Műveletek</th>
		</tr>

	<?php

		$szemelyek = szemelyek_lekerdez();

		while($fetch = mysqli_fetch_assoc($szemelyek)) {
			$szerep = mysqli_fetch_assoc(szerep_lekerdez($fetch['szigszam']));

            if(!$szerep) $szerep['jogkor_nev'] = "Nincs beosztva";
			
			echo '<tr>';
			echo '<td class="align-middle"><input type="radio" class="form-check-input" onclick="window.location=\'szemelyzet.php?id='. $fetch['szigszam'] .'\'" name="select" value="'. $fetch['szigszam'] .'" ';
			if(isset($_GET['id']) && $_GET['id'] == $fetch['szigszam']) { echo 'checked'; }
			echo '>';
			if($fetch['image']) {
				echo '<td><img src="img/' . $fetch['image'] . '" width="100" height="100"/>';
			} else {
				echo '<td><img src="img/default.jpg" width="100"/>';
			}
			echo '<td class="align-middle">'. $fetch['szigszam'].'</td>';
			echo '<td class="align-middle">'. $fetch["vezeteknev"] .'</td>';
			echo '<td class="align-middle">'. $fetch["keresztnev"] .'</td>';
            echo '<td class="align-middle">'. ($fetch["nem"] ? "férfi" : "nő") .'</td>';
            echo '<td class="align-middle">'. $fetch["szulido"] .'</td>';
            echo '<td class="align-middle">'. $szerep['jogkor_nev'] .'</td>';
			echo '<td class="align-middle"><a class="btn btn-link" href="delete_szemely.php?id='.$fetch['szigszam'].'">Törlés</a></td>';
			echo '</tr>';
		} 
		mysqli_free_result($szemelyek);

	?>
</table>

</body>
</html>