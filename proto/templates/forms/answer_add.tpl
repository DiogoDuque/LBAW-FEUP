<div class="new-answer">
    <h3>Your answer</h3>


    <form action="../../actions/post/answer_add.php" method="post">

        <input type="hidden" name="post_id" value="{$question_id}">


        <textarea id="summernote" class="formgroup" name="edited_text">
            </textarea>


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

    <script>
        function sendAnswerText(){
            document.forms["sampleForm"].submit();
        }
    </script>

    <button type="submit" onclick="sendAnswerText()" class="btn btn-success">Apply</button>
</div>