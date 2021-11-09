let rom_panel = document.getElementById("utvidelses_div_rom");
let alle_reaksjonene = Array.from(document.getElementsByClassName("usynelig_reaksjoner"));

let annenver = 1;
let stop_animasjon = false;

function legg_til_rom () {
    annenver += 1;

    if (annenver % 2 == 0){
        rom_panel.style.width = "100%";
        rom_panel.style.height = "100vh";
        rom_panel.style.right = "0px";

        setTimeout(function(){ 
            if (annenver % 2 == 0){ // sjekk en gang til etter pause
                if (annenver == 2){
                    alle_rommene = rom_panel.innerHTML;
                    rom_panel.innerHTML = "";
                };
                rom_panel.innerHTML = 
                    "<div>" +
                        "<h1>Valgt rom: &nbsp</h1>" +
                        "<select name='rom' id='form_select_rom'>" +
                            alle_rommene +
                        "</select>" +
                    "</div>" +
                    "<div id='legg_til_rom_div'>" +
                    "<button onclick='legg_til_faktiske_rom(event)'>Legg til rom</button>" +
                    "</div>";
                
                document.getElementById("form_select_rom").addEventListener("input", function () {
                    document.getElementById("åpne_rompanel").addEventListener("click", function () {
                        window.location = "http://localhost:8888/?rom=" + document.getElementById("form_select_rom").value;
                    });
                    stop_animasjon = true;
                });
            }
        }, 1000);

    } else if(stop_animasjon == false){
        rom_panel.innerHTML = "";

        rom_panel.style.width = "0px";
        rom_panel.style.height = "0px";
        rom_panel.style.right = "225px";
    }
}



let velg_reaksjoner_til_rom_content = "";
for (i = 0; i < alle_reaksjonene.length; i++){
    velg_reaksjoner_til_rom_content +=
    "<label>" +
        "<input type='checkbox' name='"+alle_reaksjonene[i].textContent+"' class='input_reaksjon'>" +
        "<img src='bilder/emoji/"+alle_reaksjonene[i].textContent+".png'>" +
    "</label>" +
    "&nbsp; &nbsp;";
}

function legg_til_faktiske_rom(e) {
    e.target.remove();

    rom_panel.innerHTML += 
        "<form action='phpscript/legg_til_rom.php' method='get'>" +
            "<div style='margin-top: 150px'>" +
                "<input id='romnavn' type='text' placeholder='Romnavn' name='navn'>" +
            "</div>" +
            "<div style='margin-top: 50px'>" +
                velg_reaksjoner_til_rom_content +
            "</div>" +
            "<div style='margin-top: 50px'>" +
                "<input type='submit' value='legg til'>" +
            "</div>" +
        "</form>";
}