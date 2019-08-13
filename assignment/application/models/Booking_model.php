<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    // Creates booking
    public function create_booking($screening,$seats,$email)
    {
        $this->db->trans_start();

        // Choosing the seats
        if(count($seats) > 0)
        {
            $bookings = [];
            foreach($seats as $seat)
            {
                $bookings[] = [
                    'time_id'      => $screening,
                    'seat_no'      => $seat,
                    'email'        => $email
                ];
            }

            $this->db->insert_batch('tbl_booking_details', $bookings);
            $insert_id = $this->db->insert_id();
        }

        $this->db->trans_complete();

        // If there are no errors, it can commit transaction
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            //Last id, return id
            return $insert_id;
        }
    }
}
