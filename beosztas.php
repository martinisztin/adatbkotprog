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
  		Munkatársak beosztása
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
	<form method="POST" action="upload_beosztas.php" accept-charset="utf-8">
	   <div class="form-group">
   			<label>Személyigazolványszám: </label>
               <?php if($test = mysqli_fetch_assoc(beosztatlan_lekerdez())) { $disabled = false; } else { $disabled = true; } ?>
               <select name="szemelyzet_szigszam" class="form-control form-select" required>
				<?php 
				$szemelyek = beosztatlan_lekerdez();
                if($disabled) {
                    echo '<option value="null">Nincs beosztatlan munkatárs</option>';
                } else {
                    while($fetch = mysqli_fetch_assoc($szemelyek)) {
                        echo '<option value='.$fetch['szigszam'].'>'.$fetch['szigszam'].' - '.$fetch['vezeteknev']. ' ' . $fetch['keresztnev'] .'</option>';
                    }
                }

				?>
			</select>
		</div>
		<br>
        <div class="form-group">
   			<label>Személyigazolványszám: </label>
               <select name="jogkor_nev" class="form-control form-select">
				<?php 
				$jogkorok = jogkorok_lekerdez();
				while($fetch = mysqli_fetch_assoc($jogkorok)) {
					echo '<option value='.$fetch['nev'].'>'. $fetch['nev'] . ' ('. $fetch['prioritas'] .')</option>';
				}
				?>
			</select>
		</div>
		<br>
		<div class="form-group">
   			<input type="submit" value="Elküld" class="form-control btn btn-primary" <?= $disabled ? " disabled" : "" ?>/>
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
        <h5 class="modal-title" id="szerkesztesModalLabel">Áru szerkesztése</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	  <div class="container" style="width:400px;">
	<form method="POST" action="update_beosztas.php" accept-charset="utf-8">
		<div class="form-group">
		    <label>Személyigazolványszám: </label>
               <select name="szemelyzet_szigszam" class="form-control form-select" required>
				<?php 
                echo '<option value='.$szerk_fetch['szigszam'].' selected>'.$szerk_fetch['szigszam'].' - '.$szerk_fetch['vezeteknev']. ' ' . $szerk_fetch['keresztnev'] .'</option>';
				$szemelyek = beosztatlan_lekerdez();
                    while($fetch = mysqli_fetch_assoc($szemelyek)) {
                        echo '<option value='.$fetch['szigszam'].'>'.$fetch['szigszam'].' - '.$fetch['vezeteknev']. ' ' . $fetch['keresztnev'] .'</option>';
                    }


				?>
			</select>
		</div>
		<br>
        <div class="form-group">
   			<label>Személyigazolványszám: </label>
               <select name="jogkor_nev" class="form-control form-select">
				<?php 
				$jogkorok = jogkorok_lekerdez();
                $our_szerep = mysqli_fetch_assoc(szerep_lekerdez($szerk_fetch['szigszam']));
				while($fetch = mysqli_fetch_assoc($jogkorok)) {
                    if($fetch['nev'] == $our_szerep['jogkor_nev']) {
                        echo '<option value='.$fetch['nev'].' selected>'. $fetch['nev'] . ' ('. $fetch['prioritas'] .')</option>';
                    }
                    else {
                        echo '<option value='.$fetch['nev'].'>'. $fetch['nev'] . ' ('. $fetch['prioritas'] .')</option>';
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
	<h1>Munkatársak</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
            <th>Kijelölés
				<?php if(isset($_GET['id'])) : ?>
					<a href="beosztas.php">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				<?php endif ?>
			</th>

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
            echo '<td><input type="radio" class="form-check-input" onclick="window.location=\'beosztas.php?id='. $fetch['szigszam'] .'\'" name="select" value="'. $fetch['szigszam'] .'" ';
			if(isset($_GET['id']) && $_GET['id'] == $fetch['szigszam']) { echo 'checked'; }
			echo '>';
			echo '<td>'. $fetch['szigszam'].'</td>';
			echo '<td>'. $fetch["vezeteknev"] .'</td>';
			echo '<td>'. $fetch["keresztnev"] .'</td>';
            echo '<td>'. ($fetch["nem"] ? "férfi" : "nő") .'</td>';
            echo '<td>'. $fetch["szulido"] .'</td>';
            echo '<td>'. $szerep['jogkor_nev'] .'</td>';
			echo '<td><a href="delete_szemely.php?id='.$fetch['szigszam'].'">Törlés</a></td>';
			echo '</tr>';
		} 
		mysqli_free_result($szemelyek);

	?>
</table>

</body>
</html>