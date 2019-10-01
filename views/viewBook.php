<?php $this->_t = "Billet simple pour l'Alaska"; ?>
<!-- Affichage de tous les chapitres -->
<div class="container-page bg-light">
    <?php foreach($chapters as $chapter): ?>
    <div class="container style-container col-xl-8 col-lg-10 col-md-10">
        <div class="row style-row">
            <h2 class="chapter-title"><?= $chapter->title() ?></h2>  
        </div>
        <p class="date-author text-danger"><?= $chapter->author() ?> le <?= $chapter->date() ?></p>
        <p class="content"><?= nl2br(html_entity_decode(substr($chapter->content(), 0, 1000))) ?></p>
        <br>
        <a href="chapter&amp;id=<?= $chapter->id() ?>" class="btn btn-outline-danger">Voir le chapitre</a>
    </div>
    <?php endforeach; ?>
</div>
