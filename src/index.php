<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Dieux Égyptiens</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            background-color: white;
        }
        #search {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
    </style>
</head>
<body>
 
<div class="container">
    <h2>📜 Liste des Dieux Égyptiens</h2>
    <input type="text" id="search" placeholder="🔍 Rechercher..." onkeyup="filterTable()">
 
    <?php
    error_reporting(0);ini_set('display_errors', 0);
   
    $serveur = "db";
    $utilisateur = "root";
    $motDePasse = "root";
    $baseDeDonnees = "egypto";
 
 
    $conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
 
    
    if ($conn->connect_error) {
        die("<div class='alert alert-danger'>Échec de la connexion : " . htmlspecialchars($conn->connect_error) . "</div>");
    }
 
  
    $tableName = "dieu";
    $sql = "SELECT * FROM $tableName";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
 
    
    $rowCount = $result->num_rows;
    echo "<p class='text-center text-muted'>Nombre de dieux trouvés : <strong>$rowCount</strong></p>";
 
    
    if ($rowCount > 0) {
        echo "<div class='table-container'>";
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead class='table-dark'><tr>";
 
        
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
        echo "<div class='alert alert-warning text-center'>Aucun résultat trouvé.</div>";
    }
 
  
    $stmt->close();
    $conn->close();
    ?>
 
</div>
 
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
