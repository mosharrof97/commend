// function printDiv(divName) {

//     var printContents = document.getElementById(divName).innerHTML;
//     var originalContents = document.body.innerHTML;

//     document.body.innerHTML = printContents;
//     window.print();
//     // $('.example-screen').removeClass("none");

//     document.body.innerHTML = originalContents;

// }

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    var tempContainer = document.createElement('div');
    tempContainer.innerHTML = printContents;

    var elementsToHide = tempContainer.getElementsByClassName('action');
    for (var i = 0; i < elementsToHide.length; i++) {
        elementsToHide[i].style.display = 'none';
    }

    document.body.innerHTML = tempContainer.innerHTML;

    window.print();

    document.body.innerHTML = originalContents;
}


function excel(tableId) {
    const table = document.getElementById(tableId);
    
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.innerText);
    
    const csvContent = headers.join(',') + '\n' + 
        rows.map(row => 
            Array.from(row.querySelectorAll('td')).map(td => td.innerText).join(',')
        ).join('\n');
    
    const encodedUri = encodeURI('data:text/csv;charset=utf-8,' + csvContent);
    
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', 'table_data.csv');
    document.body.appendChild(link);
    
    link.click();
    
    document.body.removeChild(link);
}