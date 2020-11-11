<?php namespace controllers;

use daos\DaoGenres;

class HomeController {

        function navBar(){

            $genderDAO = DaoGenres::GetInstance();
            $genderDAO->updateFromApi();
            
            $listGenres = $genderDAO->getAll();
        
            include_once ROOT . VIEWS_PATH . 'nav-bar.php'; 
        
        }
    }

?>