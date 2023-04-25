<?

function get_pagination(int $this_page, int $count_pages)
{
    if ($count_pages < 2) return;

    if ($this_page === 0) $this_page = 1;

    $first_pagination = '';

    if ($this_page > 5) {
        $first_pagination = '<li class="pagination_item">
            <a class="a" href="' . add_query_param('page', 1) . '">1</a>
        </li>';
    }

    $end_pagination = '';

    if ($count_pages - 5 > $this_page) {
        $end_pagination = '<li class="pagination_item">
            <a class="a" href="' . add_query_param('page', $count_pages) . '">' . $count_pages . '</a>
      </li>';
    }

    function is_active($this_page, $i)
    {
        return $this_page == $i ? "_active" : "";
    }

    $middle_pagination = '';

    for ($i = $this_page; $i <= $count_pages; $i++) {
        $middle_pagination .= '<li class="pagination_item ' . is_active($this_page, $i) . '">
            <a class="a" href="' . add_query_param('page', $i) . '">' . $i . '</a>
        </li>';

        if ($i === $this_page + 4) break;
    }

    return '<div class="pagination">
        <ul class="block-style pagination_list">
            ' . $first_pagination . '
            ' . $middle_pagination . '
            ' . $end_pagination . '
        </ul>
    </div>';
}
