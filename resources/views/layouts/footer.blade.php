<div id="footer" >
  <div class="block_banner">
    <div class="row" style="margin:0;">
      <div class="col-xs-4 col-sm-4 col-md-4 text-center">
        <i class="fas fa-comments"></i>
        <p>Free Advices</p>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 text-center">
        <i class="fas fa-envelope-open-text"></i>
        <p>Support plateform</p>
      </div>
      <div class="col-xs-4 col-sm-4 col-md-4 text-center">
        <i class="fas fa-medal"></i>
        <p>Certified Quality</p>
      </div>
    </div>
    <div class="line"></div>
    <div class="title text-center">
      <a href="{{ url('/') }}"><img src="../img/nav/logo.png" alt="Healthy's"></a>
    </div>
    <div class="row text-center" style="margin:0;">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="newsletter">
          <h3>Subscribe to our newsletter</h3>
          <h2>to be part of the family</h2>
          <form action="" method="post">
            <input type="email" name="" value="" placeholder="Email address *" required>
            <input type="submit" name="" value="Submit">
          </form>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
    <div class="social">
      <div class="row" style="margin:0;">
        <div class="col-md-4 offset-md-4 text-center col-sm-12">
          <ul>
            <li><i class="fab fa-twitter"></i></li>
            <li><i class="fab fa-instagram"></i></li>
            <li><i class="fab fa-facebook"></i></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="line" style="margin: 10px auto;"></div>
    <div class="link">
      <div class="col-md-12 text-center col-sm-12">
        <ul>
          <li><a href="#">Announces</a></li>
          <li><a href="#">Products</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
        <p>© HEALTHY'S</p>
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/scrollreveal"></script>
<script src="https://kit.fontawesome.com/d9a2e4a111.js" crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/leaflet.js') }}"></script>
<script src="{{ URL::asset('/js/script.js') }}" charset="utf-8"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
let menu_set = 0;
  function menu() {
    if (menu_set == 0) {
      $('#overlay').slideDown("slow");
      menu_set = 1;
    }else {
      $('#overlay').slideUp("slow");
      menu_set = 0;
    }
  }
</script>
<script>
  // window.onscroll = function() {myFunction()};

  // function myFunction() {
  //   if (document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000) {
  //     document.getElementById("top").style.display = "block";
  //   } else {
  //     document.getElementById("top").style.display = "none";
  //   }
  // }

  AOS.init({
  disable: false,
  startEvent: 'DOMContentLoaded',
  initClassName: 'aos-init',
  animatedClassName: 'aos-animate',
  useClassNames: false,
  disableMutationObserver: false,
  debounceDelay: 50,
  throttleDelay: 99,
  offset: 0,
  delay: 600,
  duration: 1200,
  easing: 'ease',
  once: false,
  mirror: false,
  anchorPlacement: 'top-bottom',
  });
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
