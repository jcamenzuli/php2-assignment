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
    function __construct()
    {
        parent::__construct();

        $this->load->model('Movie_model');
        $this->load->model('Screening_model');
        $this->load->model('Booking_model');

    }
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

    public function bookings($slug = NULL, $submit = FALSE)
    {
        $movie = $this->movie_model->get_movie($slug);

        $movie['description'] = read_file("{$this->text_folder}/{$movie['id']}.txt");
        $movie['image'] = $this->_get_image_path($movie['id']);

        if($submit != FALSE)
        {
            return $this->seating();
        }
        $data = [
            'movie' => $movie,
            'screenings'    =>$this->movie_model->get_movie_screenings($slug)
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

    public function seating()
    {
        $screening = $this->input->post("screen-time");

        redirect("movies/seats/".$screening);
    }

    // Builds the page to select seats
    public function seats($id = NULL, $submit = FALSE)
    {
        if(!$screening = $this->Screening_model->get_screening($id))
        {
            show_404();
        }

        if($submit != FALSE)
        {
            return $this->add_seats();
        }

        $data =[
            'screening' => $screening
        ];

        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('movies/seats', $data);
        $this->load->view('template/footer');
    }

    public function add_seats()
    {
        $this->load->library(['form_validation' => 'fv']);

        $this->fv->set_rules([
            [
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|valid_email'
            ]
        ]);

        //validation
        if($this->fv->run() === FALSE)
        {
            return $this->create();
        }

        // Gets the input from the form
        $screening = $this->input->post('screening');
        $seats     = $this->input->post('seats');
        $email     = $this->input->post('email');

        $booking_id = $this->Booking_model->create_booking($screening,$seats,$email);
        if($booking_id === FALSE)
        {
            exit("Booking was not created");
        }

        redirect('/');
    }
}
