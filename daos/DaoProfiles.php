<?php

namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use models\Cliente as Cliente;
use models\Cuenta;
use models\Profile as Profile;

class DaoProfiles implements IDao
{

    private $connection;
    private static $instance = null;

    //Info db
    const TABLE_NAME = "profiles";
    const COLUMN_DNI = "dni";
    const COLUMN_NOMBRE = "nombre";
    const COLUMN_APELLIDO = "apellido";
    const COLUMN_DIRECCION = "direccion";
    const COLUMN_TELEFONO = "telefono";
    const COLUMN_IDCUENTA = "idCuenta";


    private function __construct()
    {
    }

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance = new DaoProfiles();

        return self::$instance;
    }

    public function update($profile){
       
        if($profile instanceof Profile){
            
            if($this->exist($profile)){

                try{

                $query = "UPDATE " . DaoProfiles::TABLE_NAME .
                " SET " . DaoProfiles::COLUMN_NOMBRE . " = :" . DaoProfiles::COLUMN_NOMBRE . " , ".
                DaoProfiles::COLUMN_APELLIDO . " = :" . DaoProfiles::COLUMN_APELLIDO . " , ".
                DaoProfiles::COLUMN_DIRECCION . " = :". DaoProfiles::COLUMN_DIRECCION . " , ".
                DaoProfiles::COLUMN_TELEFONO . " = :" . DaoProfiles::COLUMN_TELEFONO . 
                " WHERE " . DaoProfiles::COLUMN_DNI . " = " . $profile->getDni() . " ;";

                $parameters = $this->toArray($profile,1);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);


                }
                catch (Exception $ex) {
                    throw $ex;
                }

            }
        }
    }

    public function exist($profile)
    {   
        if($profile instanceof Profile){
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoProfiles::TABLE_NAME . " WHERE " . DaoProfiles::COLUMN_DNI . " = " . "'" . $profile->getDni() . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if ($result[0][0] != 1) return false;
            else return true;
            
        } catch (Exception $ex) {
            throw $ex;
        }
        }else return false;
    }

    public function getByIdCuenta(int $idCuenta)
    {

        try {
            $query = "SELECT * FROM " . DaoProfiles::TABLE_NAME . " WHERE " . DaoProfiles::COLUMN_IDCUENTA . " = " . "'" . $idCuenta . "'" . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);
            
            $object = !empty($array) ? $array[0] : [];

            return $object;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getByDni(int $dni)
    {

        try {
            $query = "SELECT * FROM " . DaoProfiles::TABLE_NAME . " WHERE " . DaoProfiles::COLUMN_DNI . " = " . "'" . $dni . "'" . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            return $object;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM " . DaoProfiles::TABLE_NAME . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            return $array;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function add($cuenta)
    {

        if (($cuenta instanceof Cuenta) && ($cuenta->getProfile() instanceof Profile)) {

            try {
                $query = "INSERT INTO " . DaoProfiles::TABLE_NAME . "( " . DaoProfiles::COLUMN_DNI . " , " . DaoProfiles::COLUMN_NOMBRE . " , " . DaoProfiles::COLUMN_APELLIDO . " , " . DaoProfiles::COLUMN_DIRECCION . " , "  . DaoProfiles::COLUMN_TELEFONO . " , "  . DaoProfiles::COLUMN_IDCUENTA . " ) " .
                    " VALUES ( " . ":" . DaoProfiles::COLUMN_DNI . " , " . ":" . DaoProfiles::COLUMN_NOMBRE . " , " . ":" . DaoProfiles::COLUMN_APELLIDO . " , " . ":" . DaoProfiles::COLUMN_DIRECCION . " , " . ":" . DaoProfiles::COLUMN_TELEFONO . " , " . ":" . DaoProfiles::COLUMN_IDCUENTA . " ) ; ";

                $parameters = $this->toArray($cuenta->getProfile());
                $parameters[DaoProfiles::COLUMN_IDCUENTA] = $cuenta->getId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }


    public function toArray($object, $type = 0)
    {

        $parameters = array();

        if ($object instanceof Profile) {
           
            if($type == 0){
                $parameters[DaoProfiles::COLUMN_DNI] = $object->getDni();
            }
            
            $parameters[DaoProfiles::COLUMN_NOMBRE] = $object->getNombre();
            $parameters[DaoProfiles::COLUMN_APELLIDO] = $object->getApellido();
            $parameters[DaoProfiles::COLUMN_DIRECCION] = $object->getDireccion();
            $parameters[DaoProfiles::COLUMN_TELEFONO] = $object->getTelefono();
        }

        return $parameters;
    }

    public function mapeo($value)
    {

        $value = is_array($value) ? $value : [];

        $resp = array_map(
            function ($p) {
                return new Profile($p[DaoProfiles::COLUMN_DNI], $p[DaoProfiles::COLUMN_NOMBRE], $p[DaoProfiles::COLUMN_APELLIDO], $p[DaoProfiles::COLUMN_DIRECCION], $p[DaoProfiles::COLUMN_TELEFONO]);
            },
            $value
        );


        return $resp;
    }
}
