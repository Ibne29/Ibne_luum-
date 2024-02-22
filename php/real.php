<?php
$host = "db";
$user = "root";
$password = "password";
$database = "prix_nobel";
$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué : " . $mysqli->connect_error);
}

// Récupérer les années distinctes
$queryYears = "SELECT DISTINCT Anne FROM prix_nobel";
$resultYears = $mysqli->query($queryYears);
$years = array();

while ($row = $resultYears->fetch_assoc()) {
    $years[] = $row['Anne'];
}

// Récupérer les catégories
$queryCategories = "SELECT Nom_catgorie FROM categorie";
$resultCategories = $mysqli->query($queryCategories);
$categories = array();

while ($row = $resultCategories->fetch_assoc()) {
    // recupere  le nom  des categories 
    $categories[] = $row['Nom_catgorie'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Graphique</title>
    <script type="text/javascript" src="../jquery-3.7.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=1.1" type="text/css" media="screen" />
</head>
<body>
<div id="entete">
        <h1>PRIX NOBEL</h1>

        <ol class="menu" id="menu">
            <li><a id="accueil" href="accueil.html">Accueil</a></li>
            <li><a id="recherche" href="recherche.php">Recherche</a></li>
            <li><a id="graphique" href="graphique.html">Graphique</a></li>
            <li><a id="connexion" href="connexion.html">Connexion</a></li>
        </ol>
    </div>

    <div class="boite">
        <div class="topBar">

                    <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Type de graphe
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick="selectChartType('bar')">Barre</a>
                    <a class="dropdown-item" href="#" onclick="selectChartType('doughnut')">Circulaire</a>
                    <a class="dropdown-item" href="#" onclick="selectChartType('polarArea')">Histogramme</a>
                    <a class="dropdown-item" href="#" onclick="selectChartType('line')">Courbe</a>
                    <a class="dropdown-item" href="#" onclick="selectChartType('bubble')">Nuage de points</a>
                    <a class="dropdown-item" href="#" onclick="selectChartType('box-plot')">Box-plot</a>
                </div>
            </div>
                        <div class="dropdown">
                <label for="selectYear">Année:</label>
                <select id="selectYear">
                    <?php
                    foreach ($years as $year) {
                        echo "<option value=\"$year\">$year</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="dropdown">
                <label for="selectGender" class="btn btn-secondary dropdown-toggle"  role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Sexe
                </label>
                <select id="selectGender"   class="dropdown-menu">
                    <option value="male" class="dropdown-item">male</option>
                    <option value="female" class="dropdown-item">female</option>
                </select>
            </div>


            <div class="dropdown">
                <label for="selectLimit">Limite:</label>
                <select id="selectLimit">
                    <option value="50">0-50</option>
                    <option value="100">50-100</option>
                    <option value="150">100-150</option>
                    <option value="200">150-200</option>
                    <option value="250">200-250</option>
                </select>
            </div>

            <button onclick="afficherDonnees()">Afficher</button>
        </div>

        <div class="contenu">
    <ul>
        <div>
            <p class="selected-graphe">Le graphe sélectionné</p>
            <canvas id="graphs"></canvas>
        </div>
    </ul>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('graphs').getContext('2d');
    var myChart;
    var selectedChartType = 'bar';
    function afficherDonnees() {
        var selectedYear = document.getElementById("selectYear").value;
        var selectedGender = document.getElementById("selectGender").value;
        var selectedLimit = document.getElementById("selectLimit").value;

        // Exécutez la requête avec les filtres sélectionnés
       // Exécutez la requête avec les filtres sélectionnés
var query = "SELECT p.*, n.Gender FROM prix_nobel p " +
            "INNER JOIN nomine n ON p.id_nomin = n.`Id-nomin` " +
            "WHERE p.Anne = " + selectedYear + " AND n.Gender = '" + selectedGender + "' LIMIT " + selectedLimit;

        $.ajax({
            type: "POST",
            url: "requete.php",  
            data: {query: query},
            success: function(response) {
                try {

                    console.log(response)
        var jsonData = JSON.parse(response);
        updateChart(jsonData, selectedChartType);// Appel de la fonction pour mettre à jour le graphique
            } catch (e) {
        console.error("Erreur lors de l'analyse JSON:", e);
    }},
            error: function(error) {
                console.log(error);
            }
        });
    }

   
    function updateChart(data, chartType) {
    console.log(data);

   // detruis le graphe 
    if (myChart) {
        myChart.destroy();
    }

    // Déterminez le type de graphique en fonction de la sélection
    switch (chartType) {
        case 'barre':
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.id_nomin),
                    datasets: [{
                        label: 'Nom du dataset',
                        data: data.map(item => item.id_prix_nobels),
                    }]
                },
            });
            break;
        case 'doughnut':
            //  à personnaliser si tu veux 
            break;
        case 'polarArea':
               //  à personnaliser si tu veux 
            break;
        case 'line':
          //  à personnaliser si tu veux 
            break;
        case 'bubble':
               //  à personnaliser si tu veux 
            break;
        case 'box-plot':
            //  à personnaliser si tu veux 
            break;
        default:
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.id_nomin),
                    datasets: [{
                        label: 'Nom du dataset',
                        data: data.map(item => item.id_prix_nobels),
                    }]
                },
            });
    }
}


function selectChartType(type) {
        selectedChartType = type;
        document.getElementById("dropdownMenuLink").innerText = "Type de graphe: " + type.charAt(0).toUpperCase() + type.slice(1);
    }
</script>

</body>
</html>
