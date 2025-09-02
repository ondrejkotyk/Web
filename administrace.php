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

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
                <div class="container">
                    <a id="logo" class="navbar-brand mr-3" href="index.html">
                        <img id="logo_img" src="img/logo.png" alt="Logo">
                        Hodinové práce s.r.o
                    </a>

                    <button id="nabidnoutPraci" type="button" class="btn btn-light order-3 btn-md border border-light" onclick="document.getElementById('id01').style.display = 'block'">
                        <i class="fas fa-user-plus"></i> Nabídnout práci!
                    </button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <div id="praceMenu" class="navbar-nav align-items-center">
                            <div class="dropdown mx-2">
                                <button class="btn btn-primary prace" type="button" onclick="location.replace('nabidka.html')" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-briefcase"></i> Nabídky práce
                                </button>
                            </div>

                            <div class="dropdown mx-2">
                                <button class="btn btn-primary prace" type="button" onclick="location.replace('poptavka.html')" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-search"></i> Poptávka práce
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>





      <div class="admin" id="admin-pop">
      <h1>Poptávky ke schválení</h1>
      <hr>
      <div class="profil-pop bg-light p-3 mb-4 rounded shadow layout d-flex justify-content-between align-items-center" onclick="toggleSelection(this)">
          <div class="pop-left">
              <h4 class="pop-title font-weight-bold">Vymalování nové garáže</h4>
              <p class="pop-date font-weight-italic">Vytvořeno: 01.03.2024</p>
          </div>
          <div class="btn-group">
              <button class="btn btn-primary btn-block btn-md-auto" onclick="location.replace('poptavkaDetail.html')">Zobrazit</button>
              <button class="btn btn-danger" onclick="rejectRequest(event, this)">Zamítnout</button>
              <button class="btn btn-success" onclick="approveRequest(event, this)">Schválit</button>
          </div>
      </div>
      <hr>
      <div class="profil-pop bg-light p-3 mb-4 rounded shadow layout d-flex justify-content-between align-items-center" onclick="toggleSelection(this)">
          <div class="pop-left">
              <h4 class="pop-title font-weight-bold">Vymalování nové garáže</h4>
              <p class="pop-date font-weight-italic">Vytvořeno: 01.03.2024</p>
          </div>
          <div class="btn-group">
              <button class="btn btn-primary btn-block btn-md-auto" onclick="location.replace('poptavkaDetail.html')">Zobrazit</button>
              <button class="btn btn-danger" onclick="rejectRequest(event, this)">Zamítnout</button>
              <button class="btn btn-success" onclick="approveRequest(event, this)">Schválit</button>
          </div>
      </div>
      <hr>
      <div class="profil-pop bg-light p-3 mb-4 rounded shadow layout d-flex justify-content-between align-items-center" onclick="toggleSelection(this)">
          <div class="pop-left">
              <h4 class="pop-title font-weight-bold">Vymalování nové garáže</h4>
              <p class="pop-date font-weight-italic">Vytvořeno: 01.03.2024</p>
          </div>
          <div class="btn-group">
              <button class="btn btn-primary btn-block btn-md-auto" onclick="location.replace('poptavkaDetail.html')">Zobrazit</button>
              <button class="btn btn-danger" onclick="rejectRequest(event, this)">Zamítnout</button>
              <button class="btn btn-success" onclick="approveRequest(event, this)">Schválit</button>
          </div>
      </div>
      <hr>
      <div class="profil-pop bg-light p-3 mb-4 rounded shadow layout d-flex justify-content-between align-items-center" onclick="toggleSelection(this)">
          <div class="pop-left">
              <h4 class="pop-title font-weight-bold">Vymalování nové garáže</h4>
              <p class="pop-date font-weight-italic">Vytvořeno: 01.03.2024</p>
          </div>
          <div class="btn-group">
              <button class="btn btn-primary btn-block btn-md-auto" onclick="location.replace('poptavkaDetail.html')">Zobrazit</button>
              <button class="btn btn-danger" onclick="rejectRequest(event, this)">Zamítnout</button>
              <button class="btn btn-success" onclick="approveRequest(event, this)">Schválit</button>
          </div>
      </div>
  </div>

  <div class="admin" id="admin-nab">
  <h1>Nabídky ke schválení</h1>
  <hr>
  <div class="profil-pop bg-light p-3 mb-4 rounded shadow layout d-flex justify-content-between align-items-center" onclick="toggleSelection(this)">
      <div class="pop-left">
          <h4 class="pop-title font-weight-bold">Karel Vomáčka</h4>
          <p class="pop-date font-weight-italic">Vytvořeno: 01.03.2024</p>
      </div>
      <div class="btn-group">
          <button class="btn btn-primary btn-block btn-md-auto" onclick="location.replace('nabidkaDetail.html')">Zobrazit</button>
          <button class="btn btn-danger" onclick="rejectRequest(event, this)">Zamítnout</button>
          <button class="btn btn-success" onclick="approveRequest(event, this)">Schválit</button>
      </div>
  </div>
  <hr>
  <div class="profil-pop bg-light p-3 mb-4 rounded shadow layout d-flex justify-content-between align-items-center" onclick="toggleSelection(this)">
      <div class="pop-left">
          <h4 class="pop-title font-weight-bold">Karel Vomáčka</h4>
          <p class="pop-date font-weight-italic">Vytvořeno: 01.03.2024</p>
      </div>
      <div class="btn-group">
          <button class="btn btn-primary btn-block btn-md-auto" onclick="location.replace('nabidkaDetail.html')">Zobrazit</button>
          <button class="btn btn-danger" onclick="rejectRequest(event, this)">Zamítnout</button>
          <button class="btn btn-success" onclick="approveRequest(event, this)">Schválit</button>
      </div>
  </div>
  <hr>
  <div class="profil-pop bg-light p-3 mb-4 rounded shadow layout d-flex justify-content-between align-items-center" onclick="toggleSelection(this)">
      <div class="pop-left">
          <h4 class="pop-title font-weight-bold">Karel Vomáčka</h4>
          <p class="pop-date font-weight-italic">Vytvořeno: 01.03.2024</p>
      </div>
      <div class="btn-group">
          <button class="btn btn-primary btn-block btn-md-auto" onclick="location.replace('nabidkaDetail.html')">Zobrazit</button>
          <button class="btn btn-danger" onclick="rejectRequest(event, this)">Zamítnout</button>
          <button class="btn btn-success" onclick="approveRequest(event, this)">Schválit</button>
      </div>
  </div>
  <hr>
  <div class="profil-pop bg-light p-3 mb-4 rounded shadow layout d-flex justify-content-between align-items-center" onclick="toggleSelection(this)">
      <div class="pop-left">
          <h4 class="pop-title font-weight-bold">Karel Vomáčka</h4>
          <p class="pop-date font-weight-italic">Vytvořeno: 01.03.2024</p>
      </div>
      <div class="btn-group">
          <button class="btn btn-primary btn-block btn-md-auto" onclick="location.replace('nabidkaDetail.html')">Zobrazit</button>
          <button class="btn btn-danger" onclick="rejectRequest(event, this)">Zamítnout</button>
          <button class="btn btn-success" onclick="approveRequest(event, this)">Schválit</button>
      </div>
  </div>

