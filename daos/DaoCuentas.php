<?php namespace daos;

use \Exception as Exception;
use daos\Connection as Connection;
use models\Cuenta as Cuenta;

    class DaoCuentas {
       
       private $connection;
       private $tableName = "cuentas";
    
        
        public function Add(Cuenta $cuenta)
        {
           try
           {
            $query = "INSERT INTO ". $this->tableName."(email , password , privilegios) VALUES (:email , :password , :privilegios );";
            
            $parameters["email"] = $cuenta->getEmail();
            $parameters["password"] = $cuenta->getPassword();
            $parameters["privilegios"] = $cuenta->getPrivilegios();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
           }
           catch(Exception $ex) 
           {
                throw $ex;
           }
            
        }



        public function GetAll()
        {
            try
            {
                $cuentaList = array();

                $query = "SELECT * FROM ". $this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $row){

                    $cuenta = $this->mapeo($row);

                    array_push($cuentaList, $cuenta);

                }

                return $cuentaList;

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getById($id){
            try{
                
                $query = "SELECT * FROM". $this->tableName. "WHERE idCuenta = ". $id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                return $this->mapeo($result);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getByEmail($email){
            try{
                
                $query = " SELECT * FROM ". $this->tableName. " WHERE email = ". "'" .$email."'";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                return $this->mapeo($result);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
       
       
        public function mapeo($dato){
            
            $value = $dato[0];

            if(is_array($value) && array_key_exists('password', $value)){
                
                $cuenta = new Cuenta();
               
                $cuenta->setId($value["idCuenta"]);
                $cuenta->setEmail($value["email"]);
                $cuenta->setPassword($value["password"]);
                $cuenta->setPrivilegios($value["privilegios"]);

                return $cuenta;
            }

            return false;
        }
    
        public function exist($email){
            try{

                $query = "SELECT EXISTS ( SELECT * FROM ". $this->tableName. " WHERE email = ". "'" .$email."'" . ");";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                if($result[0][0] != 1) return false;
                else return true;
    
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function verificar($email, $password)
      {

            if($this->exist($email)){

                $cuenta = $this->getByEmail($email);

                if($cuenta != false){
                    if($cuenta->getPassword() == $password){
                     $_SESSION['cuenta'] = $cuenta;
                    }
                }
              
            }

    }
 }
