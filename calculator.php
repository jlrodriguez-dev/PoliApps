<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Acess-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['operacion']) && isset($_GET['num1']) && isset($_GET['num2'])) {
        $operation = $_GET['operacion'];
        $num1 = (float)$_GET['num1'];
        $num2 = (float)$_GET['num2'];

        switch ($operation) {
            case 'suma':
                $result = $num1 + $num2;
                break;
            case 'resta':
                $result = $num1 - $num2;
                break;
            case 'multiplicacion':
                $result = $num1 * $num2;
                break;
            case 'division':
                if ($num2 == 0) {
                    echo json_encode(["error" => "Division por cero no es posible"]);
                    exit;
                }
                $result = number_format($num1 / $num2, 2);
                break;
            default:
                echo json_encode(["error" => "Operación no válida"]);
                exit;
        }

        echo json_encode(["result" => $result]);
    } else {
        echo json_encode(["error" => "Faltan parámetros"]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
} else {
    echo json_encode(["error" => "Petición no válida"]);
}
?>