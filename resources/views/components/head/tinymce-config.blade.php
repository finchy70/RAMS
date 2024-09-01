<script src="https://cdn.tiny.cloud/1/jpyjrs5mhzkdhlcu8zonluhpk7vlla0p39zwinxnybmjw6av/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#tiny', // Replace this CSS selector to match the placeholder element for TinyMCE
        image_class_list: [
            {title: 'img-responsive', value: 'img-responsive'},
        ],
        height: 500,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
        },
        plugins: 'code table lists image editimage',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image',
        image_title: true,
        automatic_uploads: true,
        images_upload_url: '/tiny-image-upload',
        relative_urls: false,
        remove_script_host : false,
        convert_urls : true,
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {title: file.name});
                };
            };
            input.click();
        }
    });
</script>
