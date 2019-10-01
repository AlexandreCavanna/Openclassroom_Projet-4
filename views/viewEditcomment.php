<?php $this->_t = "Modifier un commentaire" ?>

<div class="container-editcomment bg-light">

    <div class="container col-lg-8 style-link">
        <a class="text-danger" href="chapter&amp;id=<?= $chapter->id() ?>">Retour sur le <?= $chapter->title() ?></a>
    </div>
    <!-- Modification d'un commentaire -->
    <div class="container col-lg-8 style-container">
        <h2 class="text-center">Modifier le commentaire de <?= $comment->author() ?> :</h2>
        <form action="" method="POST" class="form-register">
            <div class="form-group">
                <textarea name="newcomment" id="editcomment"><?= $comment->comment() ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-danger btn-block">Publier le commentaire</button>
        </form>
        <p class="text-center text-danger font-weight-bold style-register-error"><?php if(isset($error)) { echo $error; }?></p>
        <p class="text-center text-success font-weight-bold style-register-error">
        <?php 
            if(isset($msg)) 
            { 
                echo $msg; 
                echo "<a href=\"chapter&amp;id=" .  $chapter->id() . "\"> Retournez au " . $chapter->title() . "</a>"; 
            }
        ?>
        </p>
    </div>

</div>