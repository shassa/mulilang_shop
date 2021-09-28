{{-- @props(['userimage'=>null,'username'=>null,'useremail'=>null]) --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$username}}</title>
    <style>
        html{
            background-color: rgb(104, 102, 214);
            text-align: center;
        }

        img{
            width: 300px;
            border-radius: 45%;
            margin-top: 100px;
            margin-bottom: 100px;
        }
        label{
            height: 80px;
            background-color: wheat;
            color: purple;
            font-size: 25px;
            padding: 10px;
            margin: 10px;

        }
    </style>
</head>
<body>
    <div>
        <img src="{{$userimage}}" alt="profile Image">
        <br>
        <label for="name">{{$username}}</label>
        <label for="email">{{$useremail}}</label>
    </div>
</body>
</html>
