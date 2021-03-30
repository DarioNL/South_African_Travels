$(document).ready(function () {
    $('.new-accommodation').click(function () {
        addItem();
    });
});

itemsID = document.getElementById("total_items")
var total_items = parseInt(itemsID.value);

function addItem() {
    tableID = document.getElementById("order-table");

    total_items++
    document.getElementById("total_items").value = total_items;
    var newFields = document.getElementById('table-rows').cloneNode(true);
    newFields.id = '';


    var newRows = newFields.querySelectorAll('.copy');

    for (var i=0;i<newRows.length;i++) {
        var theName = newRows[i].name
        if (theName)
            newRows[i].name = theName.replace('1', total_items);
        var theId = newRows[i].id
        if (theId)
            newRows[i].id = theId.replace('1', total_items);
        var theValue = newRows[i].value
        if (theValue)
            newRows[i].Value = '';
        var theClass = newRows[i].class
    }


    var insertHere = document.getElementById('table-rows');
    insertHere.parentNode.insertBefore(newFields,insertHere);
}
