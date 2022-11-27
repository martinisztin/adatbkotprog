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
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ujRekord">
  		Új áru hozzáadása
	</button>
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#statisztika">
  		Statisztika
	</button>
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#szerkesztesModal" <?php if(!isset($_GET['id'])) {echo 'disabled';} ?>>
  		Szerkesztés
	</button>
	<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#szuresModal">
  		Szűrés
	</button>
	<?php if(isset($_GET['marka'])) : ?>
		<a class="btn btn-danger" href="aruk.php">Szűrés törlése</a>
	<?php endif ?>
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
<?php if(isset($_GET['id']) && $szerk_fetch = mysqli_fetch_assoc(specific_aru_lekerdez($_GET['id']))) : ?>
<div class="modal fade" id="szerkesztesModal" tabindex="-1" aria-labelledby="szerkesztesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="szerkesztesModalLabel">Áru szerkesztése</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	  <div class="container" style="width:400px;">
	<form method="POST" action="update_aru.php" accept-charset="utf-8">
		<div class="form-group">

		<input type="hidden" name="azonosito" value="<?= $szerk_fetch['azonosito'] ?>" class="form-control"/>

   			<label>Márka: </label>
   			<input type="text" name="marka" value="<?= $szerk_fetch['marka'] ?>" class="form-control" required/>
		</div>
   		<br>
	   <div class="form-group">
   			<label>Neve: </label>
   			<input type="text" name="nev" value="<?= $szerk_fetch['nev'] ?>" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Beszerzési ára: </label>
   			<input type="text" name="beszerzesi_ar" value="<?= $szerk_fetch['beszerzesi_ar'] ?>" class="form-control" required/>
		</div>
		<br>
		<div class="form-group">
   			<label>Szín: </label>
   			<input type="text" name="szin" value="<?= $szerk_fetch['szin'] ?>" class="form-control" required/>
   		</div>
		<br>
		<div class="form-group">
   			<label>Elhelyezkedése (melyik raktár): </label>
   			<select name="raktar_azonosito" value="<?= $szerk_fetch['raktar_azonosito'] ?>" class="form-control form-select">
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
<?php endif ?>

<!-- szures modal -->
<div class="modal fade" id="szuresModal" tabindex="-1" aria-labelledby="szuresModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="szuresModalLabel">Szűrés márka szerint</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	  <div class="container" style="width:400px;">
	<form method="GET" action="aruk.php" accept-charset="utf-8">
		<div class="form-group">
   			<label>Márka: </label>
   			<select name="marka" class="form-control form-select">
				<?php 
				$szurestargyak = markak_lekerdez();
				while($fetch = mysqli_fetch_assoc($szurestargyak)) {
					echo '<option value='.$fetch['marka'].'>'.$fetch['marka'].'</option>';
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

<!-- stat modal -->
<div class="modal fade" id="statisztika" tabindex="-1" aria-labelledby="statisztikaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statisztikaLabel">Statisztika</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
	 	<div class="container" style="width:400px;">
				<h3>2022-ben márka szerint ezek az áruk érkeznek még!</h1>
				<table class="table">
					<tr>
						<th>Márka</th>
						<th>Darab</th>
					</tr>

					<?php
						
						$szurt_aruk = idei_erkezo_marka_statisztika();

						while($fetch = mysqli_fetch_assoc($szurt_aruk)) {
							echo '<tr>';
							echo '<td>' . $fetch['marka'] . '</td>';
							echo '<td>' . $fetch['darab'] . '</td>';
							echo '</tr>';
						}

						mysqli_free_result($szurt_aruk);
						?>

				</table>
				<hr>
				<br>
				<h3>A legsűrűbben eladott márka!</h3>
				<?php
					$leghiresebb = mysqli_fetch_assoc(legeladottabb_marka());

				?>
				<table class="table">
					<tr>
						<th>Termék</th>
						<th>Eladások száma</th>
					</tr>
					<tr>
						<td><?= $leghiresebb['marka'] . ' ' . $leghiresebb['nev'] ?></td>
						<td><?= $leghiresebb['eladas'] ?></td>
					</tr>
				</table>
		</div>

      </div>
    </div>
  </div>
</div>
<!-- modal end -->



<hr>
<div class="container">
	<h1>Nyilvántartott áruk listája</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
			<th>Kijelölés
				<?php if(isset($_GET['id'])) : ?>
					<?php if(isset($_GET['marka'])) : ?>
						<a href="aruk.php?marka=<?= $_GET['marka'] ?>">
					<?php else: ?>
						<a href="aruk.php">
					<?php endif ?>
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
				<?php endif ?>
			</th>

			<th>Márka</th>
			<th>Név</th>
			<th>Beszerzési ár</th>
			<th>Szín</th>
			<th>Raktár</th>
			<th>Műveletek</th>
		</tr>

	<?php
		if(isset($_GET['marka'])) {
			$szurt_aruk = specific_aru_by_marka($_GET['marka']);

			while($fetch = mysqli_fetch_assoc($szurt_aruk)) {
				$adottRaktar = mysqli_fetch_assoc(specific_raktar_lekerdez($fetch['raktar_azonosito']));

				echo '<tr>';
				if(isset($_GET['marka'])) {
					echo '<td><input type="radio" class="form-check-input" onclick="window.location=\'aruk.php?marka='.$_GET['marka'].'&id='. $fetch['azonosito'] .'\'" name="select" value="'. $fetch['azonosito'] .'" ';
				} else {
					echo '<td><input type="radio" class="form-check-input" onclick="window.location=\'aruk.php?id='. $fetch['azonosito'] .'\'" name="select" value="'. $fetch['azonosito'] .'" ';
				}
				if(isset($_GET['id']) && $_GET['id'] == $fetch['azonosito']) { echo 'checked'; }
				echo '>';
				echo '<td>'. $fetch["marka"] .'</td>';
				echo '<td>'. $fetch["nev"] .'</td>';
				echo '<td>'. $fetch["beszerzesi_ar"] .'</td>';
				echo '<td>'. $fetch["szin"] .'</td>';
				echo '<td>'. $fetch["raktar_azonosito"]. ' - ' . $adottRaktar['varos'] .'</td>';
				echo '<td><a class="btn btn-link" href="delete_aru.php?id='.$fetch['azonosito'].'">Törlés</a>';
				echo '</tr>';
			}
		
		}
		else {
			$aruk = aruk_lekerdez();

			while($fetch = mysqli_fetch_assoc($aruk)) {
				$adottRaktar = mysqli_fetch_assoc(specific_raktar_lekerdez($fetch['raktar_azonosito']));
				
				echo '<tr>';
				echo '<td><input type="radio" class="form-check-input" onclick="window.location=\'aruk.php?id='. $fetch['azonosito'] .'\'" name="select" value="'. $fetch['azonosito'] .'" ';
				if(isset($_GET['id']) && $_GET['id'] == $fetch['azonosito']) { echo 'checked'; }
				echo '>';
				echo '<td>'. $fetch["marka"] .'</td>';
				echo '<td>'. $fetch["nev"] .'</td>';
				echo '<td>'. $fetch["beszerzesi_ar"] .' Ft</td>';
				echo '<td>'. $fetch["szin"] .'</td>';
				echo '<td>'. $fetch["raktar_azonosito"]. ' - ' . $adottRaktar['varos'] .'</td>';
				echo '<td><a class="btn btn-link" href="delete_aru.php?id='.$fetch['azonosito'].'">Törlés</a>';
				echo '</tr>';
			} 
			mysqli_free_result($aruk);
		}


	?>
</table>


</body>
</html>
