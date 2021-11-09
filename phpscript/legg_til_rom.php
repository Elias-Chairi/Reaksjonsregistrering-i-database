<?php
    // Tilkoblingsinformasjon
    $tjener = "localhost";
    $brukernavn = "root";
    $passord = "root";
    $database = "reaksjonsregistrering"; //Endre på denne til din database

    // Opprette en kobling
    $kobling = new mysqli($tjener, $brukernavn, $passord, $database);

    // Sjekk om koblingen virker
    if($kobling->connect_error) {
        die("Noe gikk galt: " . $kobling->connect_error);
    } else {
        echo "Koblingen virker.<br>";
    }
    // Angi UTF-8 som tegnsett
    $kobling->set_charset("utf8");




    $rom_navn = $_GET["navn"];
    $er_den_i_databasen = 0;

    // Med linjeskift for 1 tabell    
    $sql = "SELECT * FROM rommene"; //Skriv din sql kode her
    $resultat = $kobling->query($sql);

    // sjekker om den er i databasen fra før av
    while($rad = $resultat->fetch_assoc()) {
        if ($rom_navn == $rad["rom"]){
            $er_den_i_databasen += 1;
        }
    }




    if ($er_den_i_databasen == 0){ //Hvis romnavnet er nytt så skal den gå videre
        $sql = "INSERT INTO rommene VALUES ('$rom_navn')";

        if($kobling->query($sql)) {
            echo "Spørringen $sql ble gjennomført.";
        } else {
            echo "Noe gikk galt med spørringen $sql ($kobling->error).";
        }




        $reaksjoner_i_rom = $_GET["reaksjoner_i_rom"];
        echo "OUTPUT: $reaksjoner_i_rom";

        // Henter reaksjoner slik at jeg kan sende riktig info til rom_has_reaksjoner
        $sql = "SELECT * FROM Reaksjoner"; //Skriv din sql kode her
        $resultat = $kobling->query($sql);

        while($rad = $resultat->fetch_assoc()) {
            $reaksjon = $rad["Reaksjon"]; //Skriv ditt kolonnenavn her
            if ($_GET["$reaksjon"] == "on"){
                $sql = "INSERT INTO rommene_has_Reaksjoner VALUES ('$rom_navn', '$reaksjon')";
                if($kobling->query($sql)) {
                    echo "Spørringen $sql ble gjennomført.";
                } else {
                    echo "Noe gikk galt med spørringen $sql ($kobling->error).";
                }
            }
        }

        header("Location: /index.php?rom=$rom_navn");
        
    } else { // hvis ikke tar den deg tilbake
        header("Location: /index.php");
    }
?>