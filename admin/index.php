<?php



########### Einbinden von Datenbankverbindung und Funktionen ###########

# Einbindung der Datenbankverbindung
require '../config.php';
# Objekt vom Typ PDO erstellen
$pdo = new PDO(DBSYSTEM.':dbname='.DBNAME.';host='.DBHOST.';port='.DBPORT, DBUSER, DBPASS);

# Testausgaben für Verschlüsselung
// $salt = 'geheim';
// echo md5('cimdata').'<br>';
// echo hash('sha1', 'cimdata'.$salt).'<br>';
// echo password_hash('cimdata', PASSWORD_DEFAULT).'<br>';
// echo password_verify('cimdata', '$2y$10$YRWZ2rW8GjKwA2boeir9R.xiP55rC2ljtZb.yrhlKuBu9U2Nnl3ra');

################# Formulardaten empfangen ################

# Formulardaten empfangen
$name = trim( substr( filter_input( INPUT_POST, 'name' ), 0, 20 ) );
$passwort = trim( substr( filter_input( INPUT_POST, 'passwort' ), 0, 20 ) );
$button = trim( substr( filter_input( INPUT_POST, 'button' ), 0, 20 ) );


################ Prüfung und Verarbeitung der Formulardaten ###############

# wurden Formulardaten versendet?
if( $button == 'Login' ){

    ################ Prüfung der Formulardaten ##################
    
    # SQL für Benutzer-Name
    $sql = 'SELECT * FROM benutzer WHERE Name = :name';
    $statement = $pdo->prepare($sql);
	$statement->bindParam(':name', $name);
    $statement->execute();

    # gibt es diesen Benutzer, dann Passwort überprüfen
    if( $statement->rowCount() == 1 ){

        $datensatz = $statement->fetch(PDO::FETCH_ASSOC);

        $statement = NULL;

        # stimmt das Passwort, dann Sitzung starten
        if( password_verify($passwort, $datensatz['Passwort']) ){

            # Sitzung starten
            session_start();
            $_SESSION['name'] = $name;
            $_SESSION['login'] = true;

            # Weiterleitung zur Filmliste
            header('Location: filmliste.php');

        }
        # Passwort stimmt nicht
        else{
            $meldung[] = 'Login nicht korrekt';
        }

    }
    # Benutzer gibt es nicht
    else{

        $meldung[] = 'Login nicht korrekt';
    }

}

# Datenbankverbindung schliessen
$pdo = NULL;

?>

<!DOCTYPE html>
<html lang="de">
    <head>

        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">  

    </head>
    <body>

        <div id="header" class="border">

            <h1>Login Filmkatalog</h1>

        </div>

        <div id="content" class="border">

            <p class="fehler">
                <?php 
                if(isset($meldung)){
                    echo implode('<br>', $meldung); 
                }
                ?>
            </p>

            <div id="formular">

                <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post">

                    <section id="section_input">
                        <label class="form_label" for="name">Name</label>
                        <input class="form_input form_input_login" type="text" name="name" id="name" maxlength="20">

                        <label class="form_label" for="passwort">Passwort</label>
                        <input class="form_input form_input_login" type="password" name="passwort" id="passwort" maxlength="20">
                    </section>

                    <section id="section_input">
                        <button class="form_input form_button" type="submit" name="button" value="Login">Login</button>
                    </section>

                </form>

            </div>

        </div>

    </body>
</html>
