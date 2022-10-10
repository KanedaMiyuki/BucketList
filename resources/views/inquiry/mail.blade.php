<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お問い合わせを受け付けました</title>
</head>
<body>
    <p>{{ $inputs['name'] }}様</p>
    <p>お問い合わせ内容は次のとおりです。</p>
    ーーーー
	<p>メールアドレス：{{$inputs['email']}}</p>
	<p>件名：{{$inputs['about']}}</p>
    <p>お問い合わせ内容：{{$inputs['details']}}</p>
    ーーーー
    <p>お問い合わせありがとうございます。<br>返信が必要な際は担当者よりご連絡いたしますので、今しばらくお待ちください。</p>
    <p>このメールに返信されましても、お答えする事はできませんので、<br>Contact usよりご連絡ください。</p>
    <p><a href="https://bucket-list-test.com/"><strong>Bucket List</strong></a></p>
</body>
</html>
