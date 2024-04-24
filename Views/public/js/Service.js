$(document).ready(function() {
    $('.ajax-form').on('submit', function(e) {
        e.preventDefault();  
        var formId = $(this).attr('id');
        var postData = $(this).serialize(); 

        $.post('http://localhost/Bricolini/Views/Services/reservationHandler.php', postData, function(response) {
            
            $('#notificationMessage').text("Réservation ajoutée avec succès");
            $('#notificationModal').css('display', 'block');
        });
    });
});
