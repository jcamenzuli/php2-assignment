<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>FULLSCREEN</title>
    	<link rel="icon"  href="img/fullscreenTab.png">
    	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
    	<link rel="stylesheet" href="style.css">
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
        <div class="tickets-desc">
            <div class="row">
                        <div class="info col-12">
                            <h1 class="title-tickets">Choose Your Seats</h1>
                            <div class="seat-selection offset">
                                <div class="container">
                                    <div class="screen mb-4 col-12">
                                        <img src="img/screen.png" alt="screen">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form id="reservation" method="post" action="">
                                            <section id="seats" class="seats">
                            			<?php
                            				$rows = 10;
                            				$seats = 15;
                            				for ($row = 0; $row < $rows; $row++)
                            				{
                            					for ($seat = 1; $seat <= $seats; $seat++)
                            					{
                            						$seat_num = ($row * $seats) + $seat;

                            						echo '<input id="seat-', $seat_num,' " class="seat-select" type="checkbox" value="', $seat_num,'" name="seats[]" >';
                            	                    echo '<label for="seat-', $seat_num,' " class="seat"></label>';
                            					}
                            				}
                            			?>

                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
        						<a class="btn btn-danger btn-lg mx-2 mt-4" href="#">Next</a>
        				    </div>
                        </div>
            </div>
        </div>
        <!--- End Landing Page Section -->
    </div>
    <footer>
    <div class="row justify-content-center">
    	<div class="col-md-5 text-center">
    		<img src="img/fullscreen.png" class="footerlogo" alt="logo">
    		<p class="footertext mt-3"> The first IMAX cinema in Malta.</p>
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
