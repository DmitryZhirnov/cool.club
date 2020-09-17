<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <form method="POST" action="/send">
        @csrf
        <label for="message_content">Введите сообщение</label>
        <textarea name="message_content" cols="30" rows="10"></textarea>
        @error('message_content')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit">Отправить</button>
    </form>
</body>

</html>