</div>








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
                                        <button onclick="location.replace('nabizim.html')" class="btn btn-info">Nabídnout práci</button>
                                        <button onclick="location.replace('poptavam.html')" class="btn btn-primary">Poptat práci</button>
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

        <footer>
            <div class="py-3">
                <ul class="nav-footer">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Komunita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kariéra</a>
                    </li>
                    <li class="nav-item">
                        <div class="btn-group">
                            <button type="button" class="btn">Partnerské stránky</button>
                            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="https://www.bauhaus.cz/">Bauhaus</a>
                                <a class="dropdown-item" href="https://www.ikea.com/cz/cs/">Ikea</a>
                                <a class="dropdown-item" href="https://www.xxxlutz.cz/">XXXLutz</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Chci být partnerem!</a>
                            </div>
                        </div>
                    </li>
                </ul>

                <hr id="second-footer">
                <div class="col-md text-md-center">
                    <h6>&copy; 2024 Jedná se o studentský projekt studentů ČZU!!!</h6>
                </div>
            </div>
        </footer>

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
            function toggleSelection(element) {
                document.querySelectorAll('.profil-pop').forEach(el => el.classList.remove('selected'));
                element.classList.add('selected');
            }

            function approveRequest(event, button) {
                event.stopPropagation();
                alert("Schváleno!");
                button.closest('.profil-pop').remove();
            }

            function rejectRequest(event, button) {
                event.stopPropagation();
                alert("Zamítnuto!");
                button.closest('.profil-pop').remove();
            }

        </script>


    </body>


</html>
