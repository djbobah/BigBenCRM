<?php
include_once 'db.php';
include_once 'Student.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

$student = new Student($db);

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        $stmt = $student->read();
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($students);
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $student->name = $data->name;
        $student->age = $data->age;
        if ($student->create()) {
            echo json_encode(array("message" => "Student was created."));
        } else {
            echo json_encode(array("message" => "Unable to create student."));
        }
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));
        $student->id = $data->id;
        if ($student->delete()) {
            echo json_encode(array("message" => "Student was deleted."));
        } else {
            echo json_encode(array("message" => "Unable to delete student."));
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>