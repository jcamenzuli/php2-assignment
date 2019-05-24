<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Screening_model extends CI_Model
{
    public function create_screening($time, $movie, $theatre)
    {
        $this->db->trans_start();

        $screenings = [
            'time'          =>$time,
            'movie_id'      =>$movie,
            'theatre_id'    =>$theatre
        ];

    }
}
