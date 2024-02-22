<?php
$host = "db";
$user = "root";
$password = "password";
$database = "prix_nobel";
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}

// Récupérez la requête postée via AJAX
$query = $_POST['query'];

// Exécutez la requête SQL
$result = $mysqli->query($query);

if (!$result) {
    die("Erreur dans la requête SQL: " . $mysqli->error);
}

// Convertissez les résultats en tableau associatif
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Fermez la connexion à la base de données
$mysqli->close();

// Renvoyez les résultats en format JSON
echo json_encode($data);
?>
