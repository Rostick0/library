<?

function set_error($message)
{
    return [
        'type' => false,
        'message' => $message
    ];
}

function validate_date($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function str_view_count(string $count_view)
{
    $last_num = substr($count_view, -1, 1);
    $text = '';

    switch ($last_num) {
        case '1':
            $text = 'просмотр';
            break;
        case '2':
        case '3':
        case '4':
            $text = 'просмотра';
            break;
        default:
            $text = 'просмотров';
            break;
    }

    return $count_view . ' ' . $text;
}

function html_raiting(float $raiting, $text = '', $class = '', $tag = 'span')
{
    $raiting_class = '';

    if ($raiting > 4.5) {
        $raiting_class = '_green-text';
    } else if ($raiting > 3.5) {
        $raiting_class = '_yellow-text';
    } else if ($raiting > 2.5) {
        $raiting_class = '_orange-text';
    } else {
        $raiting_class = '_red-text';
    }

    return "<$tag class=" . '"' . $class . ' ' . $raiting_class . '"' . ">$raiting$text</$tag>";
}

function count_page($count, $limit)
{
    // 100 20
    return ceil($count / $limit);
}
