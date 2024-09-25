<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sinema Bilet Rezervasyonu</title>
</head>
<style>
    .body {
        background-color: #292929;
        flex-direction: column;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        color: #fff;
    }
    .seat {
        background-color: #444451;
        height: 15px;
        width: 15px;
        margin: 3px;
        border-radius: 5px;
    }
    .seat:not(.reserved):hover {
        cursor: pointer;
        transform: scale(1.3);
    }
    .seat.selected {
        background-color: #f6eb6f;
    }
    .seat.reserved {
        background-color: #fff;
    }
    .seat:nth-of-type(2) {
        margin-right: 20px;
    }
    .seat:nth-last-of-type(3) {
        margin-right: 20px;
    }
    .row {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .screen {
        background-color: #fff;
        height: 50px;
        width: 100%;
        margin: 20px 0;
        box-shadow: 0 3px 8px rgba(255, 255, 255, 0.7);
    }
    .movie-list {
        margin: 20px 0;
    }
    .info {
        background-color: rgba(0, 0, 0, 0.2);
        padding: 5px 10px;
        color: #777;
        display: flex;
    }
    .info li {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 10px;
    }
    p.text span {
        color: #f6eb6f;
    }
</style>
<body class="body">
<div class="container">
    <div class="screen" style="width: 100%;"></div>
    <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
    </div>
    <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat reserved"></div>
        <div class="seat reserved"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
    </div>
    <div class="row">
        <div class="seat reserved"></div>
        <div class="seat reserved"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
    </div>
    <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
    </div>
    <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
    </div>
</div>

<div class="movie-list">
    <select id="movie">
        <option disabled>Film Seçiniz</option>
        <option value="20">movie 1</option>
        <option value="30">movie 2</option>
        <option value="40">movie 3</option>
    </select>
</div>
<button id="reserve-button" class="btn btn-primary">Rezervasyonu Tamamla</button>


<ul class="info">
    <li>
        <div class="seat selected"></div>
        <small style="color:black;">Secili</small>
    </li>
    <li>
        <div class="seat"></div>
        <small style="color: black;">Boş</small>
    </li>
    <li>
        <div class="seat reserved"></div>
        <small style="color: black;">Dolu</small>
    </li>
</ul>

<p class="text"> <span id="count">3</span> adet koltuk için hesaplanan ücret <span id="amount">60</span></p>

<script>
document.addEventListener('DOMContentLoaded', () => {
    fetchSeats();
});

function fetchSeats() {
    fetch('/api/seats')
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text); });
            }
            return response.json();
        })
        .then(data => {
            data.forEach(seat => {
                const seatElement = document.querySelector(`.row:nth-child(${seat.row + 1}) .seat:nth-child(${seat.seat + 1})`);
                if (seatElement) {
                    seatElement.classList.toggle('reserved', seat.reserved);
                }
            });
        })
        .catch(error => {
            console.error('Error fetching seats:', error);
            alert('Koltuk bilgileri yüklenirken bir hata oluştu.');
        });
}

function updateSeat(row, seat, reserved) {
    fetch('/api/seats', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ row, seat, reserved })
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text); });
        }
        return response.json();
    })
    .then(data => {
        console.log('Seat updated:', data);
    })
    .catch(error => {
        console.error('Error updating seat:', error);
        alert('Koltuk güncellenirken bir hata oluştu.');
    });
}

function submitReservation() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const selectedSeats = Array.from(document.querySelectorAll('.seat.selected')).map(seat => {
        const rowElement = seat.parentElement;
        const row = rowElement ? Array.from(rowElement.children).indexOf(seat) + 1 : null;

        const seatParent = seat.parentElement ? seat.parentElement.parentElement : null;
        const seatIndex = seatParent ? Array.from(container.children).indexOf(seatParent) + 1 : null;

        return row !== null && seatIndex !== null ? { row, seat: seatIndex } : null;
    }).filter(seat => seat !== null);

    const moviePrice = select ? select.value : null;

    if (!moviePrice || selectedSeats.length === 0) {
        alert('Lütfen koltuk seçin ve film fiyatını belirtin!');
        return;
    }

    fetch('/api/reservations', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // CSRF tokeni
        },
        body: JSON.stringify({
            seats: selectedSeats,
            movie_price: moviePrice
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error:', text);
                throw new Error('Network response was not ok.');
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Reservation completed:', data);
        alert('Rezervasyon başarılı!');
        document.querySelectorAll('.seat.selected').forEach(seat => seat.classList.remove('selected'));
        calculate();
    })
    .catch(error => {
        console.error('Fetch error:', error);
        alert('Rezervasyon sırasında bir hata oluştu!');
    });
}



document.getElementById('reserve-button').addEventListener('click', submitReservation);

const container = document.querySelector('.container');
const select = document.getElementById('movie');
const count = document.getElementById('count');
const amount = document.getElementById('amount');

container.addEventListener('click', function(e) {
    if (e.target.classList.contains('seat') && !e.target.classList.contains('reserved')) {
        e.target.classList.toggle('selected');
        calculate();
    }
});

function calculate() {
    const selectedSeats = document.querySelectorAll('.seat.selected').length;
    const price = select.value;
    count.innerText = selectedSeats;
    amount.innerText = selectedSeats * price;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
