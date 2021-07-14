<?php

# Konfiguratinsdatei einbinden
require 'config.php';

######## Datenbankverbindung ##########

# Objekt vom Typ PDO erstellen
$pdo = new PDO(DBSYSTEM.':dbname='.DBNAME.';host='.DBHOST.';port='.DBPORT, DBUSER, DBPASS);

######## GET-Parameter ##########

# GET-Parameter empfangen und in integer wandeln
$genre_id = filter_input(INPUT_GET, 'genre_id', FILTER_VALIDATE_INT);


?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8"/>
        <title>Didi's Filmbude</title>
        <link rel="stylesheet" href="css/styles.css" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

        <header id="header">

            <div id="logo">
                <img src="bilder/filmrolle.svg" alt="Didi's Logo">
            </div>

            <h1>Didi's Filmbude</h1>
        
        </header>
        
        <input type="checkbox" id="checkbox-hamburger">
        <label for="checkbox-hamburger" class="label-hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </label>

        <nav id="nav">
<?php

########### Navigation Genre ############

# SQL für Genre
$sql = 'SELECT * FROM genre ORDER BY Name';

# SQL ausführen
$statement = $pdo->query($sql);

# Datensätze durchlaufen und darstellen
echo '<ul>';
foreach( $statement as $datensatz ){

	echo '<li><a href="'.filter_input(INPUT_SERVER, 'SCRIPT_NAME').'?genre_id='.$datensatz['id'].'">'.$datensatz['Name'].'</a></li>';
}
echo '</ul>';


# Ergebnis aus dem Speicher löschen
unset($statement);

?>

        </nav>

        <div id="content">

            <main id="main">

                <h2>Top-Filme</h2>

                <div id="product-container">

<?php

# wurde ein Genre geklickt, dann Filme darstellen
if( is_int($genre_id) ){

	# SQL für Filme eines bestimmten Genre
	$sql = 'SELECT * FROM film WHERE Genre_id = :genre_id ORDER BY Titel';
	# SQL mit Platzhaltern vorbereiten
	$statement = $pdo->prepare($sql);
	# Platzhalter durch Variable ersetzen, nur integer, nur 2-stellig
	$statement->bindParam(':genre_id', $genre_id, PDO::PARAM_INT, 3);
	# SQL ausführen
	$statement->execute();
}
# kein Genre geklickt, dann die 10 neuesten Filme
else{

	# SQL für Filme eines bestimmten Genre
	$sql = 'SELECT * FROM film ORDER BY Erscheinungsdatum DESC';
	# SQL ausführen
	$statement = $pdo->query($sql);

}

# Datensätze durchlaufen und ausgeben
foreach( $statement as $datensatz ){

    echo '<figure class="product">
        <img src="'.BPATH.$datensatz['Bild'].'" alt="'.$datensatz['Titel'].'"/>
        <figcaption>
            <h3>'.$datensatz['Titel'].'</h3>
            <p>'.$datensatz['Erscheinungsdatum'].'</p>
        </figcaption>
    </figure>';

}
# Ergebnis löschen
$statement = NULL;



# Datenbankverbindung schliessen
$pdo = NULL;



?>
                </div>
        
            </main>

            <aside id="aside">

                <h2>News</h2>

                <ul>
                    <li><a href="#">Kino wird teuer</a></li>
                    <li><a href="#">Netflix besser als Amazon</a></li>
                    <li><a href="#">Recycling-Filme</a></li>
                    <li><a href="#">Vegane Filme</a></li>
                    <li><a href="#">des Kaisers neue Filme</a></li>
                </ul>

                <h2>Infos</h2>

                <p>
                    Auch gibt es niemanden, der den Schmerz an sich liebt, sucht oder wünscht, nur, weil er Schmerz ist, es sei denn, es kommt zu zufälligen Umständen, in denen Mühen und Schmerz ihm große Freude bereiten können. Um ein triviales Beispiel zu nehmen, wer von uns unterzieht sich je anstrengender körperlicher Betätigung, außer um Vorteile daraus zu ziehen?
                </p>

            </aside>

        </div>

        <footer id="footer">
            Footerbereich
        </footer>
        
    </body>

</html>