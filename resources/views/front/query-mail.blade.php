<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Query Mail</title>
</head>
<body>
    <div class="container">
        <h4 class="text-center">
            {{$subject}}
        </h4>
        <div class="row">
            <div class="col-md-4">
                <p>Name: {{$name}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>Email: {{$email}}</p>
            </div>
        </div>
        <div class="row" style="display: flex;">
            <div class="col-md-4">
                <div>Message: </div>
            </div>
            <div class="col-md-8">
                <div>{{$query}}</div>
            </div>
        </div>
    </div>
</body>
</html>