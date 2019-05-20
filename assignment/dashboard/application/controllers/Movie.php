<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends FS_Controller
{
	// This is the folder path all text will upload to.
	var $text_folder = 'uploads/articles/text';

	// This is the folder path all text will upload to.
	var $images_folder = 'uploads/articles/images';

	// Load the necessary libraries
	function __construct()
	{
		parent::__construct();

		// load the libraries after the code has been set.
		$this->load->model('movie_model');
		$this->load->helper('file');
	}

	public function index()
	{
		$data = [
			'movies'	=> $this->movie_model->get_movies()
		];

		$this->build('movie/index', $data);
	}

	public function create($submit = FALSE)
	{
		// If submit is not FALSE, we'll try checking the form.
		if ($submit !== FALSE)
		{
			return $this->_do_create();
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$data = [
			'genre'	=> $this->movie_model->get_genres_array(),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build('movie/create', $data);
	}

	public function delete($slug = NULL)
	{
		// Check if the article exists, and if it does
		// assign it to a variable.
		if (!$movie = $this->movie_model->get_article($slug))
		{
			show_404();
		}

		// Start by deleting the files for this article.
		$path = "{$this->text_folder}/{$article['id']}.txt";
		if (file_exists($path)) unlink($path);

		// Delete the file and redirect.
		$this->article_model->delete_article($slug);

		redirect('article');
	}

	public function edit($slug = NULL, $submit = FALSE)
	{
		// Check if the article exists, and if it does
		// assign it to a variable.
		if (!$article = $this->article_model->get_article($slug))
		{
			show_404();
		}

		// Check that the form was sent, if so do another process.
		if ($submit !== FALSE)
		{
			return $this->_do_edit($article);
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$article['text'] = read_file("{$this->text_folder}/{$article['id']}.txt");
		$article['categories'] = $this->article_model->get_article_categories($article['id']);
		$article['image'] = $this->_get_image_path($article['id']);

		$data = [
			'article'		=> $article,
			'categories'	=> $this->article_model->get_categories_array(),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build('article/edit', $data);
	}

	// Process the creation form.
	private function _do_create()
	{
		// 1. Load the form_validation library.
		$this->load->library(['form_validation' => 'fv']);

		// 2. Set the validation rules.
		$this->fv->set_rules([
			[
				'field'	=> 'movie-title',
				'label'	=> 'Title',
				'rules' => 'required|min_length[5]'
			],
			[
				'field'	=> 'movie-description',
				'label'	=> 'Content',
				'rules' => 'required|min_length[50]'
			],
            [
				'field'	=> 'movie-runtime',
				'label'	=> 'Runtime',
				'rules' => 'required'
			],
            [
				'field'	=> 'movie-director',
				'label'	=> 'Director',
				'rules' => 'required'
			],
			[
				'field'	=> 'movie-image',
				'label' => 'Image',
				'rules' => 'file_required|file_size_max[2mb]|file_allowed_type[gif,png,jpg]'
			]
		]);

		// 3. If the validation failed, we'll reload.
		if ($this->fv->run() === FALSE)
		{
			return $this->create();
		}

		// 4. Get the inputs from the form.
		$title		= $this->input->post('movie-title');
        $runtime    = $this->input->post('movie-runtime');
		$description	= $this->input->post('movie-description');
        $director       =$this->input->post('movie-director');
		$genre = $this->input->post('movie-genre') ?: [];

		// 5. Try to insert the data in its tables, and get back the ID.
		$movie_id = $this->movie_model->create_movie($title, $genre, $runtime, $director);
		if ($movie_id === FALSE)
		{
			exit("Your movie could not be posted. Please go back and try again.");
		}

		// 6. If the folder path is missing, create it.
		$this->_build_dir($this->text_folder);
		if (!write_file("{$this->text_folder}/{$movie_id}.txt", $description))
		{
			// delete the record.
			exit("Your movie could not be posted. Please go back and try again.");
		}

		$this->_upload_image($movie_id);

		redirect('movie');
	}

	// Process for the edit form.
	private function _do_edit($article)
	{
		// 1. Load the form_validation library.
		$this->load->library(['form_validation' => 'fv']);

		// 2. Set the validation rules.
		$rules = [
			[
				'field'	=> 'article-title',
				'label'	=> 'Title',
				'rules' => 'required|min_length[5]'
			],
			[
				'field'	=> 'article-text',
				'label'	=> 'Content',
				'rules' => 'required|min_length[50]'
			]
		];

		// if a file was uploaded, we'll add the rules to the array.
		if ($_FILES['article-image']['name'] != '')
		{
			$rules[] = [
				'field'	=> 'article-image',
				'label'	=> 'Image',
				'rules' => 'file_size_max[2mb]|file_allowed_type[gif,jpg,png]'
			];
		}

		$this->fv->set_rules($rules);

		// 3. If the validation failed, we'll reload.
		if ($this->fv->run() === FALSE)
		{
			return $this->edit($article['id']);
		}

		// 4. Get the inputs from the form.
		$title		= $this->input->post('article-title');
		$text		= $this->input->post('article-text');
		$categories = $this->input->post('article-categories') ?: [];

		// 5. Check if anything has changed in the form.
		if ($article['title'] != $title)
		{
			// change the entry in the database.
			if (!$this->article_model->update_article($article['id'], $title))
			{
				exit("Your article could not be edited. Please go back and try again.");
			}
		}

		if (!$this->article_model->replace_categories($article['id'], $categories))
		{
			exit("Your article could not be edited. Please go back and try again.");
		}

		// 6. If the folder path is missing, create it.
		$this->_build_dir($this->text_folder);
		if (!write_file("{$this->text_folder}/{$article['id']}.txt", $text))
		{
			// delete the record.
			exit("Your article could not be posted. Please go back and try again.");
		}

		$this->_build_dir($this->images_folder);
		if ($_FILES['article-image']['name'] != '') $this->_upload_image($article['id']);
		redirect('article');
	}

	// Checks that the folder exists, creates it if not.
	private function _build_dir($dir)
	{
		// we don't need to do anything if the folder exists.
		if (file_exists($dir)) return;

		$segments = explode('/', $dir);
		$path = '';

		while (count($segments) > 0)
		{
			// array_shift -> removes the first element from $segments
			// and returns it as a string.
			$path .= array_shift($segments) . '/';
			if (!file_exists($path)) mkdir($path);
		}
	}

	// Uploads an image to a specific folder using the article id as name.
	private function _upload_image($name)
	{
		// Since we're using this function for the article edit page,
		// we also need to delete the existing files first.
		$files = glob("{$this->images_folder}/{$name}.*");
		foreach ($files as $file) unlink($file);

		// Create the images folder if it doesn't exist.
		$this->_build_dir($this->images_folder);

		// Set up the configuration for this file upload.
		$config['upload_path']			= $this->images_folder;
		$config['file_name']			= $name;
		$config['allowed_types']		= 'gif|jpg|png';
		$config['max_size']				= 2048;
		$config['file_ext_tolower']		= TRUE;

		// Load the upload library and set its configuration.
		$this->load->library('upload');
		$this->upload->initialize($config);

		// Check if the file has uploaded, and show an error if not.
		if (!$this->upload->do_upload('movie-image'))
		{
			exit($this->upload->display_errors());
		}
	}

	// Looks for an image with a particular ID and returns the path.
	private function _get_image_path($id, $to_array = FALSE)
	{
		// Use glob to get all the images matching this name.
		$files = glob("{$this->images_folder}/{$id}.*");
		if ($to_array) return $files;

		if (count($files) > 0) return $files[0];
		return '';
	}
}
