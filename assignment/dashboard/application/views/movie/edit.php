<?php echo form_open_multipart("movie/edit/{$movie['slug']}/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('movie-title'); ?>
                <?php echo custom_form_input('Title', [
                    'name'          => 'movie-title',
                    'class'         => 'form-control',
                    'placeholder'   => 'Movie Title',
                    'value'         => $movie['title'] ?: set_value('movie-title')
                ]); ?>

                <?php echo form_error('movie-description'); ?>
                <?php echo form_textarea([
                    'rows'          => 8,
                    'cols'          => 80,
                    'name'          => 'movie-description',
                    'placeholder'   => 'Enter description of the movie',
                    'class'         => 'form-control mb-3',
                    'value'         => $movie['description'] ?: set_value('movie-description')
                ]); ?>

                <?php echo form_error('movie-runtime'); ?>
                <?php echo custom_form_input('Runtime', [
                    'name'          => 'movie-runtime',
                    'class'         => 'form-control',
                    'placeholder'   => 'Movie Runtime',
                    'value'         => $movie['runtime'] ?: set_value('movie-runtime')
                ]); ?>

                <?php echo form_error('movie-director'); ?>
                <?php echo custom_form_input('Director', [
                    'name'          => 'movie-director',
                    'class'         => 'form-control',
                    'placeholder'   => 'Movie Director',
                    'value'         => $movie['director'] ?: set_value('movie-director')
                ]); ?>

                <?php echo form_error('movie-video'); ?>
                <?php echo custom_form_input('Video', [
                    'name'          => 'movie-video',
                    'class'         => 'form-control',
                    'placeholder'   => 'Movie Trailer',
                    'value'         => $movie['video'] ?: set_value('movie-video')
                ]); ?>

                <img src="http://assignment.local/uploads/movies/images/<?php echo $movie['image']; ?>" alt="" class="d-block w-100 mb-3">

                <?php echo form_error('movie-image'); ?>
                <?php echo custom_form_upload('Choose Image', [
                    'type'          => 'file',
                    'name'          => 'movie-image',
                    'accept'        => 'image/*'
                ]); ?>
                <small>Upload a new image to replace the current one.</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
        <div class="card">
            <div class="card-body">
                <?php echo form_multiselect(
                    'movie-genre[]',
                    $genre,
                    $movie['genre'] ?: set_value('movie-genre'),
                    [
                        'class' => 'custom-select form-control',
                        'size'  => count($genre)
                    ]
                ); ?>

                <small class="d-block mt-1 mb-3"><?php echo ($platform == 'mac os x') ? 'Cmd' : 'Ctrl'; ?>-click to select multiple options.</small>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
