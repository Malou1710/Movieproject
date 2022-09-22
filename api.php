<?php
require "settings/init.php";

//henter data der bliver sendt
$data = json_decode(file_get_contents('php://input'), true);

$data['password'] = 1710;
//$data['nameSearch'] = 'Løvernes Konge';

//
//
// password: Skal udfyldes og være 1710
// nameSearch: Valgfri               ;

/*
$header = "HTTP/1.1 400 Bad Request"; // Sending malformed data results in a 400 Bad Request response.
$header = "HTTP/1.1 401 Unauthorized"; // Trying to access to the API without authentication results in a 401 Unauthorized response.
$header = "HTTP/1.1 404 Not Found"; // Not Found
$header = "HTTP/1.1 405 Method Not Allowed"; // Trying to use a method on a route for which it is not implemented results in a 405 Method Not Allowed.
$header = "HTTP/1.1 422 Unprocessable Entity"; // Sending invalid data results in a 422 Unprocessable Entity response.

$header = "HTTP/1.1 200 OK"; // Getting a resource or a collection resources results in a 200 OK response
$header = "HTTP/1.1 200 Created"; // Creating a resource results in a 201 Created response.
$header = "HTTP/1.1 200 No Content"; // Updating or deleting a resource results in a 204 No Content response.
 */

header('Content-Type: application/json; charset=utf-8');

if ($data["password"] == "1710"){
    $sql = "SELECT * FROM Filmsogning WHERE 1=1";
    $bind = [];

    if(!empty($data["nameSearch"])){
        $sql .= " AND filmTitel = :filmTitel";
        $bind[":filmTitel"] = $data["nameSearch"];
    }

    $Filmsogning = $db->sql($sql, $bind);
    header("HTTP/1.1 200 OK");

    echo json_encode($Filmsogning);

} else {
    header ("HTTP/1.1 401 Unauthorized");
    $error["errorMessage"] = "Dit kodeord var forkert";
    echo json_encode($error);
}
?>
