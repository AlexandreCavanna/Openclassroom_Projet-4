<?php $this->_t = "Modifier un chapitre"; ?>

<div class="container-page bg-light">

    <div class="container col-lg-8 style-link">
        <a class ="text-danger" href="administration">Retour sur le tableau</a>
    </div>
    <!-- Modification d'un chapitre -->
    <div class="container col-lg-8 style-container">
        <h2 class="text-center">Modifier un chapitre :</h2>
        <form action="" method="POST" class="form-register">
            <div class="form-group">
                <label for="inputpseudo">Titre :</label>
                <input type="text" name="new_chapter_title" class="form-control" id="inputpseudo" value="<?= $chapter->title() ?>">
            </div>
            <div class="form-group">
                <textarea name="new_chapter_content" id="newchapter"><?= $chapter->content() ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-danger btn-block">Mettre à jour</button>
        </form>
        <p class="text-center text-danger font-weight-bold style-register-error"><?php if(isset($error)) { echo $error; }?></p>
        <p class="text-center text-success font-weight-bold style-register-error"><?php if(isset($msg)) { echo $msg; }?></p>
    </div>

</div>
