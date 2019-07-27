<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Screening_model extends CI_Model
{
    public function create_screening($time, $movie, $theatre)
    {
        $this->db->trans_start();

        $screenings = [
            'movies_id'      =>$movie,
            'movie_time'     =>$time,
            'theatre_id'     =>$theatre
        ];
        // 3. Gives the instructions for the transaction.
        $this->db->insert('tbl_movie_time', $screenings);
        $insert_id = $this->db->insert_id();

        // 4. End of transaction
        $this->db->trans_complete();

        // 5. If there are no errors, we can commit the transaction.
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $insert_id;
        }
    }
}
