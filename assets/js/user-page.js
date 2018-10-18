$(document).ready( function () {
    $("#searchUser").on("keyup", function() {
        
        var value = $(this).val().toLowerCase();

        $("#userTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready( function () {
    $("#searchCategory").on("keyup", function() {
        
        var value = $(this).val().toLowerCase();

        $("#categoryTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready( function () {
    $("#searchMaterial").on("keyup", function() {
        
        var value = $(this).val().toLowerCase();

        $("#materialTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready( function () {
    $("#searchMaterialByCat").on("keyup", function() {
        
        var value = $(this).val().toLowerCase();

        $("#materialCatTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});