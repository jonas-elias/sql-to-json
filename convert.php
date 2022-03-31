<?php

$mysqli = new mysqli('localhost', 'root', '', 'convert_sql_json');

if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = str_replace("`", "", $_POST['sql']);

$sql = explode(';', trim($sql, ';'));

$table_name = "";

foreach ($sql as $value) {
    if ($mysqli->query($value) === TRUE) {
        if (strpos($value, "CREATE") !== FALSE) {
            $string = str_split($value);

            for ($i = 0; $i < count($string); $i++) {
                if ($i >= 12) {
                    if ($string[$i] != "(") {
                        $table_name .= $string[$i];
                    } else {
                        break;
                    }
                }
            }
        }
    } else {
        echo "Error execute query: " . $mysqli->error;
    }
}

$query_select = "select * from $table_name";

$result = $mysqli->query($query_select);
$rows = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($rows);

function sql_format($query)
{
    $keywords = array("select", "from", "where", "order by", "group by", "insert into", "update", "SET", ",");
    foreach ($keywords as $keyword) {
        if (preg_match("/($keyword *)/i", ",", $matches)) {
            $query = str_replace($matches[1], strtoupper($matches[1]) . "<br/>&nbsp;&nbsp;  ", $query);
        } else if (preg_match("/($keyword *)/i", $query, $matches)) {
            $query = str_replace($matches[1], "<br>" . strtoupper($matches[1]) . "<br/>&nbsp;  ", $query);
        }
    }
    return $query;
}
