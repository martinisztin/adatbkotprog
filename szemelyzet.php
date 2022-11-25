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
        Új munkatárs felvétele
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
	<form method="POST" action="upload_szemely.php" accept-charset="utf-8">
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
   			<input type="submit" value="Elküld" class="form-control btn btn-primary"/>
		</div>
	</form>
</div>
      </div>
    </div>
  </div>
</div>
<!-- modal end -->

<hr>
<div class="container">
	<h1>Munkatársak</h1>
</div>
<div class="container">
	<table class="table">
		<tr>
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