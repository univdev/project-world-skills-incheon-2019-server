<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{title}</title>
</head>
<body>
    <?php echo validation_errors(); ?>
    <?php echo form_open(); ?>
        <input type="text" name="account">
        <input type="password" name="password">
        <button type="submit">전송</button>
    <?php echo form_close(); ?>
</body>
</html>