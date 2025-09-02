<?php
require('propojeni_databaze_local.php');
// Ověříme, zda byl předán parametr `id`
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Neplatné ID nabídky.");
}

// Získání ID z URL
$idnabidka = (int) $_GET['id'];

// SQL dotaz na získání konkrétní nabídky
$sql = "SELECT n.hodnoceni, n.pracovnidoba, n.sazba, n.lokalita, n.tagy, n.obr, u.jmeno, u.prijmeni 
        FROM nabidka n
        JOIN user u ON n.user_iduser = u.iduser
        WHERE n.idnabidka = :idnabidka";

$stmt = $conn->prepare($sql);
$stmt->execute(['idnabidka' => $idnabidka]);

// Načtení výsledku
$nabidka = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$nabidka) {
    die("Nabídka nebyla nalezena.");
}

// Proměnné pro zobrazení
$jmeno = htmlspecialchars($nabidka["jmeno"]);
$prijmeni = htmlspecialchars($nabidka["prijmeni"]);
$hodnoceni = htmlspecialchars($nabidka["hodnoceni"]);
$pracovnidoba = htmlspecialchars($nabidka["pracovnidoba"]);
$sazba = htmlspecialchars($nabidka["sazba"]);
$lokalita = htmlspecialchars($nabidka["lokalita"]);
$tagy = explode(", ", $nabidka["tagy"]); // Rozdělení tagů na pole
$obr = htmlspecialchars($nabidka["obr"]);

$tagColors = [
    "Montáž nábytku" => "badge-primary",
    "Stavební práce" => "badge-secondary",
    "Elektro-instalace" => "badge-info",
    "Zahradní úpravy" => "badge-success",
    "Sekání trávy" => "badge-primary",
    "Údržba plotů" => "badge-secondary",
    "Úklid domácnosti" => "badge-warning",
    "Myčka oken" => "badge-danger",
    "Malování a renovace" => "badge-info",
    "Tapetování" => "badge-warning"
];

// Výchozí barva, pokud není v mapě
$defaultColor = "badge-dark";

// Získání ID uživatele, pro kterého se zobrazují recenze
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Neplatné ID uživatele.");
}

