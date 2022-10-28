<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>5x5 Advanced Drag'n'drop File Uploader Example</title>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.0/flatly/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script src="dist/js/imageupload/5x5jqpi.min.js"></script>

    <script>
        $(function() {


            $("#uploader").initUploader({
                selectOpts: {
                    one: 'jquery',
                    two: 'script',
                    three: 'net'
                },
                showDescription: true,
            });
        });
    </script>
    <!-- <script>
      var uppy = Uppy.Core()
        .use(Uppy.Dashboard, {
          inline: true,
          target: '#drag-drop-area'
        })
        .use(Uppy.Tus, {endpoint: 'https://master.tus.io/files/'}) //you can put upload URL here, where you want to upload images

      uppy.on('complete', (result) => {
        console.log('Upload complete! We’ve uploaded these files:', result.successful)
      })
    </script> -->

    <!-- <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove image</span>" +
                                "</span>").insertAfter("#files");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });

                            // Old code here
                            /*$("<img></img>", {
                              class: "imageThumb",
                              src: e.target.result,
                              title: file.name + " | Click to remove"
                            }).insertAfter("#files").click(function(){$(this).remove();});*/

                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script> -->
    <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Upload</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <!-- <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div> -->
    <div id="drag-drop-area"></div>

  </div>
</div>
    <script type="module">
        import {
            Uppy,
            Dashboard,
            XHRUpload,
            GoldenRetriever,
            Tus
        } from "https://releases.transloadit.com/uppy/v3.0.1/uppy.min.mjs"
        var uppy = new Uppy()
            .use(Dashboard, {
                inline: true,
                target: '#drag-drop-area',
                recoveredAllFiles: 'We restored all files. You can now resume the upload.',
                sessionRestored: 'Session restored',
            })
            .use(XHRUpload, {
                endpoint: "{{ route('tutorial.create.store') }}",
                headers: {
                    'X-CSRF-Token': " {{ csrf_token() }} "
                },
                formData: true,
                fieldName: 'fancy_upload[]',

            })
            .use(GoldenRetriever)
        uppy.on('complete', (result) => {
            console.log('Upload complete! We’ve uploaded these files:', result.successful);
            $('#upload_images #imagelist').empty().load(document.URL + '#upload_images #imagelist li');
        });
    </script>

    </body>

</html>