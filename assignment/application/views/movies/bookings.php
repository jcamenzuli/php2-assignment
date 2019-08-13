<!--- Start Landing Page Section -->
<?php echo form_open_multipart("movies/bookings/{$movie['slug']}/submit"); ?>
<div class="tickets-desc">
    <div class="row">
                <div class="info col-6">
                    <h1 class="title-tickets">Choose Your Tickets</h1>
                    <form class="col-4">
                          <div class="form-group">
                            <label for="exampleChooseDate">Date</label>
                            <select class="form-control" name="screen-time">
<?php foreach ($screenings as $screening):?>
                              <option value="<?php echo $screening['movie_time_id'] ?>"><?php echo date("d F Y  H:i", $screening['movie_time']) ?></option>
<?php endforeach; ?>
                            </select>
                          </div>
                        </form>
                    <div class="d-flex">
						<button  type="submit" class="btn btn-danger btn-lg mx-2 mt-4">Next</button>
                        <!-- href="<?php echo site_url("movies/seats/{$movie['slug']}") ?>" -->
				    </div>
                </div>
        <div class="poster row">

        <img src="<?php echo base_url($movie['image']); ?>" class="posterticket"/>
                <h3 class="filmTitle mx-auto"><?php echo $movie['title']; ?></h3>
                <br>
                <h5 class="mx-auto">Genre: <?php echo $movie['movie_genre']; ?></h5>
        </div>
    </div>
</div>
