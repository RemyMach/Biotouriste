<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../sass/style.css">
  <link rel="stylesheet" href="../sass/header.css">
  <link rel="stylesheet" href="../sass/footer.css">
  <link rel="stylesheet" href="../sass/home.css">
  <title>BioTourist</title>
</head>
<body>
  <div class="content-1">
    <header>
      <?php include('navbar-default.php'); ?>
      <!-- <?php include('navbar-login.php'); ?> -->
    </header>
    <div id="overlay_login" class="overlay">
      <div class="col-md-9 offset-md-1 text-right">
        <button id="btn-quit" class="btn-quit" type="button" name="button" onclick="quitLog()"><i class="fas fa-times fa-2x"></i></button>
      </div>
      <div class="text-center">
        <div class="container">
          <div class="cont">
            <span class="icon-user"><i class="fas fa-user fa-2x"></i></span>
            <h2 class="title-h2">CONNEXION</h2>
            <form>
              <div class="form-group">
                <div class="col-md-6 offset-md-3">
                  <input type="email" class="form-control" name="" placeholder="E-mail">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 offset-md-3">
                  <input type="password" class="form-control" name="" placeholder="Mot de passe">
                </div>
              </div>
              <button type="submit" class="btn btn-submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="overlay_signup" class="overlay">
      <div class="col-md-9 offset-md-1 text-right">
        <button id="btn-quit" class="btn-quit" type="button" name="button" onclick="quitSignup()"><i class="fas fa-times fa-2x"></i></button>
      </div>
      <div class="text-center">
        <div class="container">
          <div class="cont">
            <span class="icon-user"><i class="fas fa-user fa-2x"></i></span>
            <h2 class="title-h2">INSCRIPTION</h2>
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3 offset-md-3">
                    <input class="form-control" type="text" name="" value="" placeholder="Nom">
                  </div>
                  <div class="col-md-3">
                    <input class="form-control" type="text" name="" value="" placeholder="Prénom">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 offset-md-3">
                  <input type="email" class="form-control" name="" placeholder="E-mail">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 offset-md-3">
                  <input type="password" class="form-control" name="" placeholder="Mot de passe">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 offset-md-3">
                  <input type="password" class="form-control" name="" placeholder="Confirmation du Mot de passe">
                </div>
              </div>
              <button type="submit" class="btn btn-submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="overlay_profil" class="overlay">
      <div class="col-md-9 offset-md-1 text-right">
        <button id="btn-quit" class="btn-quit" type="button" name="button" onclick="quitProfil()"><i class="fas fa-times fa-2x"></i></button>
      </div>
      <div class="text-center">
        <div class="container">
          <div class="cont">
            <span class="icon-user"><i class="fas fa-user fa-2x"></i></span>
            <h2 class="title-h2">PROFIL</h2>

          </div>
        </div>
      </div>
    </div>
    <div id="overlay_cart" class="overlay">
      <div class="col-md-9 offset-md-1 text-right">
        <button id="btn-quit" class="btn-quit" type="button" name="button" onclick="quitCart()"><i class="fas fa-times fa-2x"></i></button>
      </div>
      <div class="text-center">
        <div class="container">
          <div class="cont">
            <span class="icon-user"><i class="fas fa-shopping-cart fa-2x"></i></span>
            <h2 class="title-h2">CART</h2>

          </div>
        </div>
      </div>
    </div>
    <div class="">

    </div>





  </div>

  <!-- <footer>
    <div class="footer">
      <div class="row">
        <div class="col-md-8 offset-md-2">

        </div>
      </div>
    </div>
  </footer> -->
  <script type="text/javascript">
  function openProfil() {
    document.getElementById("overlay_profil").classList.toggle("show");
    document.getElementById("overlay_login").classList.remove("show");
  }
  function quitProfil() {
    document.getElementById("overlay_profil").classList.remove("show");
  }
  function openCart() {
    document.getElementById("overlay_cart").classList.toggle("show");
    document.getElementById("overlay_login").classList.remove("show");
    document.getElementById("overlay_signup").classList.remove("show");
  }
  function quitCart() {
    document.getElementById("overlay_cart").classList.remove("show");
  }
  function openLog() {
    document.getElementById("overlay_login").classList.toggle("show");
    document.getElementById("overlay_signup").classList.remove("show");
    document.getElementById("overlay_cart").classList.remove("show");
  }
  function quitLog() {
    document.getElementById("overlay_login").classList.remove("show");
  }
  function openSignup() {
    document.getElementById("overlay_signup").classList.toggle("show");
    document.getElementById("overlay_login").classList.remove("show");
    document.getElementById("overlay_cart").classList.remove("show");
  }
  function quitSignup() {
    document.getElementById("overlay_signup").classList.remove("show");
  }
  </script>
  <script src="https://kit.fontawesome.com/d9a2e4a111.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
