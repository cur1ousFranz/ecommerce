{{-- {!! $body !!} --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add To Cart</title>
    <style>
        .container {
            width: 600px;
            margin: 0 auto;
            border: 1px solid;
            padding: 30px;
            text-align: center;
        }

        h1, h3 {
            color: black;
        }

        body {
            background-color: rgb(215, 221, 221)
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 style="font-weight: 25px; color">WELCOME TO ATC!</h1>
        <h2 style="font-weight: bold; color">Your verification code is:</h2>
        <h1 style="font-weight: bold; color: rgb(252, 227, 6); letter-spacing: 5px; font-size: 40px">{!! $code !!}</h1>
    </div>

</body>
</html>
