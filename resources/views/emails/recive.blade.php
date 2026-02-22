<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DC Phone Repair</title>
</head>
<body>
    <address>
        <p>
           <b>Client Name : </b> {{$mailData['name']}} <br>
            <b>Client Phone: </b>{{$mailData['phone']}} <br>
            <b>Subject: </b>{{$mailData['service_name']}} <br>
            <b>Message</b>{{$mailData['short_notes']}} <br/>
            
        </p>
    </address>
</body>
</html>
