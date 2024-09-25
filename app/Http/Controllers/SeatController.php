<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        // Burada örnek veri döndürülüyor. Gerçek veritabanı verileriyle değiştirin.
        $seats = [
            ['row' => 0, 'seat' => 0, 'reserved' => false],
            ['row' => 0, 'seat' => 1, 'reserved' => true],
            // Diğer koltuklar...
        ];

        return response()->json($seats);
    }
}
