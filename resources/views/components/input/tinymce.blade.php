<script src="https://cdn.tiny.cloud/1/jpyjrs5mhzkdhlcu8zonluhpk7vlla0p39zwinxnybmjw6av/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-init="
        tinymce.init({
        target: $refs.tinymce,
        themes: 'modern',
        height: 600,
        menubar: false,
        image_class_list: [
            {title: 'img-responsive', value: 'img-responsive'},
        ],
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            })
            editor.on('blur', function(e) {
                value = editor.getContent()
            })
            editor.on('init', function (e) {
                if (value != null) {
                    editor.setContent(value)
                }
            })
            function putCursorToEnd() {
                editor.selection.select(editor.getBody(), true);
                editor.selection.collapse(false);
            }
            $watch('value', function (newValue) {
                if (newValue !== editor.getContent()) {
                    editor.resetContent(newValue || '');
                    putCursorToEnd();
                }
            });
        },
        plugins: 'code table lists image',
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
    })
    "
    wire:ignore
>
    <div>
        <input
            x-ref="tinymce"
            type="textarea"
            {{ $attributes->whereDoesntStartWith('wire:model') }}
        >
    </div>
</div>
