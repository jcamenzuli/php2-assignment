<!--- Start Landing Page Section -->
<div class="tickets-desc">
    <div class="row">
                <div class="info col-6">
                    <h1 class="title-tickets">Choose Your Tickets</h1>
                    <form class="col-4">
                          <div class="form-group">
                            <label for="exampleChooseDate">Date</label>
                            <select class="form-control">
                              <option>Choose date...</option>
                              <option>5/9/19</option>
                              <option>6/9/19</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Time</label>
                            <select class="form-control">
                              <option>Choose Time...</option>
                              <option>2:30</option>
                              <option>5:00</option>
                            </select>
                          </div>
                        </form>
                    <div class="d-flex">
						<a class="btn btn-danger btn-lg mx-2 mt-4" href="#">Next</a>
				    </div>
                </div>
        <div class="poster row">

        <img src="<?php echo base_url($movie['image']); ?>" class="posterticket"/>
                <h3 class="filmTitle mx-auto"><?php echo $movie['title']; ?></h3>
        </div>
    </div>
</div>
