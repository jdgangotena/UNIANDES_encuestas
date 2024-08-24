<?php
class conexion {
    # Variables para efectuar la conexión con la BD.
    private static $servidor = "localhost";
    private static $usuario = "root";
    private static $contrasenia = "";
    private static $basedatos = "s360_encuesta";

    private $conexion;
    private $cod_auto = 0;

    // Constructor de la clase
    public function __construct() {
        $this->conexion = new mysqli(self::$servidor, self::$usuario, self::$contrasenia, self::$basedatos);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
        $this->conexion->set_charset("utf8");
    }

    protected function consulta($crud, $proc, $params = []) {
        try {
            $stmt = $this->conexion->prepare($crud);
            if ($stmt === false) {
                throw new Exception("Error en la preparación de la consulta: " . $this->getLastError());
            }

            // Asignar los parámetros si existen
            if (!empty($params)) {
                $stmt->bind_param(...$params);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución de la consulta: " . $this->getLastError());
            }

            // Obtener el ID insertado si corresponde
            if ($proc == 1) {
                $this->cod_auto = $this->conexion->insert_id;
            }

            // Verificar si se espera un resultado
            if (strpos(strtoupper($crud), 'SELECT') !== false) {
                $resultado = $stmt->get_result();
                $stmt->close();
                return $resultado;
            } else {
                $stmt->close();
                return true; // Para consultas que no devuelven resultados (INSERT, UPDATE, DELETE)
            }
        } catch (Exception $e) {
            // Mostrar el mensaje de error y retornar falso
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function getCodigoAuto() {
        return $this->cod_auto;
    }

    // Método para obtener el último error de MySQL
    public function getLastError() {
        return $this->conexion->error;
    }
}
?>
