<link rel="stylesheet" type="text/css" href="css/home.css">

<!-- Header -->
<header id="header">
    <div class="jumbotron m-0" style="background-color: rgba(0, 0, 0, 0);">
        <h1 class="header-title">A new, redefined system</h1>
        <p class="lead" style="max-width: 55vw;">
            We call it <b>CARS</b>. Well, its longer name, College Activity Registration System. Designed with love by
            students, for students.
        </p>
        <hr class="my-4" />
        <div class="header-button-container">
            <button type="button" class="btn header-btn px-5 py-3"
                style="background-color: #00df89; border-color: #00df89;">
                CONTACT US
            </button>
            <button id="button-sign-up" type="button" class="btn btn-outline-light header-btn px-5 py-3">
                SIGN UP
            </button>
        </div>
    </div>

    <img class="header-image" src="assets/cert.svg" />
</header>

<main>
    <h1 class="title-center">What do we offer!</h1>

    <!-- Activities wrapper -->
    <div class="carousel-wrapper">
        <!-- Bootstrap Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/activitydetail.jpg" alt="First slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Join Activities</h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et
                            dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="assets/food.jpg" alt="Second slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Buy Food</h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et
                            dolore magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="assets/room.jpg" alt="Third slide" />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Apply for college rooms</h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et
                            dolore magna aliqua.
                        </p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Desc -->
        <div class="description-wrapper">
            <div class="headline">
                <div style="height: 2px; width: 24px; background-color: #00df89; margin-right: 12px;"></div>
                <p>ALL IN ONE</p>
            </div>
            <div class="description">
                <h1 style="width: 80%;">
                    All college activities in one place
                </h1>
                <p style="width: 75%;">
                    Imagine, being a University of Malaya student wanting to join communtities from different colleges,
                    but
                    clueless on how to get on track? It's okay. We do it for you.<br />
                </p>

                <p style="width: 75%;">
                    From here, you can do so many things, from viewing available activities, to joining multiple
                    communities
                    in a single click<br />
                </p>
                <a type="button" class="btn desc-btn px-5 py-3"
                    style="background-color: #00df89; border-color: #00df89;" href="index.php?page=activities">
                    FIND OUT MORE
                </a>
            </div>
        </div>
    </div>

    <div class="features"></div>
</main>