<?php
$title = "Home";
require '../references/navbar.php';
?>
    <style>
        .container {
            max-width: 90%;
            margin: 50px auto;
            background: #fff;
            padding: 2%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .el {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .el img {
            width: 50%;
            border-radius: 10px;
        }

        .description {
            width: 50%;
            font-size: 18px;
            color: #333;
            text-align: left;
        }

        h3{
            text-align: center;
            color: white;
        }
    </style>
<div class="element container" style="background-color: #6a1b9a;">
    <h3>Benvenuto! Questi sono alcuni dei nostri prodotti più venduti</h3>
</div>
<div class="container">
    <h4 style="text-align: center;">Raspberry Pi 4</h4>
    <div class="element el">
        <img src="../references/images/raspberry_pi_4.png" alt="Raspberry Pi 4">
        <p class="description">Il Raspberry Pi 4 è un potente <strong>mini-computer</strong> dalle dimensioni compatte,
            ideale per <strong>progetti di elettronica, domotica e sviluppo software</strong>. Dotato di un processore
            quad-core, supporto per doppio monitor e memoria fino a 8GB, offre prestazioni eccezionali per il suo
            formato.</p>
    </div>
</div>
<div class="container">
    <h4 style="text-align: center;">Arduino Uno</h4>
    <div class="element el">
        <img src="../references/images/arduino_uno.webp" alt="Raspberry Pi 4">
        <p class="description">L'Arduino Uno R4 è una potente <strong>scheda di sviluppo</strong> progettata per
            <strong>progetti di automazione, robotica e prototipazione</strong>. Dotato di un microcontrollore avanzato,
            maggiore memoria e connettività migliorata, offre prestazioni affidabili per makers e professionisti.</p>
    </div>
</div>
</body>
</html>
