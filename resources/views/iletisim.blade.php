<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlestisim Sayfası</title>
</head>
<body>
       <form action="{{route('iletisim-sonuc')}}" method="post">
    @csrf
    <label >Ad Soyad</label><br/>
    <input type="text" name="adsoyad"><br/>
    <label >Telefon</label><br/>
    <input type="text" name="telefon"><br/>
    <label >Email</label><br/>
    <input type="text" name="mail"><br/>
    <label >Mesaj</label><br/>
    <textarea style="height: 200px; width:200px" name="metin"></textarea><br />
    <input type="submit" name="ilet" value="Gönder"><br/>
       </form>
</body>
</html>
