<?php
require('propojeni_databaze_local.php');
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

            <div id="vyhledavaniNabidka" class="search-container">
                <?php
                include 'search.php';
                ?>
            </div>

            <hr>

            <div class="categories-container">
                <div class="categories-section">
                    <h2>Kategorie služeb</h2>
                    <div class="categories-grid">
                        <div class="category-card">
                            <i class="fas fa-tools"></i>
                            <h3>Opravy v domácnosti</h3>
                            <p>12 345</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-broom"></i>
                            <h3>Úklid</h3>
                            <p>9 876</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-hammer"></i>
                            <h3>Instalace a montáže</h3>
                            <p>7 654</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-tree"></i>
                            <h3>Zahradní práce</h3>
                            <p>5 432</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-paint-roller"></i>
                            <h3>Malování a renovace</h3>
                            <p>4 321</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-plug"></i>
                            <h3>Elektrické opravy</h3>
                            <p>3 210</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-wrench"></i>
                            <h3>Vodoinstalace</h3>
                            <p>2 109</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-lightbulb"></i>
                            <h3>Elektroinstalace</h3>
                            <p>6 109</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-truck-moving"></i>
                            <h3>Stěhování</h3>
                            <p>2 509</p>
                        </div>
                        <div class="category-card">
                            <i class="fas fa-chevron-down"></i>
                            <h3>Ostatní</h3>
                            <p>10 000</p>
                        </div>
                    </div>
                </div>
            </div>  

            <hr>

            <?php
            require('propojeni_databaze_local.php'); // Připojení k databázi
// SQL dotaz na získání poptávek
            $sql = "SELECT p.idpoptavka, p.nazev, p.lokalita, p.popis, p.tagy, u.jmeno, u.prijmeni 
        FROM poptavka p
        JOIN user u ON p.user_iduser = u.iduser";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $poptavky = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Pokud nejsou žádné poptávky, nastavíme prázdné pole, aby foreach neházel chybu
            if (!$poptavky) {
                $poptavky = [];
            }

// Definice barev pro jednotlivé tagy (volitelné)
            $tagColors = [
                "Montáž nábytku" => "badge-primary",
                "Malování" => "badge-warning",
                "Dekorace interiéru" => "badge-info",
                "Malířské práce" => "badge-primary",
                "Příprava povrchů" => "badge-warning",
                "Údržba garáží" => "badge-info",
                "Úklid domácnosti" => "badge-primary",
                "Generální úklid" => "badge-warning",
                "Čištění koberců" => "badge-success",
                "Spotřebiče" => "badge-secondary",
                "Elektro-instalace" => "badge-info"
            ];

            $defaultColor = "badge-secondary"; // Výchozí barva pro neznámé tagy
            ?>


            <section id="seznamNabidek" class="container my-4">

                <?php foreach ($poptavky as $poptavka): ?>
                    <div onclick="<?php echo "window.location.replace('poptavkaDetail.php?id=" . $poptavka['idpoptavka'] . "')" ?>;"
                         class="bg-light p-3 mb-4 rounded shadow layout nabidka">
                        <div class="text-center">
                            <!-- Nadpis -->
                            <h4 class="font-weight-bold"><?php echo htmlspecialchars($poptavka['nazev']); ?></h4>
                            <!-- Tagy -->
                            <div class="d-flex justify-content-center flex-wrap my-2">
                                <?php
                                foreach (explode(", ", $poptavka['tagy']) as $tag):
                                    $colorClass = $tagColors[$tag] ?? $defaultColor;
                                    ?>
                                    <span class="badge <?php echo $colorClass; ?> mx-1"><?php echo htmlspecialchars($tag); ?></span>
    <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Text a Lokalita -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mt-3">
                            <!-- Text -->
                            <p class="mb-3 mb-md-0 text flex-grow-1">
    <?php echo htmlspecialchars($poptavka['popis']); ?>
                            </p>
                            <!-- Lokalita a tlačítko -->
                            <div class="text-right lokalita ml-md-3">
                                <p class="font-weight-bold mb-2">Lokalita: <?php echo htmlspecialchars($poptavka['lokalita']); ?></p>
                                <button class="btn btn-primary btn-block btn-md-auto">Více informací</button>
                            </div>
                        </div>
                    </div>
<?php endforeach; ?>




            </section>


            <div id="id01" class="modal">
                <div class="modal-content animate">
                    <div class="container">
                        <div class="container my-4">
                            <!-- Sekce výběru práce -->
                            <div id="workSelection" class="custom-work-selection bg-light p-4 rounded shadow">
                                <h3 class="custom-heading">O jakou práci se jedná?</h3>
                                <div class="custom-button-group">
                                    <button id="offerServicesBtn" class="btn custom-btn-primary">Nabízím služby</button>
                                    <button id="needHelpBtn" class="btn custom-btn-secondary">Potřebuji pomoc</button>
                                </div>
                            </div>
                            <!-- Sekce přihlášení nebo registrace, skrytá na začátku -->
                            <div id="loginRegister" class="custom-login-register bg-light p-4 rounded shadow mt-4 d-none">
                                <h3 class="custom-heading">Nabízíte práci poprvé?</h3>
                                <div class="custom-button-group">
                                    <button id="loginBtn" class="btn custom-btn-primary">Přihlásit se</button>
                                    <button id="registerBtn" class="btn custom-btn-secondary">Registrovat se</button>
                                    <div>
                                        <h5>Nabídnout jednorázově</h5>
                                        <button onclick="location.replace('nabizim.php')" class="btn btn-info">Nabídnout práci</button>
                                        <button onclick="location.replace('poptavam.php')" class="btn btn-primary">Poptat práci</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" onclick="document.getElementById('id01').style.display = 'none'" class="cancelbtn rounded">Zrušit</button>
                        </div>
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