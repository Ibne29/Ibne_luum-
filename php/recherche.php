<!DOCTYPE html>
<html>
<head>
	<title>Recherche</title>
	<script type="text/javascript" src="../jquery-3.7.1.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css?v=1.1" type="text/css" media="screen" />
</head>
<body>
	<div id="entete">
		<h1>PRIX NOBEL</h1>

		<ol class="menu" id="menu">

        <li><a id = "accueil" href="accueil.html">Accueil</a></li>
        <li><a id = "recherche" href="recherche.php">Recherche</a></li>
        <li><a id = "graphique" href="graphique.html">Graphique</a></li>
        <li><a id = "connexion" href="connexion.html">Connexion</a></li>

		</ol>
	</div>
	<div class="boite">
		<div class="topBar">
			<div id="search">
				<nav class="navbar navbar-light bg-light rounded-pill col-lg-12">
  					<div class="container-fluid">
    					<form class="d-flex">
      					<input class="form-control me-2 col-lg-12" type="search" placeholder="Rechercher" aria-label="Rechercher" id="bar">
      					<button class="btn btn-outline-success" type="submit">Recherche</button>
    					</form>
  					</div>
				</nav>
			</div>
			<div class="dropdown">
  				<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    				Filtres
 				</a>

  				<div class="dropdown-menu">
    				<a class="dropdown-item" href="#">Filtre1</a>
   				<a class="dropdown-item" href="#">Filtre2</a>
    				<a class="dropdown-item" href="#">Filtre3</a>
  				</div>
			</div>
		</div>
		<div class="contenu">
			<ul>
				
			</ul>
		</div>
	</div>
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>