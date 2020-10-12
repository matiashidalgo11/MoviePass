<?php namespace daos;

    use models\Cuenta as Cuenta;

    class DaoCuentas {
       
       private $cuentas_list = array();
       private $file_name; 
       
        public function __construct()
        {
            $this->file_name = dirname(__DIR__)."/data/cuentas.json";
        }

        //No sabria si el filtro de que si existe va en el daos o en el controllers
        public function Add(Cuenta $cuenta)
        {
            $this->RetrieveData();
            
            if(!$this->exist($cuenta)){
               
                array_push($this->cuentas_list, $cuenta);
                return $this->SaveData();
            }
            return false;
        }

        //Guardar las peliculas en el arreglo por el id ?)
        public function AddArray($cuentaArray){
           
            $this->RetrieveData();

            foreach($cuentaArray as $cuenta){

                if(!$this->exist($cuenta)){
                    array_push($this->cuentas_list, $cuenta);
                }
                
            }

            return $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cuentas_list;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cuentas_list as $cuenta)
            {
                $valuesArray["id"] = $cuenta->getId();
                $valuesArray["email"] = $cuenta->getEmail();
                $valuesArray["password"] = $cuenta->getPassword();
                $valuesArray["privilegios"] = $cuenta->getPrivilegios();                

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            return file_put_contents($this->file_name, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cuentas_list = array();

            if(file_exists($this->file_name))
            {
                $jsonContent = file_get_contents($this->file_name);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cuenta = new Cuenta();
                    $cuenta->setId($valuesArray["id"]);
                    $cuenta->setEmail($valuesArray["email"]);
                    $cuenta->setPassword($valuesArray["password"]);
                    $cuenta->setPrivilegios($valuesArray["privilegios"]);

                    array_push($this->cuentas_list, $cuenta);
                }
            }
        }

        //Esta la funcion in_array tambien.
        private function exist(Cuenta $cuenta){
            
            foreach($this->cuentas_list as $aux){
               
                if($aux->getId() == $cuenta->getId() && $aux->getEmail() == $cuenta->getEmail()){
                   
                    return true;
                }
            }

            return false;
        }

        public function verificar($email, $password)
      {

        $this->RetrieveData();

        foreach ($this->cuentas_list as $aux){
            if($aux->getEmail() == $email && $aux->getPassword() == $password){
                   $_SESSION['cuenta'] = $aux;

                   //hay que incluir pantalla y los nav segun privilegios
            }
        }
    }
 }?>