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
    				<a class="navbar-brand" href="#"><img src="<?php echo base_url('img/fullscreen.png')?>" class="logo" alt="logo"/></a>
    			</li>
    			<li class="nav-item col">
    				<a class="nav-link" href="#comingsoon">Coming Soon</a>
    			</li>
    			<li class="nav-item col">
                    <?php $is_logged = $this->system->confirm_session();
                    if(!$is_logged):
                     ?>
    				<a class="nav-link" href="<?php echo site_url("login"); ?>">Log In</a>
                <?php else: ?>
                    <a class="nav-link" href="<?php echo site_url("logout"); ?>">Log Out</a>
                <?php endif; ?>
    			</li>
    		</ul>
    	</div>
    </nav>
    <!--- End Navigation -->
    
