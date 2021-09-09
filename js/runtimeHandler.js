$(document).ready(function() {
    $('#y-input :button').click(function() {
        $("input[type='button']").removeClass("active");
        $(this).addClass("active");
    })
})