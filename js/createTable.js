function createTable(userData) {
    let newTable = `<table>
        <thead>
            <tr>
                <th>X</th>
                <th>Y</th>
                <th>R</th>
                <th>Попали?</th>
                <th>Текущее время</th>
                <th>Время работы скрипта (в микросек.)</th>
            </tr>
        </thead>
        <tbody>`;
    for (let elem of userData) {
        if (typeof elem.x !== "undefined") {
            newTable += `<tr>
                <td>${elem.x}</td>
                <td>${elem.y}</td>
                <td>${elem.r}</td>
                <td>${elem.isHit}</td>
                <td>${elem.currentTime}</td>
                <td>${elem.executionTime}</td>
            </tr>`;
        }
    }
    newTable += '</tbody></table>';
    $('#result-table').html(newTable);
}