<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FULLSCREEN</title>
	<link rel="icon"  href="img/fullscreenTab.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url('style.css'); ?>">
	<!-- <link rel="stylesheet" href="css/fixed.css"> -->
</head>

<body data-spy="scroll" data-target="#navbarResponsive">

<!--- Start Home Section -->
<div id="home" class="offset">
    <!--- Navigation -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">

    	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
    		<span class="navbar-toggler-icon"></span>
    	</button>

    	<div class="collapse navbar-collapse" id="navbarResponsive">
    		<ul class="navbar-nav mx-auto">
    			<li class="nav-item col">
    				<a class="nav-link" href="#home">Home</a>
    			</li>
    			<li class="nav-item col">
    				<a class="nav-link" href="#nowshowing">Now Showing</a>
    			</li>
    			<li>
    				<a class="navbar-brand" href="#"><img src="img/fullscreen.png" class="logo" alt="logo"/></a>
    			</li>
    			<li class="nav-item col">
    				<a class="nav-link" href="#comingsoon">Coming Soon</a>
    			</li>
    			<li class="nav-item col">
    				<a class="nav-link" href="<?php echo site_url("login"); ?>">Log In</a>
    			</li>
    		</ul>
    	</div>
    </nav>
    <!--- End Navigation -->
    <!--- Start Landing Page Section -->
    <div class="home-wrap">
        <div class="landing container">
            <div class="row">
                <div class="col-6">
                    <h1 class="title">John</h1>
                	<h1 class="title">Wick <span>3</span></h1>
					<div class="d-flex">
						<a class="btn btn-danger btn-lg mx-2" href="#">Book Tickets</a>
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

				<div class="col-md-4">
					<div class="nowshowing">
						<a href="movie.php"><img src="<?php echo base_url('img/marvel.jpg') ?>" class="moviesNow" alt="marvel"/></a>
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
						<h3><a href="#">Captain Marvel</a></h3>
						<p class="textDuration">Duration: 180 min</p>
					</div>
				</div>
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

<footer>
<div class="row justify-content-center">
	<div class="col-md-5 text-center">
		<img src="img/fullscreen.png" class="footerlogo" alt="logo">
		<p class="footertext mt-3"> The first IMAX cinema in Malta</p>
		<strong>Contact Info</strong>
		<p class="mt-3">contactus@fullscreen.com</p>
		<p>+356 2190 9999</p>
	</div>
</div>
</footer>

<!--- End Coming Soon Section -->
<!--- Script Source Files -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
<!--- End of Script Source Files -->

</body>
</html>
