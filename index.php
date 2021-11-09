<?php
    // Kobler til databasen
    $tjener = "localhost";
    $brukernavn = "root";
    $passord = "root";
    $database = "reaksjonsregistrering"; //Endre på denne til din database

    $kobling = new mysqli($tjener, $brukernavn, $passord, $database);

    if($kobling->connect_error) {
        die("Noe gikk galt: " . $kobling->connect_error);
    } else {
        // echo "Koblingen virker.<br>";
    }

    $kobling->set_charset("utf8");


    if (isset($_GET["rom"])){
        $valgt_rom = $_GET["rom"];
    } else {
        $valgt_rom = "main";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>design</title>
</head>
<body>
    <div id="bakgrunn">
        <div id="venstre">
            <div class="venstre">
                <form action="phpscript/send_reaksjon.php" method="get">
                    <input type="text" placeholder="Navn" name="navn" id="input_navn" required>
            </div>
            <div class="venstre" id="reaksjonsdiv">
                <?php
                    $sql = "SELECT * FROM `rommene_has_Reaksjoner` WHERE rommene_rom = '$valgt_rom'";
                    $resultat = $kobling->query($sql);

                    while($rad = $resultat->fetch_assoc()) {
                        $reaksjon = $rad["Reaksjoner_Reaksjon"];

                        echo "<label>";
                            echo "<input type='radio' name='reaksjon' value='$reaksjon' class='input_reaksjon' required>";
                            echo "<img src='bilder/emoji/$reaksjon.png'>";
                        echo "</label>";
                        echo "&emsp;";
                    }
                ?>
            </div>
            <div class="venstre">
                    <input type='hidden' name='send_hvilket_rom' value='<?php echo $valgt_rom;?>'/> 
                    <input type="submit" value="Send" id="input_send">
                </form>
            </div>
        </div>
        <div id="hoyre">
            <button type="button" id="åpne_rompanel" onclick="legg_til_rom()">
                <div></div>
                <div></div>
                <div></div>
            </button>

            <div id="logg_boks">
                <h2><?php echo "$valgt_rom";?></h2>
                <div>
                    <table>
                        <tr>
                            <th>Tid:</th>
                            <th>Navn:</th>
                            <th>Reaksjon:</th>
                        </tr>
                        <?php
                            $sql = "SELECT * FROM `Reaksjonsregistrering` WHERE rommene_has_Reaksjoner_rommene_rom = '$valgt_rom' ORDER BY Dato DESC, Tid DESC"; //Skriv din sql kode her
                            $resultat = $kobling->query($sql);

                            while($rad = $resultat->fetch_assoc()) {
                                $logg_tid = $rad["Tid"];
                                $logg_Navn = $rad["Navn"];
                                $logg_Reaksjon = $rad["rommene_has_Reaksjoner_Reaksjoner_Reaksjon"];

                                if ($logg_Reaksjon == null){
                                    $logg_Reaksjon = "ingenting";
                                }

                                echo "<tr>";
                                    echo "<td>$logg_tid</td>";
                                    echo "<td>$logg_Navn</td>";
                                    echo "<td><div><img src='bilder/emoji/$logg_Reaksjon.png'></div></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div id="utvidelses_div_rom">
            <?php
                // rom-valgene  
                $sql = "SELECT * FROM rommene"; //Skriv din sql kode her
                $resultat = $kobling->query($sql);

                while($rad = $resultat->fetch_assoc()) {
                    $rom = $rad["rom"]; //Skriv ditt kolonnenavn her
                    if ($rom == $valgt_rom){
                        echo "<option value='$rom' selected='selected'> $rom </option>";
                    }
                    else {
                        echo "<option value='$rom'> $rom </option>";
                    }
                }

            ?>
        </div>
        <div id="reaksjonstabell">
            <?php
            $sql = "SELECT * FROM Reaksjoner"; //Skriv din sql kode her
            $resultat = $kobling->query($sql);
    
            while($rad = $resultat->fetch_assoc()) {
                $reaksjon = $rad["Reaksjon"]; //Skriv ditt kolonnenavn her
    
                echo "<p class='usynelig_reaksjoner' style='display: none;'>$reaksjon</p>";
            }
            ?>
        </div>
    </div>

    <script src="script.js"></script>
    
</body>
</html>