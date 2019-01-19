$(function () {
    $('.delete-data').click(function () {
        if(!confirm('Do you want to remove this record?')){
            return false;
        }
    });
});