<?php echo form_open_multipart('movie/create/submit', ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('movie-title'); ?>
                <?php echo custom_form_input('Title', [
                    'name'          => 'movie-title',
                    'class'         => 'form-control',
                    'placeholder'   => 'Movie Title',
                    'value'         => set_value('movie-title')
                ]); ?>

                <?php echo form_error('movie-description'); ?>
                <?php echo form_textarea([
                    'rows'          => 8,
                    'cols'          => 80,
                    'name'          => 'movie-description',
                    'placeholder'   => 'Movie description',
                    'class'         => 'form-control mb-3',
                    'value'         => set_value('movie-description')
                ]); ?>

                <?php echo form_error('movie-image'); ?>
                <?php echo custom_form_upload('Choose Image', [
                    'type'          => 'file',
                    'name'          => 'movie-image',
                    'accept'        => 'image/*'
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <?php echo form_multiselect(
                    'movie-genres[]',
                    $categories,
                    set_value('movie-genres'),
                    [
                        'class' => 'custom-select form-control',
                        'size'  => count($genres)
                    ]
                ); ?>

                <small class="d-block mt-1 mb-3"><?php echo ($platform == 'mac os x') ? 'Cmd' : 'Ctrl'; ?>-click to select multiple options.</small>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
