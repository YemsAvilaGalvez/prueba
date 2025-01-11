<?php
class conexionBD
{
    private $pdo;

    public function conexionPDO(){
        $host       = "localhost";
        $usuario    = "root";
        $contrasena = "";
        $bdName     = "difuntos";
        try {
            // Establecer la conexión PDO
            $this->pdo = new PDO("mysql:host=$host;dbname=$bdName",$usuario,$contrasena);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("set names utf8");
            return $this->pdo;  // Devuelve el objeto PDO
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
            return null; // Retorna null si hay un error en la conexión
        }
    }

    public function cerrar_conexion(){
        $this->pdo = null;  // Cierra la conexión correctamente
    }
}
?>
