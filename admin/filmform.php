<?php

# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Formular für Filmtitel
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

########### Einbinden von Datenbankverbindung ###########

# Einbindung der Datenbankverbindung 
require '../config.php';
# Einbindung der Funktionen
require '../funktionen.php';
# Objekt vom Typ PDO erstellen
$pdo = new PDO(DBSYSTEM.':dbname='.DBNAME.';host='.DBHOST.';port='.DBPORT.';charset=UTF8', DBUSER, DBPASS);


################# Formulardaten empfangen ################

# alle Formularfelder empfangen und Variablen merken
$id = @$_REQUEST['id'];
$genre_id = filter_input( INPUT_POST, 'genre_id' );
$titel = trim( filter_input( INPUT_POST, 'titel' ) );
$beschreibung = trim( filter_input( INPUT_POST, 'beschreibung' ) );
$datum = trim( filter_input( INPUT_POST, 'datum' ) );
$dauer = trim( filter_input( INPUT_POST, 'dauer' ) );
$button = filter_input( INPUT_POST, 'button' );


################ Prüfung und Verarbeitung der Formulardaten ###############

# wurden Formulardaten empfangen?
if( isset($button) ){
	
  
    ################ Prüfung der Formulardaten ##################

    # Pflichtfelder nicht ausgefüllt
    if( !$genre_id ){
        $meldung[] = 'Bitte wählen Sie ein Genre aus'; 
    }
    if( strlen($titel) == 0 ){
        $meldung[] = 'Bitte geben Sie einen Titel ein'; 
    }
    # ist Dauer angegeben und der Datentyp für Dauer stimmt nicht
    if( strlen($dauer) > 0 && ( !is_numeric($dauer) || $dauer <= 0 ) ){
        $meldung[] = 'Bitte geben Sie einen positiven Zahlenwert für Dauer ein'; 
    }
    # ist Datum angegeben und nicht gültig
    if( strlen($datum) > 0 && !my_checkdate($datum) ){
        $meldung[] = 'Bitte geben Sie ein gültiges Datum ein';
    }

    
    ################ Verarbeitung der Formulardaten #############
    
    # keine Meldung, dann speichern
    if( !isset($meldung) ){


        ########### SQL INSERT/UPDATE ########

        # neuer Film, dann INSERT
        if( $id == 'neu' ){
            # neuen Film-Datensatz anlegen
            $sql = 'INSERT INTO film ( Genre_id, Titel, Beschreibung, Erscheinungsdatum, DauerInMinuten)
                    VALUES (:genre_id, :titel, :beschreibung, :datum, :dauer)';
            
            $statement = $pdo->prepare($sql);
        }
        # vorhandener Film, dann UPDATE
        else{

            # vorhandenen Film ändern
            $sql = 'UPDATE film SET Genre_id = :genre_id, Titel = :titel, Beschreibung = :beschreibung, Erscheinungsdatum = :datum, DauerInMinuten = :dauer
                    WHERE id = :id';

            $statement = $pdo->prepare($sql);
            # zusätzlicher Parameter für ID
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

        }

        ############ Formulardaten aufbereiten ########## 

        # bestimmte Daten für SQL aufbereiten (z.B. wegen NULL-Werten)
        if( !$beschreibung ){
            $beschreibung = NULL;
        }
        if( !$datum ){
            $sqldatum = NULL;
        }
        # Datum angegeben, dann in das MySQL-Format wandeln
        else{
            $sqldatum = date('Y-m-d', strtotime($datum) );
        }
        if( !$dauer ){
            $dauer = NULL;
        }

        ############ Formulardaten einfügen und speichern ###########

        # alle weiteren Parameter, die für beide SQL-Anweisungen gleich sind
        $statement->bindParam(':genre_id', $genre_id, PDO::PARAM_INT);
        $statement->bindParam(':titel', $titel, PDO::PARAM_STR);
        $statement->bindParam(':beschreibung', $beschreibung, PDO::PARAM_STR);
        $statement->bindParam(':datum', $sqldatum, PDO::PARAM_STR);
        $statement->bindParam(':dauer', $dauer, PDO::PARAM_INT);
        $statement->execute();

        # Rücksprung zur Filmliste
        # header() bringt eine Zeile im HTTP-Header unter
        # Location veranlasst den Browser selbstständig eine neue Datei anzufordern
        # vor dem Aufruf der Funktion darf nichts mit echo oder HTML ausgegeben sein
        header('Location: filmliste.php');

    }
}

