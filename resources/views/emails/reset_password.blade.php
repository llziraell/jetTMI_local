<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сброс пароля</title>
</head>
<body>
    <p>Вы получили это письмо, потому что был отправлен запрос на сброс пароля для вашего аккаунта.</p>
    <p>Перейдите по следующей ссылке для сброса пароля:</p>
    <a href="{{ $url }}">{{ $url }}</a>
    <p>Если вы не делали запрос на сброс пароля, просто проигнорируйте это письмо.</p>
</body>
</html>
