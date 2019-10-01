// Quand on clique sur le bouton supprimer un chapitre
$('.trash').click(function(){
    // Récupération de l'id
    var id=$(this).data('id');
    // Ajout du href avec l'id
    $('#modalDelete').attr('href','administration&deletechapter&id='+id);
})

// Quand on clique sur le bouton supprimer un commentaire 
$('.trash2').click(function(){
    // Récupération de l'id
    var idPost=$(this).data('idpost');
    var id=$(this).data('id');
    // Ajout du href avec l'id
    $('#modalDeleteC').attr('href','deletecomment&id_post='+idPost+'&id='+id);
})

// Quand on clique sur le bouton signaler  
$('.trash3').click(function(){
    // Récupération de l'id
    var idPost=$(this).data('idpost');
    var id=$(this).data('id');
    // Ajout du href avec l'id
    $('#modalSignalC').attr('href','signalcomment&id_post='+idPost+'&id='+id);
})