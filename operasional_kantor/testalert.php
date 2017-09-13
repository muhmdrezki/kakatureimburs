<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My page</title>

    <!-- CSS dependencies -->
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

    <p>Content here. <a class="alert" href=#>Alert!</a></p>

    <!-- JS dependencies -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- bootbox code -->
    <script src="bootbox.min.js"></script>
    <script>
      bootbox.confirm({
            message: "This is a confirm with custom button text and color! Do you like it?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
    callback: function (result) {
        console.log('This was logged in the callback: ' + result);
    }
});
    </script>
</body>
</html>