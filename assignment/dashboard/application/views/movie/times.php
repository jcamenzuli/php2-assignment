<?php echo form_open_multipart("movie/times/{$movie['slug']}/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">

                <script>
                    $( function() {
                    $( "#datepicker" ).datepicker();
                    } );
                </script>

                <?php echo form_error('show-time'); ?>
                <?php echo custom_form_input('Time', [
                    'name'          => 'show-time',
                    'class'         => 'form-control',
                    'placeholder'   => 'Showing time',
                    'value'         => set_value('show-time')
                ]); ?>

                <?php echo form_dropdown('cinema', $cinema, set_value('cinema'));
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
