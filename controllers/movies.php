<?php namespace controllers;


    class Movies {

        public function updateList(){

            $movies_dao = new \daos\Movies();
            $tmdb_dao = new \daos\Tmdb();
            $tmdb_dao->UpdateData();

            $new_list_movie = $tmdb_dao->GetAll();
            

            if($movies_dao->AddArray($new_list_movie)){
                
                

                include ROOT .  VIEWS_PATH . 'list_movies.php';

            } else {

                include ROOT . VIEWS_PATH . 'login.php';
            } 


        }
    }

?>