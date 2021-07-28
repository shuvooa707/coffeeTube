<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/filetest" method="post" enctype="multipart/form-data">
        <div class="from-group">
            @csrf
            <input type="file" name="file" id="" class="form-control">
            <input type="submit" value="Upload" class="form-control">
        </div>
    </form>
</body>
</html>
