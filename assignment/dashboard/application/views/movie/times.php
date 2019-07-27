<?php echo form_open_multipart("movie/times/{$movie['slug']}/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">



                <?php echo form_error('show-date'); ?>
                <?php echo custom_form_input('Date', [
                    'name'          => 'show-date',
                    'class'         => 'form-control',
                    'placeholder'   => 'Showing Date',
                    'value'         => set_value('show-date')
                ]); ?>

                <?php echo form_dropdown('show-theatre', $theatre, set_value('show-theatre'));
                ?>
                <?php echo form_dropdown('show-time', $time, set_value('show-time'));
                ?>

            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <button type="submit" name="action" value="finish" class="btn btn-primary w-100">Submit</button>
        </div>
    </div>


<?php echo form_close(); ?>
