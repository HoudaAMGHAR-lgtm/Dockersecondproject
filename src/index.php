<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>📜 Dieux et Pharaons d'Égypte 🇪🇬</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Font pour un effet hiéroglyphique -->
    <link href="https://fonts.googleapis.com/css2?family=Papyrus&display=swap" rel="stylesheet">
    <script>
        function afficherBanniere() {
            document.getElementById('banniere').classList.toggle('afficher');
        }
    </script>
   <style>
    .banniere {
            position: fixed;
            top: 20px;
            right: -100%;
            background-color: gold;
            color: black;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            transition: right 1s ease-in-out;
        }
        .afficher {
            right: 10px;
        }
    .btn{   
        background-color: #8B4513;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20px;
        position: relative; 
        left: 42%;

    }
        /* Fond style papyrus */
        body {
            background-image: url('https://www.transparenttextures.com/patterns/papyrus.png');
            background-color: #f4e4ba;
            font-family: 'Papyrus', sans-serif;cursor: url('images/brass-hour-glass-sand-clock-isolated-png.png'), wait;
        }

        /* Conteneur principal */
        .container {
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Titre doré */
        h2 {
            text-align: center;
            color: #B8860B; /* Or */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        /* Section des images de Pharaon */
        .pharaon-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .pharaon-container img {
            width: 200px;
            height: auto;
            text-align: center;
            margin-bottom: 00px;
            border: 4px solid #8B4513;
            border-radius: 10px;
            padding: 5px;
            background-color: white;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.8);
            
        }

        /* Texte de citation */
        .quote {
            font-style: italic;
            color: #8B4513;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Tableau stylisé */
        .table-container {
            overflow-x: auto;
        }

        table {
            background-color: white;
            border: 2px solid #8B4513;
        }

        thead {
            background: linear-gradient(to right, #8B4513, #B8860B);
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #8B4513;
        }

        tbody tr:hover {
            background-color: #ffebcd;
            cursor: pointer;
        }

        /* Barre de recherche */
        #search {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 2px solid #B8860B;
            border-radius: 5px;
            background-color: #fff8dc;
            font-weight: bold;
        }

        /* Footer style parchemin */
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #B8860B;
            background: linear-gradient(to right, #8B4513, #B8860B);
            margin-top: 30px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<audio id="musique">
        <source src="sounds/acceuil.mp3" type="audio/mpeg">
       
    </audio>

    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let audio = document.getElementById("musique");
            audio.play().catch(error => console.log("La lecture automatique a été bloquée."));
        });
        
        function afficherBanniere() {
            document.getElementById('banniere').classList.toggle('afficher');
        }
    </script>
<div class="container">
    <h2>🏺 Dieux et Pharaons d'Égypte Antique 👑</h2>

    <!-- Images des Pharaons -->
    <div class="pharaon-container">
        <img src="images/black-and-white-illustration-of-the-18th-dynasty-ancient-egyptian-pharaoh-akhenaten-free-png.webp" alt="Pharaon 1">
        <img src="images/pharaoh-illustration-design-free-png.webp" alt="Pharaon 2">
    </div>
    <button onclick="afficherBanniere()" class="btn btn-warning">🎭 Afficher la Bannière</button>
    <!-- Citation inspirante -->
    <p class="quote">"L'Égypte est le don du Nil, et ses dieux en sont les gardiens éternels." 🌊🌞</p>

    <!-- Barre de recherche -->
    <input type="text" id="search" placeholder="🔍 Rechercher un dieu..." onkeyup="filterTable()">

    <?php
    error_reporting(0);
    ini_set('display_errors', 0);

    // Connexion à la base de données
    $serveur = "db";
    $utilisateur = "root";
    $motDePasse = "root";
    $baseDeDonnees = "egypto";
    $conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    if ($conn->connect_error) {
        die("<div class='alert alert-danger'>Échec de la connexion : " . htmlspecialchars($conn->connect_error) . "</div>");
    }

    // Requête SQL
    $tableName = "dieu";
    $sql = "SELECT * FROM $tableName";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    // Affichage du nombre de résultats
    $rowCount = $result->num_rows;
    echo "<p class='text-center text-muted'>👑 Nombre de dieux trouvés : <strong>$rowCount</strong></p>";

    if ($rowCount > 0) {
        echo "<div class='table-container'>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead><tr>";

        while ($field = $result->fetch_field()) {
            echo "<th>" . htmlspecialchars($field->name) . "</th>";
        }
        echo "</tr></thead><tbody id='dataTable'>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning text-center'>Aucun dieu trouvé 🏺.</div>";
    }

    $stmt->close();
    $conn->close();
    ?>

</div>
<div id="banniere" class="banniere">👑 houda, thinhinane, djamel, ouerdia, abdelhak 👑</div>


<!-- Footer style parchemin -->
<div class="footer">
    © 2025 esic 
</div>
    

<!-- Filtrage dynamique -->
<script>
    function filterTable() {
        let input = document.getElementById("search").value.toLowerCase();
        let rows = document.querySelectorAll("#dataTable tr");
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>

</body>
</html>
