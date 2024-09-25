<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ornek;
use App\Http\Controllers\Yonet;
use App\Http\Controllers\Formislemleri;
use App\Http\Controllers\Veritabaniislemleri;
use App\Http\Controllers\Modelislemleri;
use App\Http\Controllers\Iletisim;
use App\Http\Controllers\ResimYukle;
use App\Http\Controllers\Uyelikislemleri;
use App\Http\Controllers\Site;
use App\Http\Controllers\Index;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/deneme/{isim}",[Ornek::class,"test"]);
Route::get("/web",function(){
    return view("sayfalar.home");
});
Route::get("/web/galeri",function(){
    return view("sayfalar.galeri");
})->name('galeri');
Route::get("/web/hizmetler",function(){
    return view("sayfalar.hizmetler");
})->name('hizmetler');
Route::get("/web/iletisim",function(){
    return view("sayfalar.iletisim");
})->name('iletisim');
Route::get("/web/hakkımızda",function(){
    return view("sayfalar.kurumsal");
})->name('hakkımızda');
Route::get("/form",[Formislemleri::class,"gorunum"]);
Route::middleware('arakontrol')->post("/form-sonuc",[Formislemleri::class,"sonuc"])->name("sonuc");
Route::get("/ekle",[Veritabaniislemleri::class,"ekle"]);
Route::get("/guncelle",[Veritabaniislemleri::class,"guncelle"]);
Route::get("/sil",[Veritabaniislemleri::class,"sil"]);
Route::get("/listele",[Veritabaniislemleri::class,"bilgiler"]);
Route::get("/modellistesi",[Modelislemleri::class,"liste"]);
Route::get("/modelekle",[Modelislemleri::class,"ekle"]);
Route::get("/modelguncelle",[Modelislemleri::class,"guncelle"]);
Route::get("/modelsil",[Modelislemleri::class,"sil"]);
Route::get("/iletisim",[Iletisim::class,"index"]);
Route::post("/iletisim-sonuc",[Iletisim::class,"ekleme"])->name("iletisim-sonuc");
Route::get("upload",function(){
    return view('dosya');
});
Route::post('/resim-ilet',[ResimYukle::class,"ResimYukleme"])->name("yükle");
Route::get("üye",function(){
    return view('üyelik');
});
Route::post('üye-kayıt',[Uyelikislemleri::class,"uyekayit"])->name("üyekayıt");
Route::get("/site",[Site::class,"sitee"]);
Route::get("/kayit",function(){
    return view("login");
});
Route::post('login-kayıt',[Index::class,"control"])->name("control");
Route::get('/cinema', function () {
    return view('cinema');
});
Route::get('/seats', [SeatController::class, 'index']);
 // Koltukları getirmek için
Route::post('/seats', [SeatController::class, 'update']); // Koltuk durumunu güncellemek için

Route::post('/api/reservations', [ReservationController::class, 'store']);
Route::get('/calculator', function () {
    return view('hesapmakinesi');
});
Route::get('/oyun', function () {
    return view('index');
});









