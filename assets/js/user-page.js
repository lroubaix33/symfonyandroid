$(document).ready( function () {
    $("#searchUser").on("keyup", function() {
        
        var value = $(this).val().toLowerCase();

        $("#userTableBody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});