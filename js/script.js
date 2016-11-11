$(document).ready(function () {
    $('#photo').submit(function () {
        var fd = new FormData(document.forms.photo);
        $.ajax({
            url: "addphoto.php",
            type: "post",
            data:fd,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#photo [type="file"]').val('');
                $('.gallery').empty();
                $.each(data, function(i,photo){
                    $('.gallery').append('<img src="'+photo.src+'"/>');
                });                
            }
        });
        return false;
    });
});