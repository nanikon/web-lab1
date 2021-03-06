$(function() {
    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function validateX() {
        const X_MIN = -3;
        const X_MAX = 5;
        let xVal = $('input[name="x"]').val().replace(',', '.');
        let isValid = isNumeric(xVal) && xVal >= X_MIN && xVal <= X_MAX;
        if (!isValid) {
            $('#x-input span').removeClass("hide");
        }
        return {isValid: isValid, value: "x=" + xVal};
    }

    function validateY() {
        let yVal = NaN;
        let isValid = false;
        $('input[name="y"]').each(function(i, elem) {
            if ($(elem).hasClass("active")) {
                yVal = $(elem).val();
                isValid = true;
            }
        })
        if (!isValid) {
            $('#y-input span').removeClass("hide");
        }
        return {isValid: isValid, value: "y=" + yVal};
    }

    function validateR() {
        let rCheckbox = $('#r-input :checkbox');
        if (rCheckbox.is(':checked')) {
            return {isValid: true, value: rCheckbox.serialize()};
        } else {
            $('#r-input span').removeClass("hide");
            return {isValid: false, value: rCheckbox.serialize()};
        }
    }

    function validateForm() {
        const validatedX = validateX();
        const validatedY = validateY();
        const validatedR = validateR();
        return {isValid: validatedX.isValid & validatedY.isValid & validatedR.isValid,
            data: validatedX.value + "&" + validatedY.value + "&" + validatedR.value}
    }

    $('#input-data').on("submit", function(event) {
        event.preventDefault();
        $('#x-input span').addClass("hide");
        $('#y-input span').addClass("hide");
        $('#r-input span').addClass("hide");
        const validatedForm = validateForm();
        if (!validatedForm.isValid) return;
        $.ajax({
            url: 'php/main.php',
            method: 'GET',
            data: validatedForm.data +'&timezone=' + Intl.DateTimeFormat().resolvedOptions().timeZone,
            dataType: 'json',
            beforeSend: function() {
                $('#submit').attr('disabled', 'disabled');
            },
            success: function(response) {
                $('#submit').attr('disabled', false);
                createTable(response.answer);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#result-table').append(`<h3>?????? ?????????????????? ?????????????? ?????????????????? ???????????? <br> ${textStatus} <br> ${errorThrown}</h3>`);
            }
        })
    })
})