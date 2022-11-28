<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Notebook</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{url('/styles.css?10')}}">
    @yield("head_items")
    <script>
@yield("javascript")
    </script>
</head>
<body>
@yield("main_content")
</body>
</html>