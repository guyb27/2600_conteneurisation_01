<?php
// Fichier de recherche vulnérable à l'injection SQL

// Connexion à la base de données PostgreSQL
$host = 'db';  // Nom du service dans docker-compose
$dbname = 'vulnerable_db';
$user = 'dbuser';
$pass = 'password123';
$port = 5432;

// Connexion PostgreSQL avec PDO
try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass");
    // Configuration pour afficher les erreurs PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

// Récupération du paramètre de recherche
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Construction de la requête SQL (vulnérable à l'injection SQL)
$query = "SELECT id, username, email, role FROM users WHERE username LIKE '%" . $username . "%'";

// Exécution de la requête
try {
    $result = $conn->query($query);
} catch (PDOException $e) {
    die("Erreur d'exécution de la requête: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Résultats de recherche</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .search-form { margin: 20px 0; }
        .search-results { margin-top: 20px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .back-link { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Résultats de recherche</h1>
    
    <div class="search-form">
        <form method="GET" action="index.php">
            <label for="username">Rechercher par nom d'utilisateur:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Entrez un nom d'utilisateur">
            <button type="submit">Rechercher</button>
        </form>
    </div>
    
    <div class="search-results">
        <h2>Utilisateurs correspondant à "<?php echo htmlspecialchars($username); ?>"</h2>
        
        <?php if ($result && $result->rowCount() > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                </tr>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Aucun utilisateur trouvé.</p>
        <?php endif; ?>
    </div>
    
    <div class="back-link">
        <a href="index.php">Retour à l'accueil</a>
    </div>

    <!-- Affichage de la requête SQL pour démonstration (à retirer en production) -->
    <div style="margin-top: 30px; padding: 10px; background-color: #f8f8f8; border: 1px solid #ddd;">
        <p><strong>Requête SQL exécutée:</strong> <?php echo htmlspecialchars($query); ?></p>
    </div>
</body>
</html>

<?php
// Fermeture de la connexion (PDO se ferme automatiquement à la fin du script)
$conn = null;
?>
