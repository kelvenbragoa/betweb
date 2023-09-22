
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="SISTEMA PRODUZIDO PARA CODELABS">
	<meta name="author" content="CODELABS">
	<meta name="keywords" content="SISTEMA PRODUZIDO PARA CODELABS">

	<link rel="shortcut icon" href="/files/img/sys/logocdm.png" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

	<title>CODELAB</title>

	<link href="{{asset('template/css/app.css')}}" rel="stylesheet">
</head>

<body style="background-image: url('/files/img/sys/background.jpg'); height: 100%; 
background-position: center;
background-repeat: no-repeat;
background-size: cover;">
	 <div id="app">
        <router-view>
            <Login/>
        </router-view>
    </div>

	<script src="{{asset('template/js/app.js')}}"></script>

</body>

</html>


