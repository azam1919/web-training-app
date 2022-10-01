$(document).ready(function () {
    $('.update_heading').click(function (e) {
        e.preventDefault();
        var heading = $('#heading').val();
        var status = $('#status').val();
        var id = $('#id').val();
        // var parent = $(this).closest("tr").find('.parent').val();
        var frm = $('#actionUrl');
        console.log(id);
        console.log(status);
        console.log(heading);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (heading != '') {
            $.ajax({
                type: "post",
                url: frm.attr('action'),
                data: {
                    "id": id,
                    "heading": heading,
                    "status": status,

                },
                success: function (response) {

                },
                error: (error) => {
                    console.log(JSON.stringify(error));
                }

            });
        } else {
            $('#heading').css('border', '1px solid red');
        }
    });
});

