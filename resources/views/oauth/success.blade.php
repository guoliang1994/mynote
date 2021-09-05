<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>oauth github</title>
</head>
<body>
oauth认证成功
<script>
    window.onload = function () {
        window.opener.postMessage("message", "http://{{$frontUrl}}");
        window.close();
    }
</script>
</body>
</html>
