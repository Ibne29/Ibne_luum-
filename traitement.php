<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $pseudo = htmlspecialchars($_POST['pseudo']);

    
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "prix_nobel";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    $sql = "SELECT mot_de_passe FROM utilisateurs WHERE mail=?";

    if ($stmt = $conn->prepare($sql)) {
     
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows == 1) {
            
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['mot_de_passe'])) {
                exit();
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet email.";
        }

        $stmt->close();
    } else {
        echo "Une erreur est survenue lors de la préparation de la requête.";
    }

    $conn->close();
}
?>
