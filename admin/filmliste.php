<?php

# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Liste der Filmtitel mit Auswahl zur Bearbeitung
#
# Autor: Michael Hassel
# Email: hassel@mediakontur.de
# Stand: 24.03.2021
# Version: Basisversion
# für Schulungszwecke

# Sitzung überprüfen
session_start();
if( !isset($_SESSION['login']) || $_SESSION['login'] != true ){

    die('Bitte <a href="index.php">anmelden</a>');
}

# Einbindung der Datenbankverbindung 
require '../config.php';

######## Datenbankverbindung ##########

# Objekt vom Typ PDO erstellen
$pdo = new PDO(DBSYSTEM.':dbname='.DBNAME.';host='.DBHOST.';port='.DBPORT, DBUSER, DBPASS);

?>

<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="utf-8">
    <title>Liste aller Filmtitel</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">  

</head>
<body>

<div id="header" class="border">
    <h1>Liste aller Filme</h1>
    <p>User: <?php echo $_SESSION['name']?> <a href="logout.php">abmelden</a></p>

</div>

<?php

echo '<div id="content" class="border">';

# Link für neue Filmtitel
echo '<h2><a class="linkneu" href="filmform.php?id=neu">neuer Filmtitel</a></h2>';

# Alle Filmtitel mit mit Genre, Filmgesellschaft und Anzahl der Rollen
$sql = 'SELECT f.id filmid, Titel, fg.Name Filmgesellschaft, g.Name Genre
        FROM film f
        JOIN filmgesellschaft fg ON f.Filmgesellschaft_id = fg.id
        JOIN genre g ON f.Genre_id = g.id
        ORDER BY f.Titel';

# SQL-Anweisung ausführen
$statement = $pdo->query($sql);

# Schleife zur Ausgabe der Datensätze
echo '<table class="liste">';
echo '<tr><th>Titel</th><th>Genre</th><th>Filmgesellschaft</th><th> </th><th> </th></tr>';
foreach( $statement as $datensatz ) {

    echo '<tr>';
    echo '<td><a class="filmtitel" href="filmform.php?id='.$datensatz['filmid'].'">'.$datensatz['Titel'].'</a></td>';
    echo '<td>'.$datensatz['Genre'].'</td>';
    echo '<td>'.$datensatz['Filmgesellschaft'].'</td>';
    echo '<td><a href="upload.php?id='.$datensatz['filmid'].'">Bild</a></td>';
    echo '<td><a href="filmloeschen.php?id='.$datensatz['filmid'].'">löschen</a></td>';
    echo '</tr>';

}
echo '</table>';

echo '</div>';

# Ergebnis löschen
$statement = NULL;

# Datenbankverbindung schliessen
$pdo = NULL;

?>

</body>
</html>
