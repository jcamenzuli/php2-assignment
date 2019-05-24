<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movies extends CI_Controller {

    var $text_folder = 'uploads/movies/text';
    var $images_folder = 'uploads/movies/images';

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

        //$movies = $this->movie_model->get_movies();
        //$movies =
        //$comingsoon =

        $data = [
            'movies'        => $this->movie_model->now_showing(),
            'comingsoon'    => $this->movie_model->coming_soon()
        ];

        $this->load->view('template/header');
        $this->load->view('template/navbar-index');
        $this->load->view('movies/index', $data);
        $this->load->view('template/footer');
	}

    public function view($slug = NULL)
	{
        $movie = $this->movie_model->get_movie($slug);

        $movie['description'] = read_file("{$this->text_folder}/{$movie['id']}.txt");
        $movie['image'] = $this->_get_image_path($movie['id']);

        $data = [
            'movie' => $movie
        ];

        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('movies/movie', $data);
        $this->load->view('template/footer');
	}

    public function bookings($slug = NULL)
    {
        $movie = $this->movie_model->get_movie($slug);

        $movie['description'] = read_file("{$this->text_folder}/{$movie['id']}.txt");
        $movie['image'] = $this->_get_image_path($movie['id']);

        $data = [
            'movie' => $movie
        ];



        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('movies/bookings', $data);
        $this->load->view('template/footer');
    }

    public function tickets($slug)
    {
        $this->load->view('template/header');
        $this->load->view('template/navbars');
        $this->load->view('movies/tickets', $data);
        $this->load->view('template/footer');
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
