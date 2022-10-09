<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>5x5 Advanced Drag'n'drop File Uploader Example</title>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.0/flatly/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
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
<<<<<<< HEAD

    <style>
        body {
            background: #fafafa;
        }

        #warn {
            background: linear-gradient(45deg, rgba(255, 255, 255, .8) 0, rgba(255, 255, 255, .8) 32%, rgba(255, 0, 0, .5) 33%, rgba(255, 0, 0, .5) 66%, rgba(255, 255, 255, .8) 67%, rgba(255, 255, 255, .8) 100%);
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 29px;
            background-repeat: repeat;
            background-size: 137px 56px;
            text-align: center;
            font-weight: 900;
            border: thin solid #929292;
            text-shadow: 0 0 8px #fff;
        }
    </style>


</head>

<body>
    <div class="container my-5">
        {{-- <div id="carbon-block" style="margin:30px auto" align="center"></div> --}}
        <div id="uploader"></div>
    </div>
=======
      <script>
      var uppy = Uppy.Core()
        .use(Uppy.Dashboard, {
          inline: true,
          target: '#drag-drop-area'
        })
        .use(Uppy.Tus, {endpoint: 'https://master.tus.io/files/'}) //you can put upload URL here, where you want to upload images

      uppy.on('complete', (result) => {
        console.log('Upload complete! We’ve uploaded these files:', result.successful)
      })
    </script>

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
>>>>>>> c89f3d0df1a6576c0f81ac7397c8733d2eae8bdf
</body>

</html>
