<!--- Start Landing Page Section -->
<div class="tickets-desc">
    <div class="row">
                <div class="info col-6">
                    <h1 class="title-tickets">Choose Your Tickets</h1>
                    <form class="col-4">
                        <?php foreach ($screenings as $screening):?>
                          <div class="form-group">
                            <label for="exampleChooseDate">Date</label>
                            <select class="form-control">
                              <option value="<?php echo $screening['movie_time_id'] ?>"><?php echo date("d F Y  H:i", $screening['movie_time']) ?></option>
                            </select>
                          </div>
<?php endforeach; ?>
                        </form>
                    <div class="d-flex">
						<a class="btn btn-danger btn-lg mx-2 mt-4" href="#">Next</a>
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
