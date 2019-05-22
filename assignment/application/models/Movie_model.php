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
}
