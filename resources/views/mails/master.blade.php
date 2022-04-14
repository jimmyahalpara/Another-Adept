<!-- CSS only -->
<html>

    <head>
    <style>
        body {
            font-family: "Karla", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        #main-container {
            background: url('{{ asset('assets/images/mailback.jpg') }}');
            background-size: 100% auto;
            background-position: center ;
            background-repeat: no-repeat;
            border-radius: 2vh;
            height: fit-content;
            overflow: hidden;
            display: flex !important;
            justify-content: center;
            align-items:center;
            width: 50%
            
        }
        
        #second-container {
            background-color: rgba(0, 0, 0, 0.546);
            width: 100%;
            height: 100%;
            padding: 5vh 2vw;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #logo-container {
            height: 20vh;
            width: 60%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center
            
        }

        #logo {
            height: 170%;
            width: 130%;
        }

        #container {
            text-align: justify;
            width: 70%;
            margin: 10vh auto 10vh auto;
        }
        
        a {
            color: rgb(122, 122, 255)
        }

        #heading {
            padding-top: 5vh;
            width: 75%;
        }
    </style>
</head>

<body class="" id="body">
    <div id="main-container" class="">
        <div id="second-container" class="" >
            <div id="logo-container" class="">
                <img id="logo" src="https://www.serviceadept.me/assets/images/logo.svg" alt="">
            </div>
            <h1 id="heading" class="pt-2 w-75 test-justify">@yield('heading')</h1>
            <div id="container">
                @yield('content')
            </div>
            <small>Need Help? <a href="">Mail Us.</a></small>
        </div>
    </div>
    
    
</body>

</html>