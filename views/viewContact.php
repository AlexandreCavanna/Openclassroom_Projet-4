<?php $this->_t = "Contact" ?>

<div class="container-contact bg-light">

    <!-- Formulaire de contact -->
    <div class="container">
        <h2 class="style-contact-title">Formulaire de contact :</h2>
        <form action="contact" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputname">Votre nom :</label>
                        <input type="text" name="name" class="form-control" id="inputname">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputemail">Votre email :</label>
                        <input type="email" name="email" class="form-control" id="inputemail">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="inputobject">Objet :</label>
                        <input type="text" name="subject" class="form-control" id="inputobject">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="inputcontent">Votre message :</label>
                        <textarea id="inputcontent" name="message" class="form-control" rows="5"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-danger btn-block">Envoyer</button>
                </div>
            </div>
        </form>
        <p class="text-center text-danger font-weight-bold style-register-error"><?php if(isset($error)) { echo $error; }?></p>
        <p class="text-center text-success font-weight-bold style-register-error"><?php if(isset($msg)) { echo $msg; }?></p>
    </div>
    
</div>