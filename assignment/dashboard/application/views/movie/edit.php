<?php echo form_open_multipart("article/edit/{$article['slug']}/submit", ['class' => 'row content']); ?>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <?php echo form_error('article-title'); ?>
                <?php echo custom_form_input('Title', [
                    'name'          => 'article-title',
                    'class'         => 'form-control',
                    'placeholder'   => 'Article Title',
                    'value'         => $article['title'] ?: set_value('article-title')
                ]); ?>

                <?php echo form_error('article-text'); ?>
                <?php echo form_textarea([
                    'rows'          => 8,
                    'cols'          => 80,
                    'name'          => 'article-text',
                    'placeholder'   => 'This is the start of your next work!',
                    'class'         => 'form-control mb-3',
                    'value'         => $article['text'] ?: set_value('article-text')
                ]); ?>

                <img src="<?php echo base_url($article['image']); ?>" alt="" class="d-block w-100 mb-3">

                <?php echo form_error('article-image'); ?>
                <?php echo custom_form_upload('Choose Image', [
                    'type'          => 'file',
                    'name'          => 'article-image',
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
                    'article-categories[]',
                    $categories,
                    $article['categories'] ?: set_value('article-categories'),
                    [
                        'class' => 'custom-select form-control',
                        'size'  => count($categories)
                    ]
                ); ?>

                <small class="d-block mt-1 mb-3"><?php echo ($platform == 'mac os x') ? 'Cmd' : 'Ctrl'; ?>-click to select multiple options.</small>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>
