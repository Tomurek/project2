<html>

<head>
    <link rel="stylesheet" href="CSS/strona.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Martian+Mono:wght@100&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Martian+Mono:wght@100&display=swap');

        * {
            font-family: 'Martian Mono', monospace;
            font-size: 14px;
        }
    </style>

</head>

<body>
        <h1>Instalacja pracowni</h1>
        <form id="form" name="input" action="wyslij.php" method="post">
            <section id="main">
                <section id="col1">
                <section id="comps">
                    <h4>Wybór komputerów</h4>
                    <section class="radio_comps"><input id="comps" type="radio" value="dol" name="komp">Dolne</section>
                    <section class="radio_comps"><input id="comps" type="radio" value="gora" name="komp">Górne</section>
                </section>
                <section id="boot_type">
                    <H4>Typ bootowania</H4>
                    <section class="radio_boot"><input id="boot" type="radio" id="Legacy" name="boot" value="legacy">Legacy<br></section> 
                    <section class="radio_boot"><input id="boot" type="radio" id="EFI" name="boot" value="UEFI">UEFI</section> 
                </section>
                <section id="vm">
                    <h4>Kopiować maszyny wirtualne?</h4>
                    <section class="radio_vm"><input id="vm" type="radio" name="vm" value="tak">tak</section> 
                    <section class="radio_vm"><input id="vm" type="radio" name="vm" value="nie">nie</section> 
                </section>
                <section id="enviroment">
                    <h4>GUI czy CLI</h4>
                    <section class="radio_env"><input id="env" type="radio" name="Enviroment" value="GUI">GUI</section>
                    <section class="radio_env"><input id="env" type="radio" name="Enviroment" value="CLI">CLI</section>
                </section>
                </section>
                <section id="number_comp">
                    <h4>Numery stanowisk</h4>
                        <section id="od1">
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="1">1</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="2">2</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="3">3</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="4">4</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="5">5</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="6">6</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="7">7</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="8">8</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="9">9</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="10">10</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="11">11</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="12">12</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="13">13</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="14">14</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="15">15</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="16">16</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="17">17</section>
                           <section class="number_checkbox"><input id="number" type="checkbox" name="workplace[]" value="18">18</section>
                        </section>
                    </section>
         </section>
        <section id="foot">
                    <h4>Prędkość kopiowania</h4>
                    <input id="speed" type="number" name="speed" value="">
                    <input id="send" type="submit" value="Wyślij" name="wyslij">

        </section>  
        </form>
    
</body>

</html>