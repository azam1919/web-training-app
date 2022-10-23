<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.update_crop').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            var description = CKEDITOR.instances['description'].getData();
            var id = $('#image_id').val();
            var description_result = description.replace(/(<p[^>]+?>|<p>|<\/p>)/img, "");
            console.log(id);
            console.log(description);
            if (description_result != '') {
                const cropper = new Cropper(image, {
                    aspectRatio: 16 / 9,
                    crop(event) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('tutorial.create.store') }}",
                            // contentType: 'application/json',
                            // dataType: 'json',
                            data: {
                                'id': id,
                                'description': description_result,
                                'x': event.detail.x,
                                'y': event.detail.y,
                                'width': event.detail.width,
                                'height': event.detail.height,
                                'rotate': event.detail.rotate,
                                'scaleX': event.detail.scaleX,
                                'scaleY': event.detail.scaleY,
                            },
                            success: function(response) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Updated Successfully'
                                })
                                cropper.destroy();
                                // cropper = new Cropper(image, options);
                            },
                            error: (error) => {
                                console.log(JSON.stringify(error));
                            }
                        });

                    },
                    function() {
                        jCropAPI = this
                    }
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Description Required'
                })
            }
        });
    });
</script>
