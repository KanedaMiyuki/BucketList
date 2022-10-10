<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $inputs['about'] }}について</title>
</head>
<body>
    <p>{{ $inputs['name'] }}様</p>
	<p>件名：{{$inputs['about']}}について</p>
    ーーーー
    <p>{{$inputs['details']}}</p>
    ーーーー
    <p>このメールに返信されましても、お答えする事はできませんので、<br>Contact usよりご連絡ください。</p>
    <p><a href="https://bucket-list-test.com/"><strong>Bucket List</strong></a></p>
</body>
</html>
