<!DOCTYPE html>
<html>

<head>
    <title>Dropzone Tutorial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>

<body>
    <form action="/file-upload" class="dropzone">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>

</body>

</html>
