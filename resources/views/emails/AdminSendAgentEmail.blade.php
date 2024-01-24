<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{get_phrase('Sending')}} | {{get_phrase('Email')}} </title>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet"> 
</head>
<body style="margin:0; padding:0; font-family: 'Cabin', sans-serif;">
    <div class="email-container"style="background-color: #fff;" >
        <table class="table-content" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 45px 30px 34px 30px ;  margin: auto; width: 600px;">
            <tbody>
                <tr>
                    <td>
                        <p style="font-size: 15px; color: #7B7F84; line-height: 28px;">{{$data['message']}}</p>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</body>
</html>    