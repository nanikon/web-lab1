$(document).ready(function() {
    $(":button").click(function() {
        $("input[type='button']").removeClass("active"); //TODO решить стоит ли делать возможность не активной ни одну кнопку
        $(this).addClass("active");
    })

    $(":checkbox").click(function() {
        $(":checkbox").prop("checked", false);
        $(this).prop("checked", true);
    })
})