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


            <section id="seznamNabidek" class="container my-4">


                <?php
                $sql = "SELECT n.idnabidka, n.hodnoceni, n.pracovnidoba, n.sazba, n.lokalita, n.tagy, n.obr, u.jmeno, u.prijmeni 
        FROM nabidka n
        JOIN user u ON n.user_iduser = u.iduser";

// Příprava dotazu
                $stmt = $conn->prepare($sql);
                $stmt->execute(); // NEPOUŽÍVÁME execute(['idnabidka' => 1]) !!!
// Načtení všech výsledků do pole
                $nabidky = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$nabidky) {
                    echo "Žádná data nebyla nalezena.";
                    exit();
                }

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
                ?>

                <?php foreach ($nabidky as $nabidka): ?>
                    <div onclick="<?php echo "window.location.replace('nabidkaDetail.php?id=" . $nabidka['idnabidka'] . "')" ?>;"
                         class="d-flex bg-white p-3 rounded shadow mb-4 nabidka">
                        <!-- Obrázek -->
                        <div class="mr-3 foto">
                            <img src="img/<?php echo htmlspecialchars($nabidka['obr']); ?>" alt="<?php echo htmlspecialchars($nabidka['jmeno'] . ' ' . $nabidka['prijmeni']); ?>" class="img-fluid rounded">
                        </div>
                        <!-- Textový obsah -->
                        <div class="d-flex flex-column flex-grow-1 nabidkaSeznam">
                            <h4><?php echo htmlspecialchars($nabidka['jmeno'] . ' ' . $nabidka['prijmeni']); ?></h4>
                            <div class="d-flex flex-wrap mb-2">
                                <?php
                                foreach (explode(", ", $nabidka['tagy']) as $tag):
                                    // Zjistit správnou třídu nebo použít výchozí
                                    $colorClass = $tagColors[$tag] ?? $defaultColor;
                                    ?>
                                    <span class="badge <?php echo $colorClass; ?> mx-1"><?php echo htmlspecialchars($tag); ?></span>
                                <?php endforeach; ?>
                            </div>

                            <!-- Text zarovnání -->
                            <div class="d-flex justify-content-between">
                                <p class="mb-1">Lokalita: <?php echo htmlspecialchars($nabidka['lokalita']); ?></p>
                                <p class="mb-1">Pracovní doba: <?php echo htmlspecialchars($nabidka['pracovnidoba']); ?></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-1 sazba">Sazba: <?php echo htmlspecialchars($nabidka['sazba']); ?></p>
                                <p class="mb-1">Hodnocení: <?php echo htmlspecialchars($nabidka['hodnoceni']); ?> ⭐</p>
                            </div>

                            <!-- Tlačítka -->
                            <div class="d-flex mt-auto">
                                <button class="btn btn-outline-primary mx-2">Více informací</button>
                                <div class="d-flex ml-auto">
                                    <button class="btn btn-warning mx-2">Zobrazit recenze</button>
                                </div>
                                <div class="d-flex ml-auto">
                                    <button onclick="location.replace('nabidkaDetail.php')" class="btn btn-danger mx-2">Mám zájem</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </section>

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