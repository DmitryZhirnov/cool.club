<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/app.css">
    <title></title>
</head>

<body>
    <form method="POST" action="/send" class="message-form">
        @csrf
        <label for="message_content" class="message-form__content-label">Введите сообщение</label>
        <textarea name="message_content" cols="30" rows="10" class="message-form__content"></textarea>
        <button type="submit" class="message-form__submit">Отправить</button>
        @error('message_content')
        <div class="message-form__errors">{{ $message }}</div>
        @enderror
        @if (Session::has('success'))
        <div class="message-form__info">{{ Session::get('success') }}</div>
        @endif
    </form>

</body>

</html>