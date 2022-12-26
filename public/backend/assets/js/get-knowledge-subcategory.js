var drivePath = window.location.pathname.replace('/','');
drivePath = drivePath.split('/');
var drivePathMainPath = '/'+drivePath[0];

$('#knowledge_category').on('change', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // alert(drivePathMainPath + '/knowledge-subcategory/');
    var id = $(this).val();

    $.ajax({
        type:'get',
        url: drivePathMainPath + '/knowledge-subcategory/'+id,
        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function (data) {
            $('#knowledge_subcategories_id').html(data);
        }
    });
});