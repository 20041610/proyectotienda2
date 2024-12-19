<?php
include("./tienda/templates/cabecera.php");
include("./admin/configuraciones/baseDeDatos.php");

?>

</head>

<body>

    <!--
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-mosaic">
                    <img src="/proyectotienda/admin/imagenes/bengRacing.jpg" alt="Imagen 4">
                    <img src="/proyectotienda/admin/imagenes/bengRiver.jpg" alt="Imagen 5">
                    <img src="/proyectotienda/admin/imagenes/bengBocaMyM.jpg" alt="Imagen 5">
                </div>
            </div>
            <div class="carousel-item active">
                <img src="/proyectotienda/admin/imagenes/Bengalas.png" class="w-100 d-block img-carousel"
                    alt="First slide" />
            </div>
            <div class="carousel-item">
                <img src="/proyectotienda/admin/imagenes/bengalas3Carousel.jpg" class="w-100 d-block img-carousel"
                    alt="Second slide" />
            </div>
            <div class="carousel-item">
                <img src="/proyectotienda/admin/imagenes/pirulinesCarousel.jpg" class="w-100 d-block img-carousel"
                    alt="Third slide" />
            </div>
            <div class="carousel-item">
                <img src="/proyectotienda/admin/imagenes/bengalas4Carousel.jpg" class="w-100 d-block img-carousel"
                    alt="Third slide" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>-->
    <!---->
    <div class="container-carousel">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="/proyectotienda/admin/imagenes/Bengalas.png" class="w-100 d-block img-carousel"
                        alt="First slide" />
                </div>
                <div class="carousel-item">
                    <img src="/proyectotienda/admin/imagenes/bengalas3Carousel.jpg" class="w-100 d-block img-carousel"
                        alt="Second slide" />
                </div>
                <div class="carousel-item">
                    <img src="/proyectotienda/admin/imagenes/pirulinesCarousel.jpg" class="w-100 d-block img-carousel"
                        alt="Third slide" />
                </div>
                <div class="carousel-item">
                    <img src="/proyectotienda/admin/imagenes/bengalas4Carousel.jpg" class="w-100 d-block img-carousel"
                        alt="Third slide" />
                </div>
                <div class="carousel-item">
                    <div class="carousel-mosaic">
                        <img src="/proyectotienda/admin/imagenes/bengRacing.jpg" alt="Imagen 4"
                            class="w-100 d-block img-carousel">
                        <img src="/proyectotienda/admin/imagenes/bengRiver.jpg" alt="Imagen 5"
                            class="w-100 d-block img-carousel">
                        <img src="/proyectotienda/admin/imagenes/bengBocaMyM.jpg" alt="Imagen 5"
                            class="w-100 d-block img-carousel">
                    </div>
                </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container-fluid bg-light p-5">
        <div class="row">
            <div class="col-md-3">
                <img src="/proyectotienda/admin/imagenes/bengRiver.jpg" class="img-fluid rounded-top" alt="" />
            </div>
            <div class="col-md-3">
                <img src="/proyectotienda/admin/imagenes/bengRacing.jpg" class="img-fluid rounded-top" alt="" />
            </div>
            <div class="col-md-3">
                <img src="/proyectotienda/admin/imagenes/bengSLorenzo.jpg" class="img-fluid rounded-top" alt="" />
            </div>
            <div class="col-md-3">
                <img src="/proyectotienda/admin/imagenes/bengChicago.jpg" class="img-fluid rounded-top" alt="" />
            </div>
            <div class="col-md-3">
                <img src="/proyectotienda/admin/imagenes/bengRojo.jpg" class="img-fluid rounded-top" alt="" />
            </div>
            <div class="col-md-3">
                <img src="/proyectotienda/admin/imagenes/bengRosa.jpg" class="img-fluid rounded-top" alt="" />
            </div>
            <div class="col-md-3">
                <img src="/proyectotienda/admin/imagenes/bengPlata.jpg" class="img-fluid rounded-top" alt="" />
            </div>
            <div class="col-md-3">
                <img src="/proyectotienda/admin/imagenes/bengAzul.jpg" class="img-fluid rounded-top" alt="" />
            </div>
        </div>
    </div>
    <?php
    include("./tienda/templates/pie.php");
    ?>