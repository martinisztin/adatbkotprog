<?php
include_once('use/u_dao.php');
?>
<!doctype html>
<html lang="hu">
<head>

	<title>Mozgások</title>
	<?php include_once('use/head_imports.php'); ?>
</head>

<body>
	
<?php include_once('use/navbar.php'); ?>
<br>
<div class="container">
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ujRekord">
		Új mozgás nyilvántartása
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
	<form method="POST" action="upload_mozgas.php" accept-charset="utf-8">
		<div class="form-group">
   			<label>Mozgó tárgy: </label>
   			<select name="aru_azonosito" class="form-control form-select">
				<?php 
				$aruk = aruk_lekerdez();
				while($fetch = mysqli_fetch_assoc($aruk)) {
					echo '<option value='.$fetch['azonosito'].'>'.$fetch['azonosito'].' - '.$fetch['marka'].' '.$fetch['nev'].'</option>';
				}
				?>
			</select>
		</div>
   		<br>
	   <div class="form-group">
   			<label>Hova szállították: </label>
   			<input type="text" name="hova" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Merre irányul a mozgás: </label>
   			<select name="irany" class="form-control">
                <option value="kifele">Kifele</option>
                <option value="befele">Befele</option>
            </select>
		</div>
		<br>
		<div class="form-group">
   			<label>Mennyiség: </label>
   			<input type="text" name="mennyiseg" class="form-control" required/>
   		</div>
		<br>
		<div class="form-group">
   			<label>Mikor: </label>
            <input type="date" name="mikor" class="form-control" required/>
   		</div>
		<br>
        <div class="form-group">
   			<label>Áru mozgását figyelő személy: </label>
            <select name="felugyelo_szigszam" class="form-control form-select">
                <?php 
                    $szemelyek = szemelyek_lekerdez();

                    while($fetch = mysqli_fetch_assoc($szemelyek)) {
                        echo '<option value="'.$fetch['szigszam'].'">'.$fetch['szigszam'].' - '.$fetch['vezeteknev'].' '.$fetch['keresztnev'].'</option>';
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
<?php if(isset($_GET['id']) && $szerk_fetch = mysqli_fetch_assoc(specific_mozgas_lekerdez($_GET['id']))) : ?>
<div class="modal fade" id="szerkesztesModal" tabindex="-1" aria-labelledby="szerkesztesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="szerkesztesModalLabel">Mozgás szerkesztése</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	  <div class="container" style="width:400px;">
	<form method="POST" action="update_mozgas.php" accept-charset="utf-8">
		<div class="form-group">

		<input type="hidden" name="nyugta" value="<?= $szerk_fetch['nyugta'] ?>" class="form-control"/>

		<label>Mozgó tárgy: </label>
   			<select name="aru_azonosito" class="form-control form-select">
				<?php 
				$aruk = aruk_lekerdez();
				while($fetch = mysqli_fetch_assoc($aruk)) {
					if($fetch['azonosito'] == $szerk_fetch['aru_azonosito']) {
						echo '<option value='.$fetch['azonosito'].' selected>'.$fetch['azonosito'].' - '.$fetch['marka'].' '.$fetch['nev'].'</option>';
					}
					else {
						echo '<option value='.$fetch['azonosito'].'>'.$fetch['azonosito'].' - '.$fetch['marka'].' '.$fetch['nev'].'</option>';
					} 
				}

				?>
			</select>
		</div>
   		<br>
	   <div class="form-group">
   			<label>Hova szállították: </label>
   			<input type="text" name="hova" value="<?= $szerk_fetch['hova'] ?>" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Merre irányul a mozgás: </label>
   			<select name="irany" class="form-control">
                <option value="kifele">Kifele</option <?= $szerk_fetch['irany'] == "Kifele" ? "selected" : ""?>>
                <option value="befele">Befele</option <?= $szerk_fetch['irany'] == "Befele" ? "selected" : ""?>>
            </select>
		</div>
		<br>
		<div class="form-group">
   			<label>Mennyiség: </label>
   			<input type="text" name="mennyiseg" value="<?= $szerk_fetch['mennyiseg'] ?>" class="form-control" required/>
   		</div>
		<br>
		<div class="form-group">
   			<label>Mikor: </label>
            <input type="date" name="mikor" value="<?= $szerk_fetch['mikor'] ?>" class="form-control" required/>
   		</div>
		<br>
        <div class="form-group">
   			<label>Áru mozgását figyelő személy: </label>
            <select name="felugyelo_szigszam" class="form-control form-select">
                <?php 
                    $szemelyek = szemelyek_lekerdez();

                    while($fetch = mysqli_fetch_assoc($szemelyek)) {
						if($fetch['szigszam'] == $szerk_fetch['felugyelo_szigszam']) {
							echo '<option value="'.$fetch['szigszam'].'" selected>'.$fetch['szigszam'].' - '.$fetch['vezeteknev'].' '.$fetch['keresztnev'].'</option>';

						} else {
							echo '<option value="'.$fetch['szigszam'].'">'.$fetch['szigszam'].' - '.$fetch['vezeteknev'].' '.$fetch['keresztnev'].'</option>';
						}
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
<?php endif ?>

<hr>
<div class="container">
	<h1>Nyilvántartott áruk listája</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
			<th>Kijelölés
				<?php if(isset($_GET['id'])) : ?>
					<a href="mozgasok.php">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				<?php endif ?>
			</th>

			<th>Áru</th>
			<th>Hova szállították</th>
			<th>Mozgás iránya</th>
			<th>Mennyiség</th>
			<th>Mozgás dátuma</th>
			<th>Felügyelő</th>
			<th>Műveletek</th>
		</tr>

	<?php

		$mozgasok = mozgasok_lekerdez();

		while($fetch = mysqli_fetch_assoc($mozgasok)) {
			$adottAru = mysqli_fetch_assoc(specific_aru_lekerdez($fetch['aru_azonosito']));
            $adottSzemely = mysqli_fetch_assoc(specific_szemely_lekerdez($fetch['felugyelo_szigszam']));
			
			echo '<tr>';
			echo '<td><input type="radio" class="form-check-input" onclick="window.location=\'mozgasok.php?id='. $fetch['nyugta'] .'\'" name="select" value="'. $fetch['nyugta'] .'" ';
			if(isset($_GET['id']) && $_GET['id'] == $fetch['nyugta']) { echo 'checked'; }
			echo '>';
			echo '<td>'. $adottAru["marka"] . ' ' . $adottAru['nev'] . ' (' . $adottAru['azonosito'] . ')' .'</td>';
			echo '<td>'. $fetch["hova"] .'</td>';
			echo '<td>'. $fetch["irany"] .'</td>';
			echo '<td>'. $fetch["mennyiseg"] .'</td>';
			echo '<td>'. $fetch["mikor"] .'</td>';
			echo '<td>'. $fetch["felugyelo_szigszam"]. ' - ' . $adottSzemely['vezeteknev'] . ' ' . $adottSzemely['keresztnev'] . '</td>';
			echo '<td><a href="delete_mozgas.php?id='.$fetch['nyugta'].'">Törlés</a></td>';
			echo '</tr>';
		} 
		mysqli_free_result($aruk);

	?>
</table>



</body>
</html>