$idUser = (int) $_GET['id']; // Převod na číslo pro bezpečnost
// Načtení recenzí z databáze
$sql = "SELECT autor, popis, datum, pocet_hvezd FROM recenze WHERE user_iduser = :idUser ORDER BY datum DESC";
$stmt = $conn->prepare($sql);
$stmt->execute(['idUser' => $idUser]);
$recenze = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$recenze) {
    echo "<p>Žádné recenze k dispozici.</p>";
}
?>
<!doctype html>
<html lang="cs">

    <head>
        <title><?php echo "$jmeno $prijmeni - Nabídka"; ?></title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="styly.css">
    </head>

    <body class="bg-light">

        <div class="container">   
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

            <?php
            include 'header.php';
            ?>

            <div>
                <button id="zpet" onclick="location.replace('nabidka.php')"> <- Zpět na výběr</button>  
            </div>


            <div id="nabidkaDetail" class="container my-4">
                <!-- Sekce 1: Informace o nabídce -->
                <div id="card" class="d-flex bg-white p-4 rounded shadow mb-4">
                    <!-- Obrázek -->
                    <div class="obrazekNabidka">
                        <img src="img/<?php echo $obr; ?>" alt="<?php echo "$jmeno $prijmeni"; ?>" class="img-fluid rounded">
                    </div>
                    <!-- Textová část -->
                    <div class="flex-grow-1">
                        <h2><?php echo "$jmeno $prijmeni"; ?></h2>
                        <!-- Tagy -->
                        <?php
                        foreach ($tagy as $tag):
                            // Zjistit správnou třídu nebo použít výchozí
                            $colorClass = $tagColors[$tag] ?? $defaultColor;
                            ?>
                            <span class="badge <?php echo $colorClass; ?> mx-1"><?php echo htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>

                        <!-- Popis -->
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ex mi. Integer eu scelerisque mauris, vel dapibus purus.
                            Nam sed elementum dui. Morbi non fringilla ligula.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ex mi. Integer eu scelerisque mauris, vel dapibus purus.
                            Nam sed elementum dui. Morbi non fringilla ligula.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ex mi. Integer eu scelerisque mauris, vel dapibus purus.
                            Nam sed elementum dui. Morbi non fringilla ligula.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ex mi. Integer eu scelerisque mauris, vel dapibus purus.
                            Nam sed elementum dui. Morbi non fringilla ligula.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ex mi. Integer eu scelerisque mauris, vel dapibus purus.
                            Nam sed elementum dui. Morbi non fringilla ligula.
                        </p>
                        <!-- Lokalita, pracovní doba a sazba -->
                        <p class="mb-1"><strong>Lokalita:</strong> <?php echo $lokalita; ?></p>
                        <p class="mb-1"><strong>Pracovní doba:</strong> <?php echo $pracovnidoba; ?></p>
                        <p class="mb-1"><strong>Sazba:</strong> <?php echo $sazba; ?></p>
                    </div>
                </div>

                <!-- Sekce 2: Hodnocení a doporučení -->
                <div id="tlacitka" class="d-flex justify-content-between bg-light p-3 rounded shadow mb-2">
                    <!-- Hodnocení -->
                    <div>
                        <h3><?php echo $hodnoceni; ?> ⭐</h3>
                        <p>Hodnoceno 53 zákazníků</p>
                        <button class="btn btn-warning">Ohodnotit</button>
                    </div>
                    <!-- Doporučení -->
                    <div class="text-center">
                        <p>29 zákazníků doporučuje</p>
                        <button class="btn btn-success">Doporučit</button>
                    </div>
                    <!-- Kontakt -->
                    <div class="text-center">
                        <p>Máte zájem?</p>
                        <button class="btn btn-danger">Kontaktovat</button>
                    </div>
                </div>

                <!-- Sekce 3: Recenze zákazníků -->
                <div id="recenze" class="bg-white p-4 rounded shadow">
                    <h4>Recenze</h4>

                    <?php if (!empty($recenze)): ?>
                        <?php foreach ($recenze as $recenzeItem): ?>
                            <div class="p-3 border-bottom">
                                <p class="mb-1"><strong><?php echo htmlspecialchars($recenzeItem['autor']); ?></strong></p>
                                <p class="text-muted">Hodnoceno <?php echo date("d.m.Y", strtotime($recenzeItem['datum'])); ?></p>
                                <div class="d-flex align-items-center mb-2">
                                    <!-- Hvězdy -->
                                    <div class="text-warning">
                                        <?php
                                        $stars = intval($recenzeItem['pocet_hvezd']);
                                        for ($i = 0; $i < 5; $i++) {
                                            if ($i < $stars) {
                                                echo '<i class="fas fa-star"></i>'; // Plná hvězda
                                            } else {
                                                echo '<i class="far fa-star"></i>'; // Prázdná hvězda
                                            }
                                        }
                                        ?>
                                    </div>
                                    <span class="ml-2">(<?php echo htmlspecialchars($recenzeItem['pocet_hvezd']); ?>/5)</span>
                                </div>
                                <p><?php echo htmlspecialchars($recenzeItem['popis']); ?></p>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center">Žádné recenze zatím nejsou k dispozici.</p>
                    <?php endif; ?>



                </div>
            </div>


        </div>

        <?php
        include 'footer.php';
        ?> 

        <script>
            $(function () {
                $('[data-toggle="popover"]').popover();
            });
            $('html').on('click', function (e) {
                if (typeof $(e.target).data('original-title') == 'undefined' &&
                        !$(e.target).parents().is('.popover.in')) {
                    $('[data-original-title]').popover('hide');
                }
            });

            document.getElementById('offerServicesBtn').addEventListener('click', showLoginRegister);
            document.getElementById('needHelpBtn').addEventListener('click', showLoginRegister);
            document.querySelector('.cancelbtn').addEventListener('click', resetToInitialState);

            function showLoginRegister() {
                // Skryj sekci výběru práce
                document.getElementById('workSelection').classList.add('d-none');
                // Zobraz sekci přihlášení nebo registrace
                document.getElementById('loginRegister').classList.remove('d-none');
            }

            function resetToInitialState() {
                // Zobraz sekci výběru práce
                document.getElementById('workSelection').classList.remove('d-none');
                // Skryj sekci přihlášení nebo registrace
                document.getElementById('loginRegister').classList.add('d-none');
            }
        </script>


    </body>


</html>