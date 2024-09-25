<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<div class="container my-1 d-flex justify-content-center">
    <div class="col-sm-5 my-1">
        <div class="card">
            <div class="card-header my-1">Kullanıcı</div>
            <div class="card-body my-1">

                <form action="{{ route('control') }}" method="post" id="form">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
                        <div></div>
                    </div>
                    <div class="form-group my-1">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                        <div></div>
                    </div>
                    <div class="form-group my-1">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                        <div></div>
                    </div>
                    <div class="form-group my-1">
                        <label for="repassword">Re-Password</label>
                        <input type="password" name="repassword" class="form-control" id="repassword" placeholder="Enter Password again">
                        <div></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block my-1 d-flex justify-content-center">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const form = document.getElementById("form");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const repassword = document.getElementById("repassword");

    function error(input, message) {
        input.className = "form-control is-invalid";
        const div = input.nextElementSibling;
        div.innerText = message;
        div.className = "invalid-feedback";
    }

    function success(input) {
        input.className = "form-control is-valid";
    }

    form.addEventListener("submit", function (e) {
        let isValid = true;

        if (username.value === '') {
            error(username, "Username is required");
            isValid = false;
        } else {
            success(username);
        }

        if (email.value === '') {
            error(email, "Email is required");
            isValid = false;
        } else {
            success(email);
        }

        if (password.value === '') {
            error(password, "Password is required");
            isValid = false;
        } else {
            success(password);
        }

        if (repassword.value === '') {
            error(repassword, "Please re-enter the password");
            isValid = false;
        } else if (repassword.value !== password.value) {
            error(repassword, "Passwords do not match");
            isValid = false;
        } else {
            success(repassword);
        }

        if (!isValid) {
            e.preventDefault(); // Formun sunucuya gönderilmesini engeller
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
