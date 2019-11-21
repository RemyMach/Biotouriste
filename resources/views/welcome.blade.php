<?php include('header.php'); ?>
  <div id="content-1">
    <?php include('navbar.php'); ?>
    <!-- <button class="btn-next" type="button" name="button"><i class="fas fa-chevron-left"></i></button>
    <button class="btn-next" type="button" name="button"><i class="fas fa-chevron-right"></i></button>
    <button class="btn-style" type="button" name="button">Order now</button> -->
    <div class="row">
      <div class="col-md-8">
        <div class="blob-container">
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

  </div>
<?php include('footer.php'); ?>
