<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İlestisim Sayfası</title>
</head>
<body>
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $hatalar)
<li>
    {{$hatalar}}
</li>
        @endforeach
    </ul>
    @endif
       <form action="{{route('üyekayıt')}}" method="post">
    @csrf
    <label >Ad Soyad</label><br/>
    <input type="text" name="adsoyad"><br/>
    <label >Telefon</label><br/>
    <input type="text" name="telefon"><br/>
    <label >Email</label><br/>
    <input type="text" name="mail"><br/>
    <input type="submit" name="ilet" value="Gönder"><br/>
       </form>
</body>
</html>
