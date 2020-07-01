<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            padding:100px;
            background-color: rgba(235, 195, 158, 0.26);
        }
        .salary{
            text-align: center;
            text-transform: uppercase;
        }
        .name{
            font-size: 30px;
        }
        .position{
            font-size: 30px;
        }
        @media screen and (max-width: 900px) {
            body {
                padding-left: 10px;
            }
        }
    </style>
</head>
<body>
    <div>
        <div class="salary"><h1>salary report</h1></div>
        <table>
            <tr>
                <td>
                    @if ($user->avatar == null)
                     <img src="dist/img/user2-160x160.jpg">
                    @else
                    <img src="dist/img/{{$user->avatar}}" alt="">
                    @endif

                </td>
                <td>
                    <div class="name"><strong>Name: </strong>{{ $user->name }}</div>
                    <div class="position"><strong>Position: </strong>{{ $user->position }}</div>
                    <div class="position"><strong>Birth day: </strong>{{ $user->birthday }}</div>
                    <div class="position"><strong>Email: </strong>{{ $user->email }}</div>
                    <div class="position"><strong>Address: </strong>{{ $user->address }}</div>
                    <div class="position"><strong>ID Card: </strong>{{ $user->identity_card }}</div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    @if ($dayWork > 1)
                        <div class="position"><strong>Work: </strong>{{ $dayWork }} Days</div>
                    @else
                        <div class="position"><strong>Work: </strong>{{ $dayWork }} Day</div>
                    @endif

                    @if ($dayof > 1)
                        <div class="position"><strong>Absence: </strong>{{ $dayof }} Days</div>
                    @else
                        <div class="position"><strong>Absence: </strong>{{ $dayof }} Day</div>
                    @endif
                    @if(round($time,0) >= 1)
                    <div class="position"><strong>Over time: </strong>{{ round($time,0) }} hour</div>
                    @else
                    <div class="position"><strong>Over time: </strong>{{ round($time,0) }} hours</div>
                    @endif

                    <div class="position"><strong>Salary: </strong>{{ number_format($user->salary) }}VND</div>
                    <div class="position"><strong>Still have </strong>{{ $user->total_holidays }} days off in this year</div>
                    <div class="position"><strong>Thank you </strong>for work at our company</div>
                </td>
                <td></td>
            </tr>

        </table>
    </div>
</body>
</html>
