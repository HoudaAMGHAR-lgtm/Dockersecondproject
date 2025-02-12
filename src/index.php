<?php
// Paramètres de connexion à la base de données
$serveur = "db"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motDePasse = "root"; // Mot de passe MySQL
$baseDeDonnees = "egypto"; // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Requête SQL pour récupérer les données
$tableName = "dieu"; // Nom de la table à interroger
$sql = "SELECT * FROM $tableName";
$result = $conn->query($sql);

// Affichage des résultats dans un tableau HTML
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";
    // Afficher les noms des colonnes
    while ($field = $result->fetch_field()) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr>";
    
    // Afficher les données
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun résultat trouvé.";
}

// Fermer la connexion
$conn->close();
?>