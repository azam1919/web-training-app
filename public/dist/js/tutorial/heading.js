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
                    if (response == "Heading Name Already Exist") {
                        // alert('Heading Name Already Exist');
                        $('#heading_error').html(response);
                        $('#heading_error').css('color', 'red');
                        window.setInterval(function () {
                            $('#heading_error').slideUp('slow');
                        }, 3000);
                    } else {
                        response = JSON.parse(response);
                        // console.log(response.heading);
                        $("#heading").val(response.heading);
                        $("#status").val(response.status);
                        $('#heading_error').html(response.success);
                        $('#heading_error').css('color', 'green');
                        window.setInterval(function () {
                            $('#heading_error').slideUp('slow');
                        }, 3000);

                    }
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

