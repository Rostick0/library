<?

function get_head($title = 'Библиотека')
{
    return '
    <!DOCTYPE html>
    <html lang="ru">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/img/icon/favicon.png">
        <link rel="stylesheet" href="/css/index.css">
        <title>' . $title . '</title>
    </head>
    ';
}
