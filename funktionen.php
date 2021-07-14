<?php

########### Funktionssammlung ###########

/**
 * überprüft ein Datum auf Gültigkeit
 * @param string $datum das Datum, dass zu prüfen ist
 * @return bool 
 */
function my_checkdate( string $datum ): bool {

    # Datumsstring zerlegen
    $das_datum = explode('.', $datum);

    # Array muss drei Werte haben
    if( count($das_datum) != 3 ){
        return false;
    }

    # Datum ist ungültig
    return checkdate( $das_datum[1], $das_datum[0], $das_datum[2] );

}





