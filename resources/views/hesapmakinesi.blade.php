<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Hesap Makinesi</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        font-size: 10px;
    }

    body {
        font-size: 1.2rem;
    }

    .calculator {
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 400px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .calculator-input {
        width: 100%;
        font-size: 4rem;
        height: 70px;
        border: none;
        background-color: #252525;
        color: #fff;
        text-align: right;
        padding-left: 20px;
        padding-right: 20px;
    }

    button {
        height: 50px;
        background-color: #fff;
        border-radius: 3px;
        border: 1px solid #c4c4c4;
        background-color: transparent;
        font-size: 2.5rem;
        color: #333;
    }

    button:hover {
        background-color: #eaeaea;
    }

    .operator {
        color: #337cac;
    }

    .clear {
        background-color: #f0595f;
        border-color: #b0353a;
        color: #fff;
    }

    .clear:hover {
        background-color: #f17377;
    }

    .equal-sign {
        background-color: #2e86c0;
        border-color: #337cac;
        color: #fff;
        height: 100%;
        grid-area: 2/4/6/5;
    }

    .equal-sign:hover {
        background-color: #4e9ed4;
    }

    .calculator-keys {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 20px;
        padding: 20px;
    }
</style>
<body>
    <div class="calculator">
        <input type="text" class="calculator-input" value="0" disabled>

        <div class="calculator-keys">
            <button type="button" class="operator" value="+">+</button>
            <button type="button" class="operator" value="-">-</button>
            <button type="button" class="operator" value="*">&times;</button>
            <button type="button" class="operator" value="/">&divide;</button>

            <button type="button" value="7">7</button>
            <button type="button" value="8">8</button>
            <button type="button" value="9">9</button>

            <button type="button" value="4">4</button>
            <button type="button" value="5">5</button>
            <button type="button" value="6">6</button>

            <button type="button" value="1">1</button>
            <button type="button" value="2">2</button>
            <button type="button" value="3">3</button>

            <button type="button" value="0">0</button>
            <button type="button" class="decimal" value=".">.</button>
            <button type="button" class="clear" value="clear">AC</button>

            <button type="button" class="equal-sign operator" value="=">=</button>
        </div>
    </div>

    <script>
        const display = document.querySelector('.calculator-input');
        const keys = document.querySelector('.calculator-keys');

        let displayValue = '0';
        let firstValue = null;
        let operator = null;
        let waitingForSecondValue = false;

        function updateDisplay() {
            display.value = displayValue;
        }

        keys.addEventListener('click', function(e) {
            const element = e.target;

            if (!element.matches('button')) return;

            if (element.classList.contains('operator')) {
                handleOperator(element.value);
                updateDisplay();
                return;
            }

            if (element.classList.contains('decimal')) {
                inputDecimal(element.value);
                updateDisplay();
                return;
            }

            if (element.classList.contains('clear')) {
                clear();
                updateDisplay();
                return;
            }

            inputNumber(element.value);
            updateDisplay();
        });

        function handleOperator(nextOperator) {
            const value = parseFloat(displayValue);

            if (operator && waitingForSecondValue) {
                operator = nextOperator;
                return;
            }

            if (firstValue === null) {
                firstValue = value;
            } else if (operator) {
                const result = performCalculation(firstValue, value, operator);
                displayValue = `${parseFloat(result.toFixed(5))}`;
                firstValue = result;
            }

            waitingForSecondValue = true;
            operator = nextOperator;
        }

        function performCalculation(first, second, operator) {
            switch (operator) {
                case '+':
                    return first + second;
                case '-':
                    return first - second;
                case '*':
                    return first * second;
                case '/':
                    return first / second;
                default:
                    return second;
            }
        }

        function inputNumber(num) {
            if (waitingForSecondValue) {
                displayValue = num;
                waitingForSecondValue = false;
            } else {
                displayValue = displayValue === '0' ? num : displayValue + num;
            }
        }

        function inputDecimal(dot) {
            if (waitingForSecondValue) {
                displayValue = '0.';
                waitingForSecondValue = false;
                return;
            }

            if (!displayValue.includes(dot)) {
                displayValue += dot;
            }
        }

        function clear() {
            displayValue = '0';
            firstValue = null;
            operator = null;
            waitingForSecondValue = false;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
