<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.0/flatly/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>

<script src="{{ asset('dist/js/imageupload/5x5jqpi.min.js') }}"></script>

<script>
    $(function() {
        $("#uploader").initUploader({
            destination: "{{ route('tutorial.create.store') }}",
            destinationParams: {
                _token: $('#formdata').find('input[name="_token"]').first().val(),
            },

            showDescription: false,
        });
    });
</script>
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
<form action="" method="post" id="formdata">
    @csrf
    <div id="uploader"></div>
</form>
