<?php

namespace App\Http\Controllers;

use App\Models\Reservation; // Reservation modelini import et
use App\Models\Seat;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'seats' => 'required|array',
            'movie_price' => 'required|numeric'
        ]);

        $totalAmount = count($data['seats']) * $data['movie_price'];

        // Rezervasyon bilgilerini veritabanına kaydedin
        $reservation = Reservation::create([
            'seats' => json_encode($data['seats']),
            'total_amount' => $totalAmount
        ]);

        // Seçilen koltukları güncelleyin
        foreach ($data['seats'] as $seat) {
            Seat::where('row', $seat['row'])
                ->where('seat', $seat['seat'])
                ->update(['reserved' => true]);
        }

        return response()->json(['message' => 'Reservation successful', 'reservation' => $reservation]);
    }
}
