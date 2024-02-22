$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault(); 
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'traitement.php',
            data: formData,
            success: function(response) {
                $('#response').html(response);
            }
        });
    });
});
