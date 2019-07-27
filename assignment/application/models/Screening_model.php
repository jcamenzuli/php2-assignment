<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Screening_model extends CI_Model
{
    // Retrieves all of the screenings in the database.
        public function get_screenings()
        {
            return $this->db->select('*')
                            ->join('tbl_movies b', 'b.id = a.movies_id')
                            ->join('tbl_theatre c', 'c.id = a.theatre_id')
                            ->where('a.movie_time >', time()) // Only shows entries that are not before current time.
                            ->get('tbl_movie_time a')
                            ->result_array();
        }

        // Retrieves the screenings of a particular film
        public function get_movie_screenings($slug)
        {
            // Retrieves the film we are looking for from the slug and finds it's ID
            $movie = $this->movie_model->get_movie($slug);
            $id = $movie['id'];

            return $this->db->select('*')
                            ->join('tbl_movies b', 'b.id = a.movies_id')
                            ->join('tbl_theatre c', 'c.id = a.theatre_id')
                            ->order_by('a.movie_time', 'ASC')
                            ->get_where('tbl_movie_time a', ['a.movies_id' => $id, 'a.movie_time >' => time()])
                            ->result_array();
        }

        public function get_screening($id)
        {
            return $this->db->select('*')
                            ->get_where('tbl_movie_time', ['movie_time_id' => $id])
                            ->row_array();
        }

}
