</main>
<footer class="bg-light">
    <div class="text-center p-3" style="background:#eee">
        EasyTaskEasyLife
    </div>

</footer>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function(files) {
                    sendFile(files[0], $(this));
                }
            },
            height: 200,
            toolbar: [
                ["style", ["bold", "italic", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["fontsize", ["fontsize"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["height", ["height"]],
                ["insert", ["link", "picture", "imageList", "video", "hr"]],
                ["help", ["help"]]
            ],
            dialogsInBody: true,
            imageList: {
                endpoint: "daftar_gambar.php",
                fullUrlPrefix: "../admin/gambar/",
                thumbUrlPrefix: "../admin/gambar/"
            }
        });

        function sendFile(file, editor) {
            data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                type: "POST",
                url: 'upload_gambar.php',
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    console.log(url);
                    editor.summernote('insertImage', url, "Name img");
                }
            });
        }

    });
</script>

</body>

</html>