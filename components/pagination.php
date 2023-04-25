<?

function get_pagination(int $this_page, int $count_pages, $query_param = 'page')
{
    if ($count_pages < 2) return '';

    if ($this_page === 0) $this_page = 1;

    $first_pagination = '';

    if ($this_page > 5) {
        $first_pagination = '<li class="pagination_item">
            <a class="a" href="' . add_query_param($query_param, 1) . '">1</a>
        </li>';
    }

    $end_pagination = '';

    if ($count_pages >= $this_page + 5) {
        $end_pagination = '<li class="pagination_item">
            <a class="a" href="' . add_query_param($query_param, $count_pages) . '">' . $count_pages . '</a>
      </li>';
    }

    function is_active($this_page, $i)
    {
        return $this_page == $i ? "_active" : "";
    }

    $left_middle_count = 5;
    $left_middle_pagination = '';

    $middle_pagination = '';

    for ($i = $this_page; $i <= $count_pages; $i++) {
        $left_middle_count -= 1;

        $middle_pagination .= '<li class="pagination_item ' . is_active($this_page, $i) . '">
            <a class="a" href="' . add_query_param($query_param, $i) . '">' . $i . '</a>
        </li>';

        if ($i === $this_page + 4) break;
    }

    for ($i = $this_page - $left_middle_count; $i < $this_page; $i++) {
        $left_middle_pagination .= '<li class="pagination_item ' . is_active($this_page, $i) . '">
            <a class="a" href="' . add_query_param($query_param, $i) . '">' . $i . '</a>
        </li>';
    }

    return '<div class="pagination">
        <ul class="block-style pagination_list">
            ' . $first_pagination . '
            ' . $left_middle_pagination . '
            ' . $middle_pagination . '
            ' . $end_pagination . '
        </ul>
    </div>';
}
