<?php $this->_t = $chapter->title() ?>

<div class="container-page bg-light">
    <div class="container style-link">
        <a class="text-danger" href="book">Retour sur la liste des chapitres</a>
    </div>
    <!-- Affichage du chapitre -->
    <div class="container style-container">
        <div class="row style-row">
            <h2 class="chapter-title"><?= $chapter->title() ?></h2>
        </div>
        <p class="date-author text-danger"><?= $chapter->author() ?> le <?= $chapter->date() ?></p>
        <p class="content"><?= nl2br(html_entity_decode($chapter->content())) ?></p>
        <?php
        // Si le champ date_modification est différent de null, on affiche la date de modification
        if($chapter->dateModification() !== null)
        {
            echo "<p class=\"date-author text-danger\">Modification le " . $chapter->dateModification() ."</p>";
        }
        ?>
    </div>

    <div class="container">
        <?php

        $content;
            // Si on est connecté, affichage du champ pour écrire un commentaire
            if(!empty($_SESSION))
            {
                echo $content = 
                "<h2 class=\"mt-4 mb-4\">Poster un commentaire :</h2>
                <form action=\"\" method=\"POST\" class=\"form-register\">
                    <textarea name=\"comment\" id=\"newcomment\"></textarea>
                    <button type=\"submit\" name=\"submit\" class=\"btn btn-danger btn-block mt-3\">Envoyer le commentaire</button>
                </form>";
            }
            // Sinon affichage d'un lien pour se connecter ou s'inscrire
            else
            {
                echo  $content = "<p class=\"text-center\"><a href=\"authentication\">Connectez-vous</a> ou <a href=\"register\">inscrivez-vous</a> pour ajouter un commentaire.</p>";
            }
        ?>
        <p class="text-center text-danger font-weight-bold style-register-error"><?php if(isset($error)) { echo $error; }?></p>
        <!-- Affichage des commentaires du chapitre -->
        <h2 class="mt-4">Commentaires :</h2>

        <?php foreach($comments as $comment) : ?>    
            <?php
                // Affichage des commentaires
                if($comment->checkComment() == 1 OR $comment->checkComment() == 2 )
                {
                    echo "<div class=\"container style-comment\">";
                        // Si la personne connectée est l'auteur du message elle a accès au bouton de modification
                        if(isset($_SESSION['pseudo']) AND $_SESSION['pseudo'] == $comment->author())
                        {
                            echo "<p class=\"text-danger\"><span class=\"font-weight-bold\">" . $comment->author() . '</span> le ' .  $comment->dateComment() . "<a class=\"float-right text-danger\" href=\"editcomment&id_post=" . $comment->id() . "&id=" . $chapter->id() . "\">Modifier</a></p>";
                        }
                        // Si elle n'est pas l'auteur, aucun bouton n'apparait
                        else
                        {
                            echo "<p class=\"text-danger\"><span class=\"font-weight-bold\">" . $comment->author() . '</span> le ' .  $comment->dateComment() . "</p>";
                        }
                        echo "<p>" . html_entity_decode($comment->comment()) . "</p>";
                        echo "<div class=\"dropdown-divider\"></div>";
                        echo "<div class=\"comment-flex\">";
                            // Affiche la date de modification s'il y en a une
                            if($comment->dateModification() !== null)
                            {
                                echo "<p class=\"date-author text-danger paragraphe-comment\">Modifié par " . $comment->author() . " le " . $comment->dateModification() . "</p>";
                            }
                            // Bouton pour signaler un message
                            if(!empty($_SESSION) AND $_SESSION['pseudo'] !== $comment->author() AND $comment->checkComment() == 1)
                            {
                                echo "<p class=\"paragraphe-comment\"><a class=\"text-danger trash3\" href=\"\" data-toggle=\"modal\" data-id=\"" . $chapter->id() . "\" data-idpost=\"" . $comment->id() . "\" data-target=\"#modalSignalComment\">Signaler le commentaire</a></p>";
                            }
                        echo "</div>";
                    echo "</div>";    
                }
            ?>
        <?php endforeach; ?>
        
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalSignalComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Signaler le commentaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir signaler le commentaire ?   
            </div>
            <div class="modal-footer">
                <a href="" id="modalSignalC" class="btn btn-danger">Signaler</a>
                <a href="" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
            </div>
        </div>
    </div>
</div>