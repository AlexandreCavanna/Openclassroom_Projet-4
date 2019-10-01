<?php $this->_t = "Modifier ou supprimer un chapitre"; ?>

<!-- Page d'administration du site -->
<div class="container-editionchapter bg-light">
    <div class="container col-lg-8">
    <!-- Affichage des commentaires signalés -->
    <h2 class="text-center mt-5 mb-5">Liste des commentaires signalés :</h2>
        <table class="table table-responsive-sm">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Chapitre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($signalsComments as $signalComment): ?>
                <tr>
                    <td><?= $signalComment->titlePost() ?></td>
                    <td><?= $signalComment->author() ?></td>
                    <td><?= html_entity_decode($signalComment->comment()) ?></td>          
                </tr>
                <tr>
                    <td class="col-span-3">
                        <div class="btn-group btn-group-sm" role="group">
                            <a class="btn btn-primary btn-sm" href="comment&amp;id=<?=$signalComment->idPost() ?>">Voir commentaire</a>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Affichage des chapitres -->
        <h2 class="text-center mt-5 mb-5">Liste des chapitres :</h2>
        <table class="table table-responsive-sm">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Date de création</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($chapters as $chapter): ?>
                <tr>
                    <td><?= $chapter->title() ?></td>
                    <td><?= $chapter->author() ?></td>
                    <td><?= $chapter->date() ?></td>
                </tr>
                <tr>
                <!-- Options des chapitres -->
                    <td class="col-span-3">
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="editchapter&amp;id=<?= $chapter->id() ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="" class="btn btn-sm btn-danger trash" data-toggle="modal" data-id="<?= $chapter->id() ?>" data-target="#modalDeleteChapter">Supprimer</a>
                            <a href="comment&amp;id=<?= $chapter->id() ?>" class="btn btn-sm btn-success">Commentaire</a>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="btn btn-dark btn-block" href="newchapter">PUBLIER UN CHAPITRE</a>
    </div>
</div>
 
<!-- Modal pour supprimer un chapitre -->
<div class="modal fade" id="modalDeleteChapter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supression du chapitre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer le chapitre ?   
            </div>
            <div class="modal-footer">
                <a href="" id="modalDelete" class="btn btn-danger">Supprimer</a>
                <a href="" class="btn btn-secondary" data-dismiss="modal">Annuler</a>
            </div>
        </div>
    </div>
</div>




