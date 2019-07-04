<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends FS_Controller
{
	// This is the folder path all text will upload to.
	var $text_folder = '../uploads/movies/text';

	// This is the folder path all text will upload to.
	var $images_folder = '../uploads/movies/images';

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
		//	'movies'	=> $this->movie_model->get_movies()
            'movies'	=> $this->movie_model->get_movies(),
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
		// Check if the movie exists, and if it does
		// assign it to a variable.
		if (!$movie = $this->movie_model->get_movie($slug))
		{
			show_404();
		}

		// Start by deleting the files for this movie.
		$path = "{$this->text_folder}/{$movie['id']}.txt";
		if (file_exists($path)) unlink($path);

		// Delete the file and redirect.
		$this->movie_model->delete_movie($slug);

		redirect('movie');
	}

	public function edit($slug = NULL, $submit = FALSE)
	{
		// Check if the movie exists, and if it does
		// assign it to a variable.
		if (!($movie = $this->movie_model->get_movie($slug)))
		{
			show_404();
		}

		// Check that the form was sent, if so do another process.
		if ($submit !== FALSE)
		{
			return $this->_do_edit($movie);
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$movie['description'] = read_file("{$this->text_folder}/{$movie['id']}.txt");
		$movie['genre'] = $this->movie_model->get_movie_genre($movie['id']);
		$movie['image'] = $this->_get_image_path($movie['id']);

		$data = [
			'movie'		     => $movie,
			'genre'	         => $this->movie_model->get_genres_array(),
			'platform'		 => strtolower($this->ua->platform())
		];

		$this->build('movie/edit', $data);
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
				'field'	=> 'movie-video',
				'label'	=> 'Video',
				'rules' => 'required'
			],
            [
				'field'	=> 'movie-releasedate',
				'label'	=> 'Release Date',
				'rules' => 'required'
			],
            [
				'field'	=> 'movie-lastdate',
				'label'	=> 'Last Date',
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
        $video          =$this->input->post('movie-video');
        $release          =$this->input->post('movie-releasedate');
        $last          =$this->input->post('movie-lastdate');
		$genre          =$this->input->post('movie-genres') ?: [];

        $release = str_replace('/', '-', $release);
        $release = strtotime($release);

        $last   = str_replace('/', '-', $last);
        $last   = strtotime($last);
        
		// 5. Try to insert the data in its tables, and get back the ID.
		$movie_id = $this->movie_model->create_movie($title, $genre, $runtime, $director, $video, $release, $last);
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
	private function _do_edit($movie)
	{
		// 1. Load the form_validation library.
		$this->load->library(['form_validation' => 'fv']);

		// 2. Set the validation rules.
		$rules = [
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
				'field'	=> 'movie-releasedate',
				'label'	=> 'Release Date',
				'rules' => 'required'
			],
            [
				'field'	=> 'movie-lastdate',
				'label'	=> 'Last Date',
				'rules' => 'required'
			],
            [
				'field'	=> 'movie-video',
				'label'	=> 'Video',
				'rules' => 'required'
			]
		];

		// if a file was uploaded, we'll add the rules to the array.
		if ($_FILES['movie-image']['name'] != '')
		{
			$rules[] = [
				'field'	=> 'movie-image',
				'label'	=> 'Image',
				'rules' => 'file_size_max[2mb]|file_allowed_type[gif,jpg,png]'
			];
		}

		$this->fv->set_rules($rules);

		// 3. If the validation failed, we'll reload.
		if ($this->fv->run() === FALSE)
		{
			return $this->edit($movie['slug']);
		}

		// 4. Get the inputs from the form.
		$title		         = $this->input->post('movie-title');
		$description		 = $this->input->post('movie-description');
		$genre               = $this->input->post('movie-genre') ?: [];

		// 5. Check if anything has changed in the form.
		if ($movie['title'] != $title)
		{
			// change the entry in the database.
			if (!$this->movie_model->update_movie($movie['id'], $title))
			{
				exit("This movie could not be edited. Please go back and try again.");
			}
		}

		if (!$this->movie_model->replace_genres($movie['id'], $genre))
		{
			exit("This movie could not be edited. Please go back and try again.");
		}

		// 6. If the folder path is missing, create it.
		$this->_build_dir($this->text_folder);
		if (!write_file("{$this->text_folder}/{$movie['id']}.txt", $text))
		{
			// delete the record.
			exit("This movie could not be posted. Please go back and try again.");
		}

		$this->_build_dir($this->images_folder);
		if ($_FILES['movie-image']['name'] != '') $this->_upload_image($movie['id']);
		redirect('movie');
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

	// Uploads an image to a specific folder using the movie id as name.
	private function _upload_image($name)
	{
		// Since we're using this function for the movie edit page,
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

    public function times($slug = NULL, $submit = FALSE)
	{
		if (!$movie = $this->movie_model->get_movie($slug)){
			show_404();
		}

		if ($submit !== FALSE)
		{
			return $this->_do_time($movie);
		}

		$data = [
			'movie'			=> $movie,
			'theatre'		=> $this->movie_model->get_theatre_array(),
		];

		$this->load->library(['user_agent' => 'ua']);

		$this->build('movie/times', $data);
	}

    private function _do_time($movie)
	{
		$start			= $this->input->post('releasedate');
		$end			= $this->input->post('lastdate');
		$times			= explode(',', $this->input->post('show-time'));
		$theatre		= $this->input->post('theatre');

		// 4. Get the inputs from the form.
		$days = ((strtotime($end) - strtotime($start)) / 60 / 60 / 24) + 1;
		$i = 0;
		$timestamps = [];

		while ($i < $days)
		{
			foreach ($times as $time) $timestamps[] = strtotime("{$start} {$time}" . "+{$i} days");
			$i++;
		}

		if (!$this->movie_model->insert_Date_Time($movie['movie_id'], $timestamps, $theatre))
		{
			exit("The date cannot be added");
		}

		redirect('movie/index');
	}
}
