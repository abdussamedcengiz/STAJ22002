<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
       <form action="{{route('sonuc')}}" method="post">
    @csrf
    <textarea style="height: 200px; width:200px" name="metin"></textarea><br />
    <input type="submit" name="ilet" value="Gönder">
       </form>
</body>
</html>
