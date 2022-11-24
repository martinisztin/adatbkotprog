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

<div class="container">
	<h1>Új mozgás nyilvántartása</h1>
</div>

<div class="container" style="width:500px;">
	<form method="POST" action="upload_mozgas.php" accept-charset="utf-8">
		<div class="form-group">
   			<label>Mozgó tárgy: </label>
   			<select name="aru_azonosito" class="form-control">
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
   			<input type="text" name="hova" class="form-control" />
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
   			<input type="text" name="mennyiseg" class="form-control" />
   		</div>
		<br>
		<div class="form-group">
   			<label>Mikor: </label>
            <input type="date" name="mikor" class="form-control" />
   		</div>
		<br>
        <div class="form-group">
   			<label>Áru mozgását figyelő személy: </label>
            <select name="felugyelo_szigszam" class="form-control">
                <?php 
                    $szemelyek = szemelyek_lekerdez();

                    while($fetch = mysqli_fetch_assoc($szemelyek)) {
                        echo '<option value="'.$fetch['szigszam'].'">'.$fetch['szigszam'].' - '.$fetch['vezeteknev'].' '.$fetch['keresztnev'].'</option>';
                    }

                ?>
            </select>        
   		</div>
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
			<th>Áru</th>
			<th>Hova szállították</th>
			<th>Mozgás iránya</th>
			<th>Mennyiség</th>
			<th>Felügyelő</th>
			<th>Műveletek</th>
		</tr>

	<?php

		$mozgasok = mozgasok_lekerdez();

		while($fetch = mysqli_fetch_assoc($mozgasok)) {
			$adottAru = mysqli_fetch_assoc(specific_aru_lekerdez($fetch['aru_azonosito']));
            $adottSzemely = mysqli_fetch_assoc(specific_szemely_lekerdez($fetch['felugyelo_szigszam']));
			
			echo '<tr>';
			echo '<td>'. $adottAru["marka"] . ' ' . $adottAru['nev'] . ' (' . $adottAru['azonosito'] . ')' .'</td>';
			echo '<td>'. $fetch["hova"] .'</td>';
			echo '<td>'. $fetch["irany"] .'</td>';
			echo '<td>'. $fetch["mennyiseg"] .'</td>';
			echo '<td>'. $fetch["felugyelo_szigszam"]. ' - ' . $adottSzemely['vezeteknev'] . ' ' . $adottSzemely['keresztnev'] . '</td>';
			echo '<td><a href="delete_mozgas.php?id='.$fetch['nyugta'].'">Törlés</a></td>';
			echo '</tr>';
		} 
		mysqli_free_result($aruk);

	?>
</table>



</body>
</html>