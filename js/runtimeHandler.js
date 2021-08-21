$(document).ready(function() {
    $('#y-input :button').click(function() {
        $("input[type='button']").removeClass("active"); //TODO решить стоит ли делать возможность не активной ни одну кнопку
        $(this).addClass("active");
    })

    $('#r-input :checkbox').click(function() {
        $(":checkbox").prop("checked", false);
        $(this).prop("checked", true);
    })
})