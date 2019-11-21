<?php include('header.php'); ?>
  <div id="content-1">
    <?php include('navbar.php'); ?>
    <div class="row">
      <div class="col-md-8">
        <div class="blob-container-1">
          <div class="col-md-7 text-center">
            <h3>Rechercher un agriculteur avec une adresse ou en se localisant.</h3>
          </div>
          <div class="row blob-content blob-content-left">
            <div class="col-md-5 text-center">
              <form class="col-md-12" action="index.html" method="post">
                <input class="col-md-12" type="text" name="" value="" placeholder="Adresse">
                <input class="col-md-12" type="text" name="" value="" placeholder="Code postal">
                <input class="col-md-12" type="text" name="" value="" placeholder="Ville">
                <input class="col-md-12" type="text" name="" value="" placeholder="Pays">
                <button class="btn-map-submit sp-10" type="submit" name="button">Rechercher</button>
              </form>
            </div>
            <div class="col-md-1 blob-content blob-content-right">
              <button class="btn-map" type="button" name="button"><i class="fas fa-map-marker-alt"></i></button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">

      </div>
    </div>
    <div class="col-md-12 text-center">
      <a href="#content-2"><button class="btn-next sp-5" type="button" name="button"><i class="fas fa-chevron-down"></i></button></a>
    </div>
  </div>
  <div id="content-2">
    <div class="row">
      <div class="col-md-4">

      </div>
      <div class="col-md-8">
        <div class="blob-container-2">

        </div>
      </div>
    </div>
    <div class="col-md-12 text-center">

    </div>
  </div>
  <div id="content-3">
    <div class="row">
      <div class="col-md-8">
        <div class="blob-container-3">
          <h3>Nous contactez</h3>
          <div class="row blob-content blob-content-3-left">
            <div class="col-md-12 text-center">
              <form class="col-md-6" action="index.html" method="post">
                <input class="col-md-12" type="text" name="" value="" placeholder="Adresse e-mail">
                <textarea class="col-md-12" name="name" rows="8" cols="80"></textarea>
                <button class="btn-map-submit sp-10" type="submit" name="button">Envoyer</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
      </div>
    </div>
    <div class="col-md-12 text-center">

    </div>
  </div>
<?php include('footer.php'); ?>
