<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/boxicons-2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="/bootstrap-5/css/bootstrap.css">
    <script src="/bootstrap-5/js/bootstrap.js"></script>
    {{-- <title>Document</title> --}}
    <title>RMA | Purchasing System </title>
    <link rel="icon" href="/img/nm_title.png" type="image/x-icon" />
</head>

<body>
    <style>
        .form_main {

            width: 280px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: rgb(255, 255, 255);
            padding: 30px 30px 30px 30px;
            border-radius: 30px;
            box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.062);
        }

        .heading {
            font-size: 1em;
            color: #444444;
            font-weight: 600;
            margin: 30px 0 5px 0;
        }

        .inputContainer {
            width: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .inputIcon {
            position: absolute;
            left: 10px;
        }

        .inputField {
            width: 100%;
            height: 40px;
            background-color: transparent;
            border: none;
            border-bottom: 2px solid rgb(173, 173, 173);
            border-radius: 30px;
            margin: 10px 0;
            color: black;
            font-size: .8em;
            font-weight: 500;
            box-sizing: border-box;
            padding-left: 30px;
        }

        .inputField:focus {
            outline: none;
            border-bottom: 2px solid rgb(199, 114, 255);
        }

        .inputField::placeholder {
            color: rgb(80, 80, 80);
            font-size: 1em;
            font-weight: 500;
        }

        #button {
            position: relative;
            width: 100%;
            border: 2px solid #066958;
            background-color: #066958;
            height: 40px;
            color: white;
            font-size: .8em;
            font-weight: 500;
            letter-spacing: 1px;
            border-radius: 30px;
            margin: 10px;
            cursor: pointer;
            overflow: hidden;
        }

        #button::after {
            content: "";
            position: absolute;
            background-color: rgba(255, 255, 255, 0.253);
            height: 100%;
            width: 150px;
            top: 0;
            left: -200px;
            border-bottom-right-radius: 100px;
            border-top-left-radius: 100px;
            filter: blur(10px);
            transition-duration: .5s;
        }

        #button:hover::after {
            transform: translateX(600px);
            transition-duration: .5s;
        }

        .signupContainer {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .signupContainer p {
            font-size: .9em;
            font-weight: 500;
            color: black;
        }

        .signupContainer a {
            font-size: .7em;
            font-weight: 500;
            background-color: #2e2e2e;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 20px;
        }

        .logo {
            width: 100%;
        }
    </style>
    <div class="container d-flex justify-content-center align-items-center">
        <form class="form_main mt-5 shadow-lg" method="POST" action="/login">
            @csrf
            <img src="/img/rma.jpg" height="200" width="150" class="logo" alt="">
            <p class="heading">Login</p>
            <div class="inputContainer d-flex align-items-center">
                {{-- <svg viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg"
                    class="inputIcon"> --}}
                {{-- <path
                        d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z">
                    </path> --}}
                <i class="bx bx-user bx-xs mt-2"></i>
                {{-- </svg> --}}

                <input placeholder="email" id="email" name="email" class="inputField ms-2" type="email">
                {{-- <input placeholder="email" id="email" name="email" class="inputField" type="email"> --}}
            </div>

            <div class="inputContainer">
                <i class="bx bx-lock-alt bx-xs mt-2"></i>
                <input placeholder="Password" id="password" name="password" class="inputField ms-2" type="password">
            </div>
            <div class="row w-100 d-flex justify-content-start" style="font-size: .7em;">
                <div class="col-auto ms-4 d-flex align-items-center ">
                    <input type="checkbox" onclick="myFunction()" style="margin-right:0.5em;"> Show Password
                </div>
            </div>
            <button id="button" type="submit">Submit</button>
            <div class="signupContainer">
            </div>
            @if ($errors->has('nrp'))
                <div class="alert alert-danger">
                    {{ $errors->first('nrp') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>
    <div class="container mt-3">
        {{-- @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>
