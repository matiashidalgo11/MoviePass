


<div class="row row-cols-1 row-cols-md-4">

<?php foreach($moviesList as $movie){ ?>

    <form action="<?= FRONT_ROOT ?>movies/viewMovie" method="POST">

        <input type="hidden" value="<?php echo $movie->getId();?>" name="idMovie">

        <button type="submit">
            
            <div class="card bg-dark text-white mb-3">
            
                <img src=<?php echo IMG_BASE_TMBD . "w220_and_h330_face" . $movie->getPoster_path() ?> class="card-img" alt=<?php echo $movie->getTitle()?>>
            
                <div class="card-img-overlay d-flex align-items-end">
                    
                    <div class="list-group">
                        <h5 class="card-title "><?php echo $movie->getTitle()?></h5>
                        <p class="card-text"><?php echo $movie->getRelease_date()?></p>
                    </div>

                </div>

            </div>
        </button>

        <input type="hidden" value="<?php echo $movie->getId();?>" name="idMovie">

    </form>

<?php }?>




</div>




