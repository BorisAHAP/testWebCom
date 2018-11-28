$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('a.showForm').on('click', function () {
    $('#hideForm').toggle('slow');
    $(this).toggle('hide');

})