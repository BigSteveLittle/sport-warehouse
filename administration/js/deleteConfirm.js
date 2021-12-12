$(document).ready(function() {
    $(".delete").click(function() {
        if(!confirm("Careful, are you sure you want to delete?")) {
            return false;
        }
    });
});