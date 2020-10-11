
<?php $list_movies = $this->movies_dao->GetAll(); ?>

<?php foreach($list_movies as $movie){ ?>

    <h2> <?= $movie->getTitle()?> </h2>
    <img src= <?= IMG_BASE_TMBD . "w220_and_h330_face" . $movie->getPoster_path() ?> alt=<?= $movie->getTitle()?>>
    <p> <?= $movie->getOverview()?></p>
   
   <h3><?php foreach($movie->getGenre_ids() as $genero){
            echo $genero;
        } 
    ?></h3>

<?php }?>