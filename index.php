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

    <div id="uvod" class="jumbotron">
        <h1 class="display-4 text-center">Vaše domácí problémy = naše řešení!</h1>
        <p class="lead">Potřebujete doma opravit, namontovat nebo uklidit? Hodinový manžel/manželka je tu pro vás! Šetřete čas i starosti – jednoduše si objednejte profesionální pomoc na hodinu přesně tam, kde to nejvíc potřebujete. Česká zemedělská univerzita se rozhodla půjčovat lidi za peníze.</p>
        <hr class="my-4">

        <div class="info-section">
            <div class="info-text">
                <h2>VÍCE NEŽ 85%</h2>
                <p>zákazníků je spokojeno s našimi hodinovými manžely a manželkami.</p>
                <p><em>S námi jde oprava snadno!</em></p>
                <div class="buttons">
                    <button onclick="location.replace('nabizim.php')" class="btn-register">Nabídnout práci</button>
                    <button onclick="location.replace('poptavam.php')" class="btn-request">Poptat práci</button>
                </div>
            </div>
            <div class="info-images">
                <img src="img/oprava_domacnosti.png" alt="Hodinový manžel opravuje domacnost">
                <img src="img/vareni.png" alt="Vaření na míru">
                <img src="img/natirani.png" alt="Vymalování">
            </div>
        </div>
    </div>

    <hr>

    <?php
    include 'search.php';
    ?>


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

    <hr>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/manzel1.png" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Jenda Dolansky</h3>
                    <p>...</p>
                    <a class="btn btn-secondary btn-lg" data-container="body" data-toggle="popover" data-placement="left" data-content="Jenda je zkušený hodinový manžel, který vám pomůže s každým detailem vašeho domova. S více než 5 lety praxe a pečlivým přístupem zvládne vše – od montáže nábytku až po opravu drobných elektroinstalací. Je spolehlivý, precizní a přistupuje k práci s maximálním nasazením, jako by pracoval ve svém vlastním domě.">
                        Podrobnosti
                    </a>
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg btn-dark">
                        Objednat
                    </button>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/manzel2.png" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h3>František Kopecký</h3>
                    <p>...</p>
                    <a class="btn btn-secondary btn-lg" data-container="body" data-toggle="popover" data-placement="left" data-content="František je profesionál s precizním okem pro detail, který zvládne všechny náročné opravy a instalace ve vaší domácnosti. Specializuje se na instalatérské práce, opravy potrubí a další technické úkony, při kterých je pečlivost nezbytná. S Františkem získáte nejen šikovné ruce, ale také jistotu, že práce bude odvedena správně a včas.">
                        Podrobnosti
                    </a>
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg btn-dark">
                        Objednat
                    </button>
                </div>
            </div>
            <div id="gertruda" class="carousel-item">
                <img class="d-block w-100" src="img/manzelka1.png" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Gertruda Nováková</h3>
                    <p>...</p>
                    <a class="btn btn-secondary btn-lg" data-container="body" data-toggle="popover" data-placement="left" data-content="Gertruda je profesionálka v oblasti úklidových služeb, která dbá na každý detail, aby váš domov zářil čistotou. S letitými zkušenostmi a vášní pro pořádek se postará o to, aby každý kout byl bez poskvrnky. Gertruda ví, jak udržet váš domov svěží a čistý – od běžného úklidu až po hloubkové čištění.">
                        Podrobnosti
                    </a>
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-lg btn-dark">
                        Objednat
                    </button>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <hr>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-5">Budoucnost našich služeb, Pomozte nám vybrat!</h1>
            <p class="lead">Z důvodu rostoucí poptávky po našich hodinových službách plánujeme rozšíření nabídky. Pomozte nám zjistit, které služby jsou pro vás nejdůležitější.</p>
            <ul class="list-unstyled">
                <li class="media">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1 hlas">Montáž nábytku</h5>
                        <div id="hlasovaniPrvni" class="progress border border-secondary">
                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100">89%</div>
                        </div>
                    </div>
                </li>
                <li class="media my-4">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1 hlas">Údržba domácích spotřebičů</h5>
                        <div id="hlasovaniDruhy" class="progress border border-secondary">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15%</div>
                        </div>
                    </div>
                </li>
                <li class="media">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1 hlas">Zahradní úpravy</h5>
                        <div id="hlasovaniTreti" class="progress border border-secondary">
                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" aria-valuenow="46" aria-valuemin="0" aria-valuemax="100">46%</div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <hr>

    <div class="row py-4 text-muted">
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
</div>

<?php
include 'footer.php';
?>


</body>


</html>
