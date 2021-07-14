<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Logout
#
# Autor: Michael Hassel
# Email: hassel@mediakontur.de
# Stand: 24.03.2021
# Version: Basisversion
# für Schulungszwecke

# Sitzung übernehmen
session_start();
# Sitzungsdaten löschen
session_destroy();
# ggf. Sessioncookie löschen
# mit Verfallsdatum als Timestamp (0) in der Vergangenheit
setcookie('PHPSESSID', '', 0, '/');



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

            <p>Sie sind abgemeldet</p>

            <p><a href="index.php">erneut anmelden</a></p>

        </div>

    </body>
</html>
