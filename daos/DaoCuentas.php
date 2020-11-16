<?php

namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use models\Cuenta as Cuenta;
use daos\DaoProfiles as DaoProfiles;

class DaoCuentas implements IDao
{

    private $connection;
    private static $instance = null;

    //Info db
    const TABLE_NAME = "cuentas";
    const COLUMN_IDCUENTA = "idCuenta";
    const COLUMN_EMAIL = "email";
    const COLUMN_PASSWORD = "password";
    const COLUMN_PRIVILEGIOS = "privilegios";
    const COLUMN_IDFB = "idFacebook";

    private function __construct(){
        
    }

    public static function GetInstance()
    {
        if (self::$instance == null)
            self::$instance = new DaoCuentas();

        return self::$instance;
    }

    public function update($cuenta){
        
       
            if($cuenta instanceof Cuenta){
                
                if($this->exist($cuenta->getEmail())){
    
                    try{
    
                    $query = "UPDATE " . DaoCuentas::TABLE_NAME .
                    " SET " . DaoCuentas::COLUMN_EMAIL . " = :" . DaoCuentas::COLUMN_EMAIL . " , ".
                    DaoCuentas::COLUMN_PASSWORD . " = :" . DaoCuentas::COLUMN_PASSWORD . " , ".
                    DaoCuentas::COLUMN_PRIVILEGIOS . " = :". DaoCuentas::COLUMN_PRIVILEGIOS . " , ".
                    DaoCuentas::COLUMN_IDFB . " = :" . DaoCuentas::COLUMN_IDFB . 
                    " WHERE " . DaoCuentas::COLUMN_IDCUENTA . " = " . $cuenta->getId() . " ;";
    
                    $parameters = $this->toArray($cuenta,1);
    
                    $this->connection = Connection::GetInstance();
    
                    $this->connection->ExecuteNonQuery($query, $parameters);
    
                    $daoProfile = DaoProfiles::GetInstance();
                    $daoProfile->update($cuenta->getProfile());
    
                    }
                    catch (Exception $ex) {
                        throw $ex;
                    }
    
                }
            }
        
    }

    public function toArray($object, $type = 0)
    {

        $parameters = array();

        if ($object instanceof Cuenta) {
           
            if($type == 0){
                $parameters[DaoCuentas::COLUMN_IDCUENTA] = $object->getId();
            }

            $parameters[DaoCuentas::COLUMN_EMAIL] = $object->getEmail();
            $parameters[DaoCuentas::COLUMN_PASSWORD] = $object->getPassword();
            $parameters[DaoCuentas::COLUMN_PRIVILEGIOS] = $object->getPrivilegios();
            $parameters[DaoCuentas::COLUMN_IDFB] = $object->getIdFb();
        }

        return $parameters;
    }
    
