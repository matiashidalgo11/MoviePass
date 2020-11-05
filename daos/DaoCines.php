<?php namespace daos;

    use models\Cine as cine;
    use daos\Connection as Connection;
use PDOException;

// Arreglar el Modify


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


        } catch (PDOException $ex) { 
            throw $ex; 
        } 
    } 


       //Si el resultado del execute no termina dando un Cine, el mapeo lo transforma en uno
       public function mapeo($value) 
    { 
 
        $value = is_array($value) ? $value : []; 
 
        $resp = array_map( 
            function ($p) { 
 
                $objet =  new Cine( 
                    $p[DaoCines::TABLE_IDCINE], 
                    $p[DaoCines::TABLE_NOMBRE], 
                    $p[DaoCines::TABLE_DIRECCION], 
                    $p[DaoCines::TABLE_ROOM] 
                ); 
 
                return $objet; 
            }, 
            $value 
        ); 
        return count($resp) > 1 ? $resp : $resp['0']; 
    } 

    public function mapeo($row){
        $cine = new Cine();
        $cine->setId($row["idCine"]);
        $cine->setNombre($row["nombre"]);
        $cine->setDireccion($row["direccion"]);
        $cine->setRoom($row["room"]);
        return $cine;
    }

        public function Update($cine){
            $sql = "UPDATE  cines (" . DaoCines::TABLE_NOMBRE . "," . DaoCines::TABLE_DIRECCION . "," . DaoCines::TABLE_ROOM  . ")";
            
            
            $parameters[DaoCines::TABLE_NOMBRE] = $cine->getNombre(); 
            $parameters[DaoCines::TABLE_DIRECCION] = $cine->getDireccion(); 
            $parameters[DaoCines::TABLE_ROOM] = $cine->getRoom(); 
        
            try{
                $this->connection = Connection::GetInstance(); 
                return $this->connection->ExecuteNonQuery($sql, $parameters); 
            } catch (PDOException $ex) { 
                throw $ex; 
            }
    }


        public function getAll(){
            $sql = "SELECT * FROM cines;";

            $cineList = array();

            try{
                $this->connection = Connection::GetInstance();
 
                $resultSet = $this->connection->Execute($sql);
     
                /*if(!empty($resultSet) && $object instanceof Cine){ 
     
                    foreach ($resultSet as $value) {
                        $aux = $this->mapeo($value);
                        array_push($cineList,$aux);
                    }  
                }
                else{
                    return false;
                }*/

               
                
                foreach($resultSet as $value)
                {
                    array_push($cineList,$this->parseToObject($value));
                }
                return $cineList;
     
            } catch (PDOException $ex) { 
                throw $ex; 
            } 

        }

    

        public function Delete($id)
        {

        }

        public function getById($idCine){ 
        
            $sql = "SELECT * FROM  cines WHERE idCine=".$idCine.";"; 
            try { 
    
                
     
                $this->connection = Connection::GetInstance();
     
                $resultSet = $this->connection->Execute($sql);
     
               /* if(!empty($resultSet) && $object instanceof Cine){ 
     
                     return $this->mapeo($resultSet);   
                }
                else{
                    return false;
                }*/
                foreach($resultSet as $value)
                {

                    $cine=$this->parseToObject($value);
                }
    
                return $cine;
     
     
            } catch (PDOException $ex) { 
                throw $ex; 
            } 
           } 

           public function parseToObject($value)
           {
               
                   $cine=new Cine($value['nombre'],$value['direccion'],$value['idCine']);
               
   
               return $cine;
           }
    

   
    }

    }
?>