$(document).ready(function() {
    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function validateX() {
        const X_MIN = -3;
        const X_MAX = 5;
        let xVal = $('input[name="x"]').val().replace(',', '.');
        let isValid = isNumeric(xVal) && xVal >= X_MIN && xVal <= X_MAX;
        if (!isValid) {
            if (isNumeric(xVal)) {
                alert("Введеная координата х не соответствет промежутку [-3; 5]"); //TODO испавить alert-ы на
            } else {
                alert("Введеная координата х не является числом");
            }
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
            alert("Не выбрана координата y");
        }
        return {isValid: isValid, value: "y=" + yVal};
    }

    function validateR() {
        let rCheckbox = $('#r-input :checkbox');
        if (rCheckbox.is(':checked')) {
            return {isValid: true, value: rCheckbox.serialize()};
        } else {
            alert("Не выбран радиус области");
            return {isValid: false, value: rCheckbox.serialize()};
        }
    }

    function validateForm() {
        const verifiedX = validateX();
        const verifiedY = validateY();
        const verifiedR = validateR();
        return {isValid: verifiedX.isValid & verifiedY.isValid & verifiedR.isValid,
            value: verifiedX.value + "&" + verifiedY.value + "&" + verifiedR.value}
    }

    $("#input-data").on("submit", function(event) {
        event.preventDefault();
        const verifiedForm = validateForm();
        if (verifiedForm.isValid) {
            alert(verifiedForm.value);
        }
    })
})