$(function() {
    $.ajax({
        url: 'php/sendData.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            createTable(response.answer);
        }
    })

    $('#y-input :button').on("click",function() {
        $("input[type='button']").removeClass("active");
        $(this).addClass("active");
    })
})