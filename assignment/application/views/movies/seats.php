<!--- Start Landing Page Section -->
<?php echo form_open_multipart("movies/seats/{$screening['movie_time_id']}/submit") ?>
        <div class="tickets-desc">
            <div class="row">
                <div class="info col-12">
                    <h1 class="title-tickets">Choose Your Seats</h1>
                    <div class="offset">
                        <div class="card-body col-md-6">
                            <input type="hidden" name="screening" value="<?php echo $screening['movie_time_id'] ?>">
                        </br>
                            <?php echo form_error('email'); ?>
                            <?php echo custom_form_input('Email',[
                                'name'         => 'email',
                                'class'        => 'form-control',
                                'placeholder'  => 'emailaddress@hotmail.com',
                                'value'        => set_value('email')
                            ]); ?>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="reservation" method="post" action="">
                                    <section id="seats" class="seats">
                    			<?php
                    				$rows = 10;
                    				$seats = 10;
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
                </br>
                    <div class="d-flex">
						<button type="submit" class="btn btn-danger btn-lg mx-2 mt-4" href="#">Purchase Tickets</button>
				    </div>
                </div>
            </div>
        </div>
