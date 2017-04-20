<div class="new-answer">
    <h3>Your answer</h3>
    <div id="summernote" class="formgroup"></div>
    <script>
        $(document).ready(function () {
            var summernote = $('#summernote');
            summernote.summernote({
                height: '20rem',
                minHeight: '20rem',
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'table']],
                    ['misc', ['undo', 'redo', 'help']]
                ]
            });
        });
    </script>

    <button type="submit" class="btn btn-success">Submit</button>
</div>