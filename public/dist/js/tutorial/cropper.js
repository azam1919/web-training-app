$(document).ready(function () {
          $('.update_crop').click(function (e) {
                    e.preventDefault();
                    $.ajaxSetup({
                              headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                    });
                    var str = $(this).serialize();
                    var description = CKEDITOR.instances['description'].getData();
                    var id = $('#image_id').val();
                    var description_result = description.replace(/(<p[^>]+?>|<p>|<\/p>)/img, "");
                    console.log(id);
                    console.log(description);

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
                                                  success: function (response) {
                                                            console.log('Done');
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
          });
});

