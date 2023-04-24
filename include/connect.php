<?

$connect_config = [
    'hostname' => '127.0.0.1',
    'username' => 'root',
    'password' => 'root',
    'database' => 'library'
];

$mysqli = new mysqli($connect_config['hostname'], $connect_config['username'], $connect_config['password'], $connect_config['database']);
