
    <!--- Start Landing Page Section -->
    <div class="home-wrap">
        <div class="landing container">
            <div class="row">
                <div class="col-6">
                    <h1 class="title">John</h1>
                	<h1 class="title">Wick <span>3</span></h1>
					<div class="d-flex">
						<a class="btn btn-danger btn-lg mx-2" href="<?php echo site_url('movie')?>">Book Tickets</a>
						<a class="youtube" href="https://www.youtube.com/watch?v=M7XM597XO94" target="_blank">
							<i class="fab fa-youtube fa-4x d-block"></i>
						</a>
					</div>
                </div>
            </div>
        </div>
    </div>
    <!--- End Landing Page Section -->
</div>
<!--- End Home Section -->

<!--- Start Showing Section -->
<div id="nowshowing" class="offset">
	<div class="jumbotron">
		<div class="narrow">
			<div class="col-12">
				<h1 class="heading text-center">Now Showing</h1>
				<div class="heading-underline"></div>
			</div>
			<div class="row text-center">

<?php
        foreach($movies as $movie):
            $images = glob("uploads/movies/images/{$movie['id']}.*");
            if (count($images) > 0) $images = $images[0];
?>
				<div class="col-md-4">
					<div class="nowshowing">
						<a href="<?php echo site_url("movies/view/{$movie['slug']}"); ?>">
                            <img src="<?php echo base_url('img/marvel.jpg') ?>" class="moviesNow" alt="marvel"/></a>
						<h3><?php echo $movie['title']; ?></h3>
						<h4><?php echo $movie['movie_genre'] ?> <?php echo $movie['runtime']. "minutes" ?></h4>
					</div>
				</div>
<?php endforeach; ?>

			</div>
			<!--- End of Row -->
		</div>
	</div>
</div>
<!--- End Showng Section -->
<!--- Start Coming Soon Section -->
<div id="comingsoon" class="offset">
	<div class="jumbotron">
		<div class="narrow">
			<div class="col-12">
				<h1 class="heading text-center">Coming Soon</h1>
				<div class="heading-underline"></div>
			</div>
			<div class="row text-center">

				<div class="col-md-4">
					<div class="nowshowing">
						<a href="#"><img src="img/marvel.jpg" class="moviesNow" alt="marvel"/></a>
						<h3>Captain Marvel</h3>
						<p class="textDuration">Duration: 180 min</p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="nowshowing">
						<a href="#"><img src="img/marvel.jpg" class="moviesNow" alt="marvel"/></a>
						<h3>Captain Marvel</h3>
						<p class="textDuration">Duration: 180 min</p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="nowshowing">
						<a href="#"><img src="img/marvel.jpg" class="moviesNow" alt="marvel"/></a>
						<h3>Captain Marvel</h3>
						<p class="textDuration">Duration: 180 min</p>
					</div>
				</div>
			</div>
			<!--- End of Row -->
		</div>
	</div>
</div>