############ vorhandenen Filmtitel aus der Datenbank holen ###########

elseif($id != "neu" && strlen($id) > 0){

    # Filmtitel aus der Datenbank holen, um ihn im Formular darzustellen
    $sql = 'SELECT * FROM film WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $datensatz = $statement->fetch(PDO::FETCH_ASSOC);
    $statement = NULL;

    # Daten aus Datensatz in die Variablen für das Formular speichern
    $titel = $datensatz['Titel'];
    $genre_id = $datensatz['Genre_id'];
    $beschreibung = $datensatz['Beschreibung'];
    # steht ein Datum in der Datenbank, dann in das deutsche Format wandeln
    if( $datensatz['Erscheinungsdatum'] ){
        $datum = date( 'd.m.Y', strtotime( $datensatz['Erscheinungsdatum'] ) ); 
    }
    else{
        $datum = NULL;
    }
    $dauer = $datensatz['DauerInMinuten'];

}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    
    <meta charset="utf-8">
    <title>Filmtitel bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">  

</head>
<body>

<div id="header" class="border">
    <h1>Filmtitel bearbeiten</h1>
</div>
    
<div id="content" class="border">

    <h2>Filmtitel</h2>

    <div id="formular">

        <p class="fehler">
            <?php 
            if( isset($meldung) ){
                echo implode('<br>', $meldung); 
            }
            ?>
        </p>

        <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>">

        <section id="section_select">

            <!-- alle Genres -->

            <label class="form_label" for="genre_id">Genres *</label>
            <select class="form_input form_input_select" name="genre_id" id="genre_id">
                <option class="form_option" value="0">Bitte auswählen</option>	
                <?php	

                # Auswahlfelder für Genres generieren
                $sql = 'SELECT * FROM genre ORDER BY Name';
                $statement = $pdo->query($sql);
                foreach( $statement as $datensatz ){

                    # versendetes Genre wieder vorauswählen
                    if( $genre_id == $datensatz['id'] ){
                        $selected = 'selected';
                    }
                    else{
                        $selected = '';
                    }

                    echo '<option '.$selected.' class="form_option" value="'.$datensatz['id'].'">'.$datensatz['Name'].'</option>';
                }
                $statement = NULL;

                ?>
            </select>

        </section>

        <section id="section_input">

            <label class="form_label" for="titel">Filmtitel *</label>
            <input class="form_input" type="text" name="titel" id="titel" maxlength="150" value="<?php echo $titel; ?>">

            <label class="form_label" for="beschreibung">Beschreibung</label>
            <textarea class="form_input form_text" name="beschreibung" id="beschreibung"><?php echo $beschreibung; ?></textarea>

            <label class="form_label" for="datum">Erscheinungsdatum</label>
            <input class="form_input" type="text" name="datum" id="datum" maxlength="10" value="<?php echo $datum; ?>">

            <label class="form_label" for="dauer">Dauer in Minuten</label>
            <input class="form_input" type="text" name="dauer" id="dauer" maxlength="3" value="<?php echo $dauer; ?>">

        </section>

        <!-- verstecktes Feld für Film-ID -->

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <section id="section_submit">

            <button class="form_input form_button" type="submit" name="button" value="speichern">Speichern</button>
            <button class="form_input form_button form_button_right" type="button" name="button" value="abbrechen" onClick="window.location.href = 'filmliste.php';">Abbrechen</button>

        </section>

    </form>

</div>

</div>

</body>
</html>

<?php
#Datenbankverbindung schliessen
$pdo = NULL;

?>
