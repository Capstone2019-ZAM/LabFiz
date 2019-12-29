@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">

    <!-- header -->
    <div class="header-container text-white text-center pt-10" style="padding-top:-20px; margin-top:-20px">
        <div class="container mt-5">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1>Welcome to, ZAM Lab Solutions . This is a experimental labratory safety inspection
                        application.</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Panels  -->
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="icon-screen-desktop m-auto text-primary"></i>
                        </div>
                        <img width="100px" height="100px"
                             src="https://cdn2.iconfinder.com/data/icons/reports-and-analytics-7/49/9-512.png">
                        <h3>Create Inspection Reports</h3>
                        <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo elit at
                            imperdiet dui. Eu feugiat pretium nibh ipsum consequat.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="icon-layers m-auto text-primary"></i>
                        </div>
                        <img width="100px" height="100px"
                             src="https://cdn4.iconfinder.com/data/icons/seo-internet/512/10-512.png">
                        <h3>Live issue tracking</h3>
                        <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo elit at
                            imperdiet dui. Eu feugiat pretium nibh ipsum consequat.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="icon-check m-auto text-primary"></i>
                        </div>
                        <img width="100px" height="100px" src="http://cdn.onlinewebfonts.com/svg/img_326017.png">
                        <h3>Account managment</h3>
                        <p class="lead mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo elit at
                            imperdiet dui. Eu feugiat pretium nibh ipsum consequat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Showcases -->
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-2 text-white showcase-img"
                     style="background-image: url('http://www.annualreports.com/HostedData/CompanyHeader/NASDAQ_CDXC.jpg')"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Inspection Reports</h2>
                    <p class="lead mb-0">Dictum fusce ut placerat orci nulla. Consequat ac felis donec et odio
                        pellentesque diam. Arcu felis bibendum ut tristique et egestas quis ipsum suspendisse. Justo
                        eget magna fermentum iaculis eu non diam. </p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 text-white showcase-img"
                     style="  transform:rotateY(180deg); background-image: url('http://www.annualreports.com/HostedData/CompanyHeader/NASDAQ_CDXC.jpg');"></div>
                <div class="col-lg-6 my-auto showcase-text">
                    <h2>Issue Tracking</h2>
                    <p class="lead mb-0">Dictum fusce ut placerat orci nulla. Consequat ac felis donec et odio
                        pellentesque diam. Arcu felis bibendum ut tristique et egestas quis ipsum suspendisse. Justo
                        eget magna fermentum iaculis eu non diam. </p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-2 text-white showcase-img"
                     style="background-image: url(http://www.annualreports.com/HostedData/CompanyHeader/NASDAQ_CDXC.jpg);"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Account Managment</h2>
                    <p class="lead mb-0">Dictum fusce ut placerat orci nulla. Consequat ac felis donec et odio
                        pellentesque diam. Arcu felis bibendum ut tristique et egestas quis ipsum suspendisse. Justo
                        eget magna fermentum iaculis eu non diam. </p>
                </div>
            </div>
        </div>
    </section>
@endsection
