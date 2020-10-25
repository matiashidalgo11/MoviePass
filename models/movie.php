<?php namespace models;

    class Movie {

        private $popularity;
        private $video;
        private $poster_path;
        private $id;
        private $original_language;
        private $genre_ids;
        private $title;
        private $overview;
        private $release_date;
        private $enabled;


        public function __construct($popularity = "", $video = "", $poster_path = "", $id = "",
         $original_language = "", $title = "", $overview = "", $release_date = "", $enabled = true)
        {
            $this->popularity = $popularity;
            $this->video = $video;
            $this->poster_path = $poster_path;
            $this->id = $id;
            $this->original_language = $original_language;
            $this->genre_ids = array();
            $this->title = $title;
            $this->overview = $overview;
            $this->release_date = $release_date;
            $this->enabled = $enabled;
        }
        

        /**
         * Get the value of popularity
         */ 
        public function getPopularity()
        {
                return $this->popularity;
        }

        /**
         * Set the value of popularity
         *
         * @return  self
         */ 
        public function setPopularity($popularity)
        {
                $this->popularity = $popularity;

                return $this;
        }

        /**
         * Get the value of video
         */ 
        public function getVideo()
        {
                return $this->video;
        }

        /**
         * Set the value of video
         *
         * @return  self
         */ 
        public function setVideo($video)
        {
                $this->video = $video;

                return $this;
        }

        /**
         * Get the value of poster_path
         */ 
        public function getPoster_path()
        {
                return $this->poster_path;
        }

        /**
         * Set the value of poster_path
         *
         * @return  self
         */ 
        public function setPoster_path($poster_path)
        {
                $this->poster_path = $poster_path;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }


        /**
         * Get the value of original_language
         */ 
        public function getOriginal_language()
        {
                return $this->original_language;
        }

        /**
         * Set the value of original_language
         *
         * @return  self
         */ 
        public function setOriginal_language($original_language)
        {
                $this->original_language = $original_language;

                return $this;
        }

        /**
         * Get the value of genre_ids
         */ 
        public function getGenre_ids()
        {
                return $this->genre_ids;
        }

        /**
         * Set the value of genre_ids
         *
         * @return  self
         */ 
        public function setGenre_ids($genre_ids)
        {
                $this->genre_ids = $genre_ids;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of overview
         */ 
        public function getOverview()
        {
                return $this->overview;
        }

        /**
         * Set the value of overview
         *
         * @return  self
         */ 
        public function setOverview($overview)
        {
                $this->overview = $overview;

                return $this;
        }

        /**
         * Get the value of release_date
         */ 
        public function getRelease_date()
        {
                return $this->release_date;
        }

        /**
         * Set the value of release_date
         *
         * @return  self
         */ 
        public function setRelease_date($release_date)
        {
                $this->release_date = $release_date;

                return $this;
        }

        /**
         * Get the value of enabled
         */ 
        public function getEnabled()
        {
                return $this->enabled;
        }

        /**
         * Set the value of enabled
         *
         * @return  self
         */ 
        public function setEnabled($enabled)
        {
                $this->enabled = $enabled;

                return $this;
        }
    }
        



?>