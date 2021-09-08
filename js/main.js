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
        const validatedX = validateX();
        const validatedY = validateY();
        const validatedR = validateR();
        return {isValid: validatedX.isValid & validatedY.isValid & validatedR.isValid,
            data: validatedX.value + "&" + validatedY.value + "&" + validatedR.value}
    }

    $('#input-data').on("submit", function(event) {
        event.preventDefault();
        const validatedForm = validateForm();
        if (!validatedForm.isValid) return;
        $.ajax({
            url: 'php/main.php',
            method: 'GET',
            data: validatedForm.data + '&timezone=' + Intl.DateTimeFormat().resolvedOptions().timeZone,
            dataType: 'json',
            beforeSend: function() {
                $('#submit').attr('disabled', 'disabled');
            },
            success: function(response) {
                $('#submit').attr('disabled', false);
                createTable(response.data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus + '\n' + errorThrown);
            }
        })
    })

    function createTable(data) {
        let newTable = '<table>' +
            '<thead>' +
            '<tr>' +
            '<th>X</th>' +
            '<th>Y</th>' +
            '<th>R</th>' +
            '<th>Попали?</th>' +
            '<th>Текущее время</th>' +
            '<th>Время работы скрипта</th>' +
            '</tr>'+
            '</thead>' +
            '<tbody>';
        for (let elem of data) {
            newTable += '<tr>' +
                '<td>' + elem.x + '</td>' +
                '<td>' + elem.y + '</td>' +
                '<td>' + elem.r + '</td>' +
                '<td>' + elem.isHit + '</td>' +
                '<td>' + elem.currentTime + '</td>' +
                '<td>' + elem.executionTime + '</td>' +
                '</tr>';
        }
        newTable += '</tbody></table>';
        $('#result-table').html(newTable);
    }
})