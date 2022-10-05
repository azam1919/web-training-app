$(document).ready(function () {
    $('.delete_tutorial').click(function (e) {
        var el = this;
        e.preventDefault();
        var id = $(this).closest("tr").find('.id').val();
        // var parent = $(this).closest("tr").find('.parent').val();
        var frm = $('#actionUrl');
        console.log(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: frm.attr('action'),
                        data: {
                            "id": id,
                        },
                        success: function (response) {
                            $(el).closest('tr').css('background', 'tomato');
                            $(el).closest('tr').fadeOut(800, function () {
                                $(this).remove();
                            });
                            // swal("Data successfully Deleted.!", {
                            //     icon: "success",
                            // }).then((result) => {
                            //     // location.reload();

                            // });
                        },
                        error: (error) => {
                            console.log(JSON.stringify(error));
                        }
                    });
                }
            });
    });
});
