$('#deleteCategModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('idcateg') // Extract info from data-* attributes

    var modal = $(this)
    modal.find('.modal-title').text('SUPPRIMER LA CATEGORIE ' + id + ' ?')
    modal.find('.modal-body').text('Ete-vous sûre de vouloir supprimer cette catégorie ?')
});

$('#confirmDeleteCateg').on('click', function () {

    var mId = $(this).data("categ")

    // var mButton = $(event.relatedTarget) // mButton that triggered the modal
    // var mId = mButton.data('categ') // Extract info from data-* attributes

    route = Routing.generate('delete_category_page', {'id': mId})
    routeCateg = Routing.generate('category_page')

    $.ajax({ 
        url: route,
        type: 'DELETE', 
        success: function (result) {
            window.location.assign(routeCateg);
        },
        error: function(e){
            console.log(e.responseText);
        }
    })
});