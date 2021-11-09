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




    date_default_timezone_set("Europe/Oslo");

    $reaksjons_dato = date("Y-m-d"); //year, month, day
    $reaksjons_tidspunkt = date("H:i:s"); //hour, minutes, seconds
    $navn = $_GET["navn"];
    $valgt_rom = $_GET["send_hvilket_rom"];
    $reaksjon = $_GET["reaksjon"];

    if (isset($reaksjon)){ //Hvis den er satt send alt
        $sql = "INSERT INTO `Reaksjonsregistrering` VALUES ('$reaksjons_dato','$reaksjons_tidspunkt', '$navn', '$valgt_rom', '$reaksjon')";

        if($kobling->query($sql)) {
            echo "Spørringen $sql ble gjennomført.";
        } else {
            echo "Noe gikk galt med spørringen $sql ($kobling->error).";
        }
    } else { // Hvis reaksjonen ikke er satt, ikke send noe
        $sql = "INSERT INTO `Reaksjonsregistrering` (`Dato`, `Tid`, `Navn`, `rommene_has_Reaksjoner_rommene_rom`) VALUES ('$reaksjons_dato', '$reaksjons_tidspunkt', '$navn', '$valgt_rom')";

        if($kobling->query($sql)) {
            echo "Spørringen $sql ble gjennomført.";
        } else {
            echo "Noe gikk galt med spørringen $sql ($kobling->error).";
        }
    }

    header("Location: /index.php?rom=$valgt_rom");
?>