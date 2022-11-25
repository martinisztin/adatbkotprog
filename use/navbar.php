<?php 

echo <<<EOL
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="index.php">DBG Raktár</a>
    </div>
    <ul class="navbar-nav me-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Személyzet
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="szemelyzet.php">Munkatársak</a></li>
        <li><a class="dropdown-item" href="beosztas.php">Beosztás</a></li>
        <li><a class="dropdown-item" href="feladatok.php">Jogkörök és feladataik</a></li>
      </ul>
    </li>
      <li class="nav-item"><a href="aruk.php" class="nav-link">Áruk</a></li>
      <li class="nav-item"><a href="mozgasok.php" class="nav-link">Mozgások</a></li>
      <li class="nav-item"><a href="keszlet.php" class="nav-link">Készlet</a></li>
      <li class="nav-item"><a href="raktar.php" class="nav-link">Raktáraink</a></li>
    </ul>
</nav>
EOL;

?>