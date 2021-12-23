
<!DOCTYPE html>
<html lang="en" class="full-height">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap Template</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/compiled.min.css" rel="stylesheet">

    <style>
        
        .intro-2 {
            background: url("https://mdbootstrap.com/img/Photos/Others/img%20(46).jpg")no-repeat center center;
            background-size: cover;
        }
        .top-nav-collapse {
            background-color: #ff8a65 !important; 
        }
        .navbar:not(.top-nav-collapse) {
            background: transparent !important;
        }
        @media (max-width: 768px) {
            .navbar:not(.top-nav-collapse) {
                background: #ff8a65 !important;
            } 
        }
        .md-form .prefix {
            font-size: 1.5rem;
            margin-top: 1rem;
        }
        h6 {
            line-height: 1.7;
        }
        @media (max-width: 740px) {
            .full-height,
            .full-height body,
            .full-height header,
            .full-height header .view {
                height: 1100px; 
            } 
        }
    </style>

</head>

<body>

    <!--Main Navigation-->
    <header>
    
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-inverse fixed-top scrolling-navbar">
            <div class="container">
                <a class="navbar-brand" href="#"><strong>MDB</strong></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                    </ul>
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    </form>
                </div>
            </div>
        </nav>

        <!--Intro Section-->
        <section class="view intro-2 hm-stylish-strong">
            <div class="full-bg-img">
                <div class="container flex-center">
                    <div class="d-flex align-items-center">
                        <div class="row flex-center pt-5 mt-3">
                            <div class="col-md-6 text-center text-md-left mb-5">
                                <div class="white-text">
                                    <h1 class="display-4 wow fadeInLeft" data-wow-delay="0.3s">Lorem ipsum</h1>
                                    <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
                                    <h6 class="wow fadeInLeft" data-wow-delay="0.3s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem repellendus quasi fuga nesciunt dolorum nulla magnam veniam sapiente, fugiat! Commodi sequi non animi ea dolor molestiae, quisquam iste.</h6>
                                    <br>
                                    <a class="btn peach-gradient wow fadeInLeft" data-wow-delay="0.3s">Learn more</a>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-xl-5 offset-xl-1">
                                <!--Form-->
                                <div class="card wow fadeInRight" data-wow-delay="0.3s">
                                    <div class="card-body z-depth-2">
                                        <!--Header-->
                                        <div class="text-center">
                                            <h3>Write to us:</h3>
                                            <hr>
                                        </div>

                                        <!--Body-->
                                        <div class="md-form">
                                            <i class="fa fa-user prefix grey-text"></i>
                                            <input type="text" id="form3" class="form-control">
                                            <label for="form3">Your name</label>
                                        </div>
                                        <div class="md-form">
                                            <i class="fa fa-envelope prefix grey-text"></i>
                                            <input type="text" id="form2" class="form-control">
                                            <label for="form2">Your email</label>
                                        </div>

                                        <!--Textarea with icon prefix-->
                                        <div class="md-form">
                                            <i class="fa fa-pencil prefix grey-text"></i>
                                            <textarea type="text" id="form8" class="md-textarea"></textarea>
                                            <label for="form8">Your message</label>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn peach-gradient">Send</button>
                                            <hr>
                                            <fieldset class="form-group">
                                                <input type="checkbox" id="checkbox1">
                                                <label for="checkbox1">Subscribe me to the newsletter</label>
                                            </fieldset>
                                        </div>

                                    </div>
                                </div>
                                <!--/.Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    </header>
    <!--Main Navigation-->

    <!--Main Layout-->
    <main>

        <div class="container">
            
            <!--Grid row-->
            <div class="row py-5">

                <!--Grid column-->
                <div class="col-md-12 text-center">

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </div>

    </main>
    <!--Main Layout-->

    <!-- SCRIPTS -->
    <script type="text/javascript" src="js/compiled.min.js"></script>
    <script>
        new WOW().init();
    </script>

</body>
</html>