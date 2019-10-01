<?php $this->_t = "Connexion"; ?>

<div class="container-profile bg-light">

    <div class="container">
        <!-- Formulaire de connexion au site -->
        <form class="form-signin" method="POST" action="authentication">
            <h2 class="style-contact-title text-center">Connexion</h2>
            <div class="col-lg-4 offset-lg-4 mb-3">
                <label for="emailconnect" class="sr-only">Adresse Email</label>
                <input type="email" name="emailconnect" id="emailconnect" class="form-control" placeholder="Adresse Email">
            </div>
            <div class="col-lg-4 offset-lg-4 mb-3">
                <label for="passwordconnect" class="sr-only">Mot de passe</label>
                <input type="password" name="passwordconnect" id="passwordconnect" class="form-control" placeholder="Mot de passe">
            </div>
            <div class="col-lg-4 offset-lg-4">
                <button class="btn btn-danger btn-block" type="submit" name="submit">Connexion</button>
            </div>
        </form>
        <p class="text-center text-danger font-weight-bold style-register-error"><?php if(isset($error)) { echo $error; } ?></p>
        <p class="text-center">Pas encore inscrit ? <a href="register">Inscrivez-vous ici !</a></p>
 
    </div>

</div>