<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <title>{{ get_setting('minerals') }}</title> -->
     <title>Mines and Minerals Department GB</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="{{ asset('frontend/img/logo.png')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('frontend/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
     <!-- Template Stylesheet -->
     <link href="{{asset('frontend/css/home.css')}}" rel="stylesheet">

    <!-- JavaScript Libraries -->
    <script src="{{asset('frontend/js/jquery-3.4.1.min.js')}}" ></script>

    
      <!-- Include Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
   
    @stack('styles')
</head>

<body id="home" data-spy="scroll" data-target="#main-nav">
  <!--Navbar-->
  <header>
    <nav id="main-nav" class="navbar navbar-expand-lg navbar-light fixed-top py-4">
      <div class="container">
        <a href="#home" class="navbar-brand">
          <img src="{{ asset('frontend/img/logo.png')}}" alt="" width="50" height="50" alt="logo">
          <h1 class="d-inline align-middle h3">MICL</h1>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="{{ route("home.index") }}" class="nav-link">Home</a>
            </li>
            {{-- <li class="nav-item">
                <a href="#home" class="nav-link">Downloads</a>
              </li>
            <li> --}}
                <div class="four columns">
                    <a href="{{ route("home.register") }}" class="buttons flatbutt turquoise">Register Your Application</a>
                </div>
            </li>
            <li style="float: right;">
                <div class="four columns">
                    <a href="{{ route("login") }}" class="buttons flatbutt emerland" style="margin-left:10px"><i class="fa fa-user"></i> Login</a>
                </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  @yield('content')
  <!--Footer-->
  <footer id="main-footer" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-6 text-center">
          <p class="lead">
            Designed & Developed By &copy <span id="year"></span> 
          </p>
          <p>IT Departament Gilgit Baltistan</p>
        </div>
      </div>
    </div>
  </footer>

    <!-- JavaScript Libraries -->
    <script src="{{asset('frontend/js/jquery-3.4.1.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('frontend/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{asset('frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{asset('adm/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('adm/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script src="https://unpkg.com/@turf/turf/turf.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
	<script>
	var $ticker = $('[data-ticker="list"]'),
    tickerItem = '[data-ticker="item"]'
    itemCount = $(tickerItem).length,
    viewportWidth = 0;

function setupViewport(){
    $ticker.find(tickerItem).clone().prependTo('[data-ticker="list"]');

    for (i = 0; i < itemCount; i ++){
        var itemWidth = $(tickerItem).eq(i).outerWidth();
        viewportWidth = viewportWidth + itemWidth;
    }

    $ticker.css('width', viewportWidth);
}

function animateTicker(){
    $ticker.animate({
        marginLeft: -viewportWidth
      }, 30000, "linear", function() {
        $ticker.css('margin-left', '0');
        animateTicker();
      });
}

function initializeTicker(){
    setupViewport();
    animateTicker();

    $ticker.on('mouseenter', function(){
        $(this).stop(true);
    }).on('mouseout', function(){
        animateTicker();
    });
}

initializeTicker();
	</script>
    @stack('scripts')
</body>

</html>
