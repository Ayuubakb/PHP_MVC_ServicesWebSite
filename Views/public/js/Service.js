$(document).ready(function() {
    $('.ajax-form').on('submit', function(e) {
        e.preventDefault();  
        var formId = $(this).attr('id');
        var postData = $(this).serialize(); 

        $.post('http://localhost/Bricolini/Views/Services/reservationHandler.php', postData, function(response) {
            
            alert("Réservation ajoutée avec succès"); 
        });
    });
});