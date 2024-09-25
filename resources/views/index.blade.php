<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Adam Asmaca</title>
</head>
<style>
    * {
    box-sizing: border-box;
}

body {
    background-color: #3a444e;
    color: #fff;
    height: 80vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow: hidden;
}

.container {
    padding: 20px 20px;
    height: 450px;
    width: 450px;
    position: relative;
}

.grafik {
    fill: transparent;
    stroke: #fff;
    stroke-width: 4px;
}

.item{
    display: none;
}

#wrong-letters {
    position: absolute;
    top: 30px;
    right: 30px;
}
#popup-container{
    background-color: rgba(0, 0, 0, 0.3);
    position: fixed;
    top: 100px;
    bottom: 0;
    left:0 ;
    right: 0;
    display: none;
    justify-content: center;
    align-items: center;
}
.popup{
background-color: green;
padding: 20px;
text-align: center;
justify-content: center;
border-radius: 5px;
box-shadow: 0 15px 10px 3px rgba(0, 0, 0, 0.1);
}
#word {
    display: flex;
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translate(-50%);
}

.letter {
    border-bottom: 3px solid yellow;
    font-size: 30px;
    margin: 0 3px;
    height: 40px;
    width: 25px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
}
#message {
    background-color: rgba(0, 0, 0, 0.3);
    font-size: 20px;
    border-radius: 5px;
    padding: 10px 80px;
    position: fixed;  
    bottom: 20px;     
    left: 50%;       
    transform: translateX(-50%); 
    transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out; 
    opacity: 0;       
    z-index: 1000;    
}

#message.show {
    opacity: 1;       
    transform: translateX(-50%) translateY(-20px); 
}

</style>
<body>
    <h1>Adam Asmaca</h1>
    <p>Gizlenmiş kelimeyi bulmak için bir harf giriniz.</p>

    <div class="container">
        <svg height="250" width="250" class="grafik">
            <!-- sehpa -->
            <line x1="50" y1="20" x2="130" y2="20"/>
            <line x1="130" y1="20" x2="130" y2="50"/>
            <line x1="50" y1="20" x2="50" y2="250"/>
            <line x1="10" y1="250" x2="90" y2="250"/>

            <!-- kafa -->
            <circle cx="130" cy="70" r="20" class="item"/>

            <!-- gövde -->
            <line x1="130" y1="90" x2="130" y2="170" class="item"/>

            <!-- kollar -->
            <line x1="130" y1="120" x2="100" y2="100"  class="item"/>
            <line x1="130" y1="120" x2="160" y2="100" class="item"/>

            <!-- bacaklar -->
            <line x1="130" y1="170" x2="100" y2="190" class="item"/>
            <line x1="130" y1="170" x2="160" y2="190" class="item"/>
        </svg>

        <div id="wrong-letters">

        </div>

        <div id="word">

        </div>
    </div>


    <div id="popup-container">
        <div class="popup">
            <h2 id="success-message">
            </h2>
            <button id="play-again">Tekrar oyna</button>
        </div>
    </div>
    <div id="message" class="">
<p>Bu harfi zaten girdiniz</p>
    </div>
    <script>
const correctLetters = [];
const wrongLetters = [];
let select = rand();
const cl = document.querySelector('#word');
const cons = document.querySelector('#popup-container');
const mes = document.querySelector('#success-message');
const wrong = document.querySelector('#wrong-letters');
const items = document.querySelectorAll('.item');
const mess = document.querySelector('#message');
const play = document.querySelector('#play-again');

function rand() {
    const words = ["java", "css", "python"];
    return words[Math.floor(Math.random() * words.length)];
}

function display() {
    cl.innerHTML = `
    ${select.split('').map(letter => `
    <div class="letter">
    ${correctLetters.includes(letter) ? letter : ''}
    </div>
    `).join('')}
    `;

    const w = cl.innerText.replace(/\n/g, '');
    if (w === select) {
        cons.style.display = 'flex';
        mes.innerText = 'Kazandınız';
    }
}

function update() {
    wrong.innerHTML = `
    ${wrongLetters.length > 0 ? '<h3>Hatalı Harfler</h3>' : ''}
    ${wrongLetters.map(letter => `<span>${letter}</span>`).join('')}
    `;

    items.forEach((item, index) => {
        if (index < wrongLetters.length) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });

    if (wrongLetters.length === items.length) {
        cons.style.display = 'flex';
        mes.innerText = 'Maalesef Kazanamadınız';
    }
}

function displayMessage() {
    mess.classList.add('show');
    setTimeout(() => {
        mess.classList.remove('show');
    }, 2000);
}

play.addEventListener('click', function() {
    correctLetters.splice(0);
    wrongLetters.splice(0);
    select = rand();
    update();
    display();
    cons.style.display = 'none';
});

window.addEventListener('keydown', function(e) {
    if (e.keyCode >= 65 && e.keyCode <= 90) {
        const letter = e.key.toLowerCase();

        if (select.includes(letter)) {
            if (!correctLetters.includes(letter)) {
                correctLetters.push(letter);
                display();
            } else {
                displayMessage();
            }
        } else {
            if (!wrongLetters.includes(letter)) {
                wrongLetters.push(letter);
                update();
            } else {
                displayMessage();
            }
        }
    }
});

display();



    </script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
