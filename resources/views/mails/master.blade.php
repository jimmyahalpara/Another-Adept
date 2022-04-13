<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">

<body class="d-flex justify-content-center align-items-center text-light">
    <div id="main-container" class="w-50">
        <div id="second-container" class="d-flex  align-items-center flex-column" >
            <div id="logo-container" class="d-flex justify-content-center align-items-center">
                <img id="logo" src="{{ asset('assets/images/logo.svg') }}" alt="">
            </div>
            <h1 class="pt-2">@yield('heading')</h1>
            <div id="container">
                @yield('content')
            </div>
            <small>Need Help? <a href="">Mail Us.</a></small>
        </div>
    </div>

    <style>
        body {
            font-family: "Karla", sans-serif;
        }
        #main-container {
            background: url('{{ asset('assets/images/mailback.jpg') }}');
            background-size: 100% auto;
            background-position: center ;
            background-repeat: no-repeat;
            border-radius: 2vh;
            height: fit-content;
            overflow: hidden;
            
        }

        #second-container {
            background-color: rgba(0, 0, 0, 0.546);
            width: 100%;
            height: 100%;
            padding: 5vh 2vw;
        }

        #logo-container {
            height: 20vh;
            width: 60%;
            /* padding: 1vh 1vw; */
            background: rgba(255, 255, 255, 0.375);
            /* box-shadow: 0px 0px 8px 8px rgba(0, 0, 0, 0.485) inset; */
            /* box-shadow: 0px 0px 8px 8px rgba(255, 255, 255, 0.519); */
            border: 1px solid white;
            border-radius: 5vh;
            
        }

        #logo {
            height: 150%;
            width: 100%;
        }

        #container {
            text-align: justify;
            width: 70%;
            margin: 10vh auto 10vh auto;
        }
        
        a {
            color: rgb(122, 122, 255)
        }
    </style>
</body>
