<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Movie_model extends CI_Model
{
    public function get_movies()
    {
        return $this->db
                    ->select("a.*, GROUP_CONCAT(d.genre_title SEPARATOR ', ') AS movie_genre")
                    ->join('tbl_movie_genre c', 'a.id = c.movies_id', 'left')
                    ->join('tbl_genre d', 'd.genre_id = c.genre_id', 'left')
                    ->group_by('a.id')
                    ->order_by('a.title')
                    ->get('tbl_movies a')
                    ->result_array();
    }

    public function get_movie($slug)
    {
        return $this->db
                    ->select("a.*, GROUP_CONCAT(d.genre_title SEPARATOR ', ') AS movie_genre")
                    ->join('tbl_movie_genre c', 'a.id = c.movies_id', 'left')
                    ->join('tbl_genre d', 'd.genre_id = c.genre_id', 'left')
                    ->group_by('a.id')
                    ->get_where('tbl_movies a', ['slug' => $slug])
                    ->row_array();
    }

    public function now_showing()
    {
        return $this->db->select('*')
                        ->where('releasedate <', time())
                        ->order_by('title')
                        ->get('tbl_movies')
                        ->result_array();
    }

    public function coming_soon()
    {
        return $this->db->select('*')
                        ->where('releasedate >', time())
                        ->order_by('title')
                        ->get('tbl_movies')
                        ->result_array();
    }
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
                        ->join('tbl_theatre c', 'c.theatre_id = a.theatre_id')
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
