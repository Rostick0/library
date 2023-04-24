<?

function protect_data($data)
{
    return trim(
        htmlspecialchars(
            addslashes($data)
        )
    );
}

function can_null($data) {
    return !empty($data) ? "'$data'" : "NULL";
}