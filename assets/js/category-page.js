$('#deleteCategModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('idcateg') // Extract info from data-* attributes

    console.log(id)

    var modal = $(this)
    modal.find('.modal-title').text('SUPPRIMER LA CATEGORIE ' + id + ' ?')
    modal.find('.modal-body').text('Ete-vous sûre de vouloir supprimer cette catégorie ?')
})

// $('#deleteCategModal').on('hide.bs.modal', function (event) {


    // url = "{{ path('delete_category_page', { 'id': 0}) }}"
    // url = url.replace("0", id)

    // $.ajax({ 
    //     url: url,
    //     type: 'DELETE', 
    //     success: function(result) {
    //         console.log('delete')
    //     },
    //     error: function(e){
    //         console.log(e.responseText);
    //     }
    // })
// })

$(document).on("click", "#confirmDeleteCateg", function () {

    var mId = $(this).data('categ');

    console.log(mId)

    route = '{{ path("delete_category_page"}}';
    route = route.replace('id', this.value)

    $.ajax({ 
        url: route,
        type: 'DELETE', 
        success: function (result) {
            console.log('delete ' + result)
        },
        error: function(e){
            console.log(e.responseText);
        }
    })

});