<?php $this->_t = 'Blog de Jean Forteroche'; ?>

<!-- DEBUT CAROUSEL -->
<div id="carouselIndicators" class="carousel slide" data-ride="carousel">

    <!-- Indicateur du nombre de slide -->
    <ol class="carousel-indicators">
        <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselIndicators" data-slide-to="1"></li>
        <li data-target="#carouselIndicators" data-slide-to="2"></li>
    </ol>

    <!-- Contient les sliders et leurs description -->
    <div class="carousel-inner">

        <div class="carousel-item active" id="slider_1">
            <!-- Image 1 -->
            <img class="img-fluid" src="public/images/slider1.jpg" alt="First slide">
            <!-- Description slider 1 -->
            <div class="container">
                <div class="carousel-caption text-left">
                    <h1 class="style_title">Bienvenue sur le blog de Jean Forteroche !</h1>
                    <p class="style_texte">Pour mon prochain roman "Billet simple pour l'Alaska", j'ai souhaité pouvoir publier les chapitres en ligne sur mon blog. Un chapitre sortira par mois, bonne lecture !</p>
                    <p><a class="btn btn-lg btn-danger btn-carousel" href="#lastChapter" role="button">Voir les derniers chapitres</a></p>
                </div>
            </div>
        </div>

        <div class="carousel-item" id="slider_2">
            <!-- Image 2 -->
            <img class="img-fluid" src="public/images/slider2.jpg" alt="Second slide">
            <!-- Description slider 2 -->
            <div class="container">
                <div class="carousel-caption text-left">
                    <h2 class="style_title">Billet simple pour l'Alaska</h2>
                    <p class="style_texte">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-danger btn-carousel" href="book" role="button">Voir le livre</a></p>
                </div>
            </div>
        </div>

        <div class="carousel-item" id="slider_3">
            <!-- Image 2 -->
            <img class="img-fluid" src="public/images/slider3.jpg" alt="Third slide">
            <!-- Description slider 2 -->
            <div class="container">
                <div class="carousel-caption text-left">
                    <h2 class="style_title">Me contacter</h2>
                    <p class="style_texte">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-danger btn-carousel" href="contact" role="button">Contact</a></p>
                </div>
            </div>
        </div>

    </div>

    <!-- Chevron gauche -->
    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
        <i class="fas fa-angle-left"></i>
        <span class="sr-only">Previous</span>
    </a>

    <!-- Chevron droit -->
    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
        <i class="fas fa-angle-right"></i>
        <span class="sr-only">Next</span>
    </a>

</div>
<!-- FIN CAROUSEL -->

    <div class="banner-responsive">          
    <!-- 1ère image -->
        <img class="img-fluid" src="public/images/slider1.jpg" alt="First slide">
        <h2 class="title-banner">Bienvenue sur le blog de Jean Forteroche !</h2>
    </div>

<main>

    <section class="jumbotron text-center">
        <img src="public/images/portrait_jean_forteroche.png" class="rounded mx-auto d-block img-thumbnail" id="jean-forteroche" alt="Portrait de Jean Forteroche">
        <div class="container">
            <h2 class="mb-4">Qui suis-je ?</h2>
            <p class="text-jumbotron">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </section>

    <div class="py-5 bg-light" id="lastChapter">
        <div class="container">
            <h2 class="title-publication mb-4">Dernières publications :</h2>
            <div class="row">
            <?php foreach($chapters as $chapter): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="public/images/thumbnail1.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?= $chapter->title() ?></h5>
                            <p class="card-text"><?= nl2br(html_entity_decode(substr($chapter->content(), 0, 300))) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Bouton pour afficher le chapitre -->
                                <a class="btn btn-danger" href="chapter&amp;id=<?= $chapter->id() ?>" role="button">Voir chapitre</a>
                                <small class="text-muted"><?= $chapter->date() ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
