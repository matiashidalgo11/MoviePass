<?php namespace daos;

    use models\Cine as cine;
    use daos\Connection as Connection; 

    class DaoCines {
       
    private $connection;

       
        public function __construct(){

        }

        public function Add($cine)
        {
            $sql = "INSERT into cines (nombre, direccion,room ) values ( :nombre,:direccion, :room)";
            $parameters['nombre'] =  $cine->getNombre();
            $parameters['direccion'] =  $cine->getDireccion();
            $parameters['room'] =  $cine->getRoom();
            try { 
            $this->connection = Connection::GetInstance(); 
            return $this->connection->ExecuteNonQuery($sql,$parameters);
        } catch (Exception $ex) { 
            throw $ex; 
        } 
    } 

    public function getById($idCine){ 
        $cine = null;
        try { 
            $sql = "SELECT * from  cines where idCine=:idCine"; 
            $parameters['idCine'] = $idCine;
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql,$parameters);
            if(!empty($resultSet)){ 
                 $cine = $this->mapeo($resultSet);   
            }
        } catch (Exception $ex) { 
            throw $ex; 
        } 
        return $cine;
    } 

    public function mapeo($row){
        $cine = new Cine();
        $cine->setId($row["idCine"]);
        $cine->setNombre($row["nombre"]);
        $cine->setDireccion($row["direccion"]);
        $cine->setRoom($row["room"]);
        return $cine;
    }

    public function Update($idCine){
            $sql = "UPDATE  cines (:nombre,:direccion,:room) where idCine=:idCine";
            $parameters['nombre'] = $cine->getNombre(); 
            $parameters['direccion'] = $cine->getDireccion(); 
            $parameters['room'] = $cine->getRoom(); 
            try{
                $this->connection = Connection::GetInstance(); 
                return $this->connection->ExecuteNonQuery($sql, $parameters); 
            } catch (Exception $ex) { 
                throw $ex; 
            }
    }

    public function GetAll(){
        $sql = "SELECT from cines";
        $cineList = array();
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($sql);
            if(!empty($resultSet)){ 
                foreach ($resultSet as $row) {
                    $aux = $this->mapeo($row);
                    array_push($cineList,$aux);
                }  
            }
            } catch (Exception $ex) { 
                throw $ex; 
            } 
        return $cineList;
    }

    public function remove($idCine){
        $value =0;
        try
        {
            $parameters['idCine'] = $idCine;
            $sql = "DELETE from cines where idCine=:idCine";  
             $this->connection=Connection::getInstance();
             $value = $this->connection->ExecuteNonQuery($sql,$parameters);
        }
            catch(Exception $ex){
            throw $ex;
        }
        return $value;
    }

    }
?>