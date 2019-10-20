<?php $this->_t = "Profil de " . $profile->Pseudo(); ?>

<div class="container-profile bg-light">

    <div class="container col-lg-6 style-container"> 
        <h2>Profil de <?= $profile->pseudo(); ?></h2>
        <p>Email : <?= $profile->email(); ?></p>
        <p>Date d'inscription : le <?= $profile->dateInscription(); ?></p>
        <a class="text-danger" href="editprofile">Editer mon profil</a>
    </div>

</div>
