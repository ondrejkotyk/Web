<?php
require('propojeni_databaze_local.php');

if (!isset($_GET['q']) || empty($_GET['q'])) {
    die("Nezadal jste žádný hledaný výraz.");
}

$search = trim($_GET['q']);
$search = "%$search%"; // Přidání wildcard pro LIKE
// SQL dotaz: hledá v jméně, příjmení, tagy a lokalitě
$sql = "SELECT n.idnabidka, n.hodnoceni, n.pracovnidoba, n.sazba, n.lokalita, n.tagy, n.obr, u.jmeno, u.prijmeni 
        FROM nabidka n
        JOIN user u ON n.user_iduser = u.iduser
        WHERE u.jmeno LIKE :search 
           OR u.prijmeni LIKE :search 
           OR n.tagy LIKE :search 
           OR n.lokalita LIKE :search";

$stmt = $conn->prepare($sql);
$stmt->execute(['search' => $search]);

$nabidky = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<!DOCTYPE html>
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

        <?php
        include 'header.php';
        ?>

        <div style="margin-top: 8.5%;" class="container">  


            <div class="container mt-4">
                <h2>Výsledky hledání pro: "<?php echo htmlspecialchars($_GET['q']); ?>"</h2>
                <div style="margin-top: 4.5%;"></div>

                <?php if (empty($nabidky)): ?>
                    <p>Žádné výsledky nenalezeny.</p>
                <?php else: ?>
                    <?php foreach ($nabidky as $nabidka): ?>
                        <div class="d-flex bg-white p-3 rounded shadow mb-4 nabidka" 
                             onclick="window.location.replace('nabidkaDetail.php?id=<?php echo htmlspecialchars($nabidka['idnabidka']); ?>')">
                            <div class="mr-3 foto">
                                <img src="img/<?php echo htmlspecialchars($nabidka['obr']); ?>" alt="<?php echo htmlspecialchars($nabidka['jmeno'] . ' ' . $nabidka['prijmeni']); ?>" class="img-fluid rounded">
                            </div>
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
                                <div class="d-flex justify-content-between">
                                    <p class="mb-1">Lokalita: <?php echo htmlspecialchars($nabidka['lokalita']); ?></p>
                                    <p class="mb-1">Pracovní doba: <?php echo htmlspecialchars($nabidka['pracovnidoba']); ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-1 sazba">Sazba: <?php echo htmlspecialchars($nabidka['sazba']); ?></p>
                                    <p class="mb-1">Hodnocení: <?php echo htmlspecialchars($nabidka['hodnoceni']); ?> ⭐</p>
                                </div>
                                <div class="d-flex mt-auto">
                                    <button class="btn btn-outline-primary mx-2">Více informací</button>
                                    <button class="btn btn-warning mx-2">Zobrazit recenze</button>
                                    <button onclick="window.location.replace('nabidkaDetail.php?id=<?php echo htmlspecialchars($nabidka['idnabidka']); ?>')" 
                                            class="btn btn-danger mx-2">Mám zájem</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="latest-requests">
                    <h2>Poslední poptávky</h2>
                    <div class="request-cards">
                        <div class="request-card">
                            <img src="img/repair.jpg" alt="Oprava vodovodního kohoutku">
                            <div class="overlay">
                                <h3>Oprava vodovodního kohoutku</h3>
                                <p><i class="fas fa-clock"></i> před 2 dny</p>
                            </div>
                        </div>
                        <div class="request-card">
                            <img src="img/gardening.jpg" alt="Údržba zahrady">
                            <div class="overlay">
                                <h3>Údržba zahrady</h3>
                                <p><i class="fas fa-clock"></i> před 3 dny</p>
                            </div>
                        </div>
                        <div class="request-card">
                            <img src="img/furniture_assembly.jpg" alt="Montáž nábytku IKEA">
                            <div class="overlay">
                                <h3>Montáž nábytku IKEA</h3>
                                <p><i class="fas fa-clock"></i> před 1 dnem</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <?php
        include 'footer.php';
        ?>

    </body>
</html>
