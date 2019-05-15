<!DOCTYPE html>
<html lang="en" dir="ltr">
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
        				<a class="nav-link" href="#tickets">About Us</a>
        			</li>
        		</ul>
        	</div>
        </nav>
        <!--- End Navigation -->
        <!--- Start Landing Page Section -->
        <div class="movie-desc">
                    <div class="row">
                        <div class="info col-6">
                            <h1 class="movie-title">Captain Marvel</h1>
                            <div class="details d-flex">
                                <h4 class="genre mr-4">Genre: Action, Adventure, Sci-Fi</h4>
                                <h4 class="duration ml-4">Duration: 123 min</h4>
                            </div>
                            <div class="movie-sum mb-4">
                                <p class="text-sm-left">After crashing an experimental aircraft, Air Force pilot Carol Danvers is discovered by the Kree and trained as a member of the elite Starforce Military under the command of her mentor Yon-Rogg. Six years later, after escaping to Earth while under attack by the Skrulls, Danvers begins to discover there's more to her past. With help from S.H.I.E.L.D. agent Nick Fury, they set out to unravel the truth.</p>
                            </div>
                            <div class="d-flex">
        						<a class="btn btn-danger btn-lg mx-2" href="#">Book Tickets</a>
                                <a class="btn btn-dark btn-lg mx-2" href="#">Watch Trailer</a>
        				</div>
                </div>
                <div class="poster">
                    <a href="movie.html"><img src="img/captain-marvel.jpg" class="poster" alt="marvel"/></a>
                </div>
            </div>
        </div>
        <!--- End Landing Page Section -->
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
