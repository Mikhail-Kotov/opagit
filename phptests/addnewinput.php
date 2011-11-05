<html>
    <head>
        <title></title>
        <script language="javascript">
            fields = 0;
            function addInput() {
                if (fields != 10) {
                    document.getElementById('text').innerHTML += "<input type='file' value='' /><br />";
                    fields += 1;
                } else {
                    document.getElementById('text').innerHTML += "<br />Only 10 upload fields allowed.";
                    document.form.add.disabled=true;
                }
            }
        </script>
    </head>
    <body>
        <form name="form" action ="">
            <input type="button" onclick="addInput()" name="add" value="Add input field" />
        </form>
        <div id="text">

        </div>
    </body>
</html>