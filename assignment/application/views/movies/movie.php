        <!--- Start Landing Page Section -->
        <div class="movie-desc">
                    <div class="row">
                        <div class="info col-6">
                            <h1 class="movie-title"><?php echo $movie['title']; ?></h1>
                            <div class="details d-flex">
                                <h4 class="genre mr-4">Genre: <?php echo $movie['movie_genre']; ?></h4>
                                <h4 class="duration ml-4">Duration: <?php echo $movie['runtime']. " minutes" ?></h4>
                            </div>
                            <div class="movie-sum mb-4">
                                <p class="text-sm-left"><?php echo $movie['description']; ?></p>
                            </div>
                            <div class="d-flex">
        						<a class="btn btn-danger btn-lg mx-2" href="#">Book Tickets</a>
                                <a class="btn btn-dark btn-lg mx-2" href="<?php echo $movie['video']; ?>" target="_blank">Watch Trailer</a>
        				</div>
                </div>
                <div class="poster">
                    <img src="<?php echo base_url($movie['image']); ?>" class="poster"/>
                </div>
            </div>
        </div>
        <!--- End Landing Page Section -->