    public function add($cuenta)
    {
        if ($cuenta instanceof Cuenta) {


            try {
                $query = "INSERT INTO " . DaoCuentas::TABLE_NAME . " ( " . DaoCuentas::COLUMN_EMAIL . " , " . DaoCuentas::COLUMN_PASSWORD . " , " . DaoCuentas::COLUMN_PRIVILEGIOS . " , " . DaoCuentas::COLUMN_IDFB . " ) VALUES ( " . ":" . DaoCuentas::COLUMN_EMAIL . " , " . ":" . DaoCuentas::COLUMN_PASSWORD . " , " . ":" . DaoCuentas::COLUMN_PRIVILEGIOS . " , " .":" . DaoCuentas::COLUMN_IDFB  . " );";

                $parameters[DaoCuentas::COLUMN_EMAIL] = $cuenta->getEmail();
                $parameters[DaoCuentas::COLUMN_PASSWORD] = $cuenta->getPassword();
                $parameters[DaoCuentas::COLUMN_PRIVILEGIOS] = $cuenta->getPrivilegios();
                $parameters[DaoCuentas::COLUMN_IDFB] = $cuenta->getIdFb();


                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

                //el id se genera en la base de datos, por eso tengo que pedir nuevamente el objeto.
                $object = $this->getByEmail($cuenta->getEmail());

                $cuenta->setId($object->getId());
            
                $daoProfile = DaoProfiles::GetInstance();

                $daoProfile->add($cuenta);

                

            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

  /*   public function addByFB($cuenta){
        
        if ($cuenta instanceof Cuenta) {


            try {
                $query = "INSERT INTO " . DaoCuentas::TABLE_NAME . " ( " . DaoCuentas::COLUMN_EMAIL . " , " . DaoCuentas::COLUMN_IDFB . " ) VALUES ( " . ":" . DaoCuentas::COLUMN_EMAIL . " , " . ":" . DaoCuentas::COLUMN_IDFB  . " );";

                $parameters[DaoCuentas::COLUMN_EMAIL] = $cuenta->getEmail();
                $parameters[DaoCuentas::COLUMN_IDFB] = $cuenta->getIdFb();
 
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);


            } catch (Exception $ex) {
                throw $ex;
            }
        }

    } */

    public function setIdFb($cuenta){
        if ($cuenta instanceof Cuenta) {

            try {

                $query = "UPDATE " . DaoCuentas::TABLE_NAME . " SET ". DaoCuentas::COLUMN_IDFB." = '". $cuenta->getIdFb() . "' WHERE " . DaoCuentas::COLUMN_IDCUENTA . " = " . $cuenta->getId() ." ;";

 
                $this->connection = Connection::GetInstance();

                $this->connection->Execute($query);


            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function getAll()
    {
        try {
            $listCuentas = array();

            $query = "SELECT * FROM " . DaoCuentas::TABLE_NAME;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $listCuentas = $this->mapeo($resultSet);

            var_dump($listCuentas);

            /* return $listCuentas; */

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //Falta complementar el perfil
    public function getById($id)
    {
        try {


            $query = "SELECT * FROM " . DaoCuentas::TABLE_NAME . " WHERE " . DaoCuentas::COLUMN_IDCUENTA . " = " . $id . " ;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);
            
            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

        /*     $daoPerfil = DaoProfiles::GetInstance();

            $object->setProfile($daoPerfil->getByIdCuenta($id)); */


            return $object;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getByEmail($email)
    {
        try {

            $query = " SELECT * FROM " . DaoCuentas::TABLE_NAME . " WHERE " . DaoCuentas::COLUMN_EMAIL . " = " . "'" . $email . "'";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $array = $this->mapeo($resultSet);

            $object = !empty($array) ? $array[0] : [];

            /* $daoPerfil = DaoProfiles::GetInstance();

            $object->setProfile($daoPerfil->getByIdCuenta($object->getId())); */

            return $object;


        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function exist($email)
    {
        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoCuentas::TABLE_NAME . " WHERE " . DaoCuentas::COLUMN_EMAIL . " = " . "'" . $email . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            $rta = ($result[0][0] != 1)? false : true;

            return $rta;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function existIdFb($idFb)
    {

        try {

            $query = "SELECT EXISTS ( SELECT * FROM " . DaoCuentas::TABLE_NAME . " WHERE " . DaoCuentas::COLUMN_IDFB . " = " . "'" . $idFb . "'" . ");";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            $rta = ($result[0][0] != 1)? false : true;

            return $rta;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

       //Agregar el perfil tambien
       public function mapeo($value)
       {
   
           $value = is_array($value) ? $value : [];
   
           $resp = array_map(
               function ($p) {

                   $object =  new Cuenta($p[DaoCuentas::COLUMN_IDCUENTA], $p[DaoCuentas::COLUMN_EMAIL], $p[DaoCuentas::COLUMN_PASSWORD], $p[DaoCuentas::COLUMN_PRIVILEGIOS]);

                   $daoProfile = DaoProfiles::GetInstance();

                   $object->setProfile($daoProfile->getByIdCuenta($object->getId()));

                   return $object;
               
                },
               $value
           );
   
   
           return $resp;
       }

    


}
