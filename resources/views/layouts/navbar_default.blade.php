
<nav>
  <div class="header-navbar">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="row">
          <div class="col-8">
            <a href="#" class="sp-10"><img class="header-brand-logo" src="../../storage/app/resources/BioTourist.png" alt=""></a>
            <a href="{{ url('announces') }}" class="sp-30">Mes Annonces</a>
            <a href="#" class="sp-30">Message</a>
            <a href="#" class="sp-30">Map</a>
            <a href="#help" class="sp-30">Aide</a>
          </div>
          <div class="col">
            <div class="row">
              <div class="header-lang">
                <i class="fas fa-globe"></i>
                <select class="sp-10" name="lang">
                  <option value="fr" checked>FR</option>
                  <option value="en">EN</option>
                </select>
              </div>
              <div class="header-log">
                <i class="fas fa-user sp-30"></i>
                <button id="btn-log" class="btn-log sp-10" type="button" name="connexion" onclick="openLogin()">Connexion</button>
              </div>
              <div class="header-log">
                <button id="btn-sign" class="btn-sign sp-10" type="button" name="connexion" onclick="openSignup()">Inscription</button>
              </div>
              <div class="header-cart">
                <button id="btn-cart" class="btn-cart sp-30" type="button" name="button" onclick="openCart()"><i class="fas fa-shopping-cart"></i></button>
                <label for="btn-cart">0</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
