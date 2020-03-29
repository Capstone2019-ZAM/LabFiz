<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        /* ---- particles.js config ---- */
window.onload= function(){
particlesJS("particles-js",
{
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#008080"
    },
    "shape": {
      "type": "polygon",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 4
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 126.26362266116361,
      "color": "#988282",
      "opacity": 0.4,
      "width": 1.4204657549380908
    },
    "move": {
      "enable": true,
      "speed": 1.5,
      "direction": "top-right",
      "random": true,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": true,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "repulse"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
}
);
}



        </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
    <!-- Styles -->
    <style>
      .cimg{
        max-width: 60% !important;
        max-height:200px;
      }
      .br-lg{
        height: 200px;
      }
      @media only screen and (max-width: 600px) {
        .row {
            justify-content: center;
        }
        .t2{
          text-align: center;
        }
        }
        
        @media only screen and (min-width: 601px) and (max-width: 980px) {
        .row {
            justify-content: center;
        }
        .t2{
          text-align: center !important;
        }
        }
        @media only screen and (min-width: 1000px) {
        .row {
            justify-content: left;
        }
        .t2{
          text-align: left !important;
        }
        }
      </style>
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

    @include('partials.head')
</head>
<body>
<div id="app">
    
    <main class="py-4">
        @yield('content')
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/welcome.css')}}">

        <div id="particles-js"></div>

        <!-- header -->

           
        <!-- Panels  -->
        <section class="features-icons  text-center">

            <div class="container">
                <div class="row ">
                    <div class="col-lg-4">
                    <img  src= "{{ asset('images/labfiz_logo_hd.png') }}" alt="LabFiz"  style="max-width: 60%;">
                    </div>
                    <div class="col-lg-4">
                      <div class="row ">  
                      <h1 class="display-2" >LabFiz</h1>
                      </div>
                      <div class="row ">
                        <h2 class="display-5 t2">Laboratory Safety and
                           Inspection Made Easy</h2>
                      </div>
                      <div class="row ">
                        <button type="button" class="btn btn-dark btn-lg " onclick="window.location.href='/login'">Get Started</button>
                      </div>

                    </div>
            </div>
            <div class="br-lg">
            </div>
            
            <div class="row my-5">
                <div class="col-lg-4">

                <div class="card mx-2">
                    <h5 class="card-header">Custom Templates</h5>
                    <div class="card-body" >
                      <h5 class="card-title">Create your own custom templates</h5>
                      <img class="img-fluid cimg" src= "{{ asset('images/undraw_file.svg') }}"  alt="LabFiz"   >

                      <h6 class="card-text ft-desc">Create your own custom checklists and inspection templates as your orginization demands.</h6>
                      
                    </div>
                  </div>
                </div>
                  <div class="col-lg-4">
                  <div class="card mx-2" >
                    <h5 class="card-header">Manage Inspections</h5>
                    <div class="card-body" >
                      <h5 class="card-title">Create and assign inspections with ease</h5>
                      <img class="img-fluid cimg"src= "{{ asset('images/undraw_collab.svg') }}" alt="LabFiz"    >

                      <h6 class="card-text ft-desc">You can create assignments for your team member and track their progress through reports with ease.</h6>
                      
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-4">
                  <div class="card mx-2">
                    <h5 class="card-header">Track Issues</h5>
                    <div class="card-body" >
                      <h5 class="card-title ">Log and track issues and collaborate with team</h5>
                      <img class="img-fluid cimg" src= "{{ asset('images/undraw1.svg') }}" alt="LabFiz"     >

                      <h6 class="card-text ft-desc">Something went wrong :/ Create an issue log and track its progress easily.</h6>
                      
                    </div>

                  </div>
                  
            </div>
            <div class="col-lg-4">

                <div class="card mx-2">
                    <h5 class="card-header">Account Management</h5>
                    <div class="card-body" >
                      <h5 class="card-title">Easily create and assign access to your team mates</h5>
                      <img class="img-fluid cimg" src= "{{ asset('images/undraw_team.svg') }}" alt="LabFiz"     >

                      <h6 class="card-text ft-desc">Manage your team and grant them roles as they need.</h6>
                      
                    </div>
                  </div>
                </div>

                <div class="col-lg-4">

                    <div class="card mx-2">
                        <h5 class="card-header">LabFiz is Open Source!</h5>
                        <div class="card-body" >
                          <h5 class="card-title">Found an issue or have an idea? Fork us on <a href="https://github.com/Capstone2019-ZAM/Capstone">Github</a></h5>
                          <img class="img-fluid cimg" src= "{{ asset('images/undraw_code.svg') }}" alt="LabFiz"     >
    
                          <h6 class="card-text ft-desc">And you are free to modify and use our code without any strings attached.</h6>
                          
                        </div>
                      </div>
                    </div>
            </div>
        </section>
    
        <!-- Image Showcases -->
      
    </main>
</div>
@include('partials.footer')
@yield('content-js-files')
</body>
</html>

