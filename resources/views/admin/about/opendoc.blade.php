
<!DOCTYPE html>
<html>
<head>
    <title>Open Word File</title>
    <script type="text/javascript">
        // Function to open the Word document in a new window
        function openDoc() {
            window.open('{{ url('/view-doc') }}', '_blank', 'width=800,height=600');
        }

        // Automatically open the document on page load
        window.onload = function() {
            openDoc();
        };
    </script>
</head>
<body>

    <h1>Word Document Viewer</h1>

    <button onclick="openDoc()">Open Document</button>

</body>
</html>