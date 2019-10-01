<?php $this->_t = "Edition du profil" ?>

<!-- Edition du profil -->
<div class="container-editprofile bg-light">
    <div class="container col-lg-3 style-container"> 
        <h2 class="style-contact-title text-center">Edition du profil :</h2>
        <form action="editprofile" method="POST" class="form-register">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="inputnewpseudo">Nouveau pseudo :</label>
                    <input type="text" name="newPseudo" class="form-control" id="inputnewpseudo" value="<?= $_SESSION['pseudo'] ?>">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="inputnewpassword">Nouveau mot de passe :</label>
                    <input type="password" name="newPassword" class="form-control" id="inputnewpassword">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="inputnewpassverif">Confirmation du mot de passe :</label>
                    <input type="password" name="newcPassword" class="form-control" id="inputnewpassverif">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="inputnewemail">Nouvel email :</label>
                    <input type="email" name="newEmail" class="form-control" id="inputnewemail" value="<?= $_SESSION['email'] ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-danger btn-block">Mettre à jour le profil</button>
            </div>
        </form>
        <p class="text-center text-danger font-weight-bold style-register-error"><?php if(isset($error)) { echo $error; }?></p>
   </div> 
</div>