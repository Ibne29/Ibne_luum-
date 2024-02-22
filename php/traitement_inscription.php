<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "prix_nobel";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

$sql = "INSERT INTO utilisateurs (mail, pseudo, mot_de_passe) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $email, $username, $hashed_password);

$email = $_POST['email'];
$username = $_POST['username'];
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
if ($stmt->execute()) {
    echo "Inscription réussie !";
    header("Location: index.php");
} else {
    echo "Erreur lors de l'inscription : " . $conn->error;
}

$stmt->close();
$conn->close();
?>
