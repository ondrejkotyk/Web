<?php
require('propojeni_databaze_local.php'); // Připojení k databázi
// Získání ID poptávky z URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Neplatné ID poptávky.");
}

$idPoptavka = (int) $_GET['id']; // Převod na číslo kvůli bezpečnosti
// Načtení poptávky z databáze
$sql = "SELECT p.nazev, p.lokalita, p.popis, p.tagy, p.tel, p.email, u.jmeno, u.prijmeni 
        FROM poptavka p
        JOIN user u ON p.user_iduser = u.iduser
        WHERE p.idpoptavka = :id";

$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $idPoptavka]);
$poptavka = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$poptavka) {
    die("Poptávka nenalezena.");
}

// Rozdělení tagů na jednotlivé štítky
$tagy = explode(", ", $poptavka['tagy']);

// Definice barev pro tagy
$tagColors = [
    "Montáž nábytku" => "badge-primary",
    "Malování" => "badge-warning",
    "Dekorace interiéru" => "badge-info",
    "Stavební práce" => "badge-secondary",
    "Elektro-instalace" => "badge-info",
    "Údržba garáží" => "badge-dark",
    "Čištění koberců" => "badge-success",
    "Generální úklid" => "badge-warning",
    "Příprava povrchů" => "badge-danger",
    "Spotřebiče" => "badge-secondary"
];

$defaultColor = "badge-secondary"; // Výchozí barva pro neznámé tagy
?>

<!doctype html>
<html lang="cs">

    <head>
        <title>Hodinový manžel/ka</title>
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
                <button id="zpet" onclick="location.replace('poptavka.php')"> <- Zpět na výběr</button>  
            </div>


            <div id="poptavkaDetail" class="container my-4">
                <!-- Sekce 1: Informace o poptávce -->
                <div id="card" class="d-flex bg-white p-4 rounded shadow mb-4">
                    <div class="flex-grow-1">
                        <!-- Název poptávky -->
                        <h2><?php echo htmlspecialchars($poptavka['nazev']); ?></h2>
                        <!-- Tagy -->
                        <div id="badges" class="d-flex justify-content-center flex-wrap mb-2">
                            <?php
                            foreach ($tagy as $tag):
                                $colorClass = $tagColors[$tag] ?? $defaultColor;
                                ?>
                                <span class="badge <?php echo $colorClass; ?> mx-1"><?php echo htmlspecialchars($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <!-- Popis -->
                        <p style="margin: 5%; font-size: 20px;">
                            <?php echo nl2br(htmlspecialchars($poptavka['popis'])); ?>
                        </p>
                        <!-- Lokalita a informace o zadavateli -->
                        <div class="d-flex justify-content-between">
                            <p id="lokalitaPoptavkaDetail" class="mb-2"><strong>Lokalita:</strong> <?php echo htmlspecialchars($poptavka['lokalita']); ?></p>
                            <p class="mb-2"><strong>Zadal:</strong> <?php echo htmlspecialchars($poptavka['jmeno'] . ' ' . $poptavka['prijmeni']); ?></p>
                        </div>
                        <!-- Kontaktní údaje -->
                        <div class="d-flex justify-content-between">
                            <p class="mb-2"><strong>Telefon:</strong> <?php echo htmlspecialchars($poptavka['tel']); ?></p>
                            <p class="mb-2"><strong>E-mail:</strong> <a href="mailto:<?php echo htmlspecialchars($poptavka['email']); ?>"><?php echo htmlspecialchars($poptavka['email']); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top:11%;" class="row py-4 text-muted">
                <div class="col-md">
                    <p><strong>O  Hodinovkách</strong></p>
                    <p>Hodinové práce je školní projekt pro obchod s lidmi. Jedná se o studentský projekt studentů ČZU!!! :)</p>
                </div>
                <div class="col-md">
                    <p><strong>Zasílat informace o novinkách týkající se půjčování lidí</strong></p>
                    <div class="input-group">
                        <input name="newsletter" type="text" class="form-control" placeholder="Tvůj e-mail">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button">Odebírej</button>
                        </span>
                    </div>
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