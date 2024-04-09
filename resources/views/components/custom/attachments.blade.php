<!DOCTYPE html>
<html>
    <head>
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    </head>

    <body>
        <input type="file"
               class="filepond"
               name="documents"
               id="documents"
               multiple
               data-allow-reorder="true"
               data-max-file-size="3MB">

        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

        <script>FilePond.registerPlugin(FilePondPluginImagePreview);
            const inputElement = document.querySelector('input[id="documents"]');
            const pond = FilePond.create(inputElement);

            var existingAttachments = @json($attachments->pluck('file_path')->toArray());
            FilePond.setOptions({
                allowImagePreview: true,
                imagePreviewHeight: 200,
                allowMultiple: true,
                server: {
                    process: '/upload/{{$driver->id}}',
                    headers: {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    }
                },
                // files: existingAttachments.map(path => ({
                //     source: path,
                //     options: {
                //         type: 'local',
                //     }
                // })),
            })
        </script>
    </body>
</html>