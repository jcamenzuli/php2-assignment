<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Movie_model extends CI_Model
{
    // Creates an article and assigns its categories.
    public function create_movie($title, $genre, $runtime, $director, $video, $release)
    {
        // Create a slug from the title, and make sure we have categories.
        $slug = url_title($title, 'dash', TRUE);
        if ($genre == NULL) $genre = [];

        // Transactions will make queries temporary unless committed.
        // Queries will not work between start and complete.
        $this->db->trans_start();

            // Start with inserting the article.
            $movies = [
                'title'         => $title,
                'runtime'       => $runtime,
                'director'      => $director,
                'video'         => $video,
                'releasedate'   => $release,
                'slug'           => $slug
            ];
            $this->db->insert('tbl_movies', $movies);
            $insert_id = $this->db->insert_id();

            // Multiple categories can be chosen, we'll need to loop.
            if (count($genre) > 0)
            {
                $inserts = [];
                foreach ($genre as $gen)
                {
                    $inserts[] = [
                        'movies_id'    => $insert_id,
                        'genre_id'      => $gen
                    ];
                }
                $this->db->insert_batch('tbl_movie_genre', $inserts);
            }

        // The querying is done.
        $this->db->trans_complete();

        // If the query was not successful, we won't register
        // anything on the database.
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return $insert_id;
        }
    }

    // Deletes an article from the database.
    public function delete_movie($slug)
    {
        $this->db->delete('tbl_movies', ['slug' => $slug]);
    }

    // Retrieves a single article from the database.
    public function get_movie($slug)
    {
        return $this->db
                    ->get_where('tbl_movies', ['slug' => $slug])
                    ->row_array();

    }

    // Retrieves articles from the database.
    public function get_movies()
    {
        return $this->db->order_by('title')
                        ->get('tbl_movies')
                        ->result_array();
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

    // Retrieves the categories for an article
    public function get_movie_genre($movie_id)
    {
        $results = $this->db->select('genre_id')
                            ->get_where('tbl_movie_genre', ['movies_id' => $movie_id])
                            ->result_array();

        $ids = [];
        foreach ($results as $row) $ids[] = $row['genre_id'];

        return $ids;
    }

    // Retrieve the list of categories as an array.
    public function get_genres()
    {
        return $this->db->get('tbl_genre')->result_array();
    }

    // Retrieve a list of categories as an [id = name] array.
    public function get_genres_array()
    {
        // use a defined function to get the rows we need.
        $results = $this->get_genres();
        $genres = [];

        // fill in the blank array using a foreach loop.
        foreach ($results as $row) $genres[$row['genre_id']] = $row['genre_title'];
        return $genres;
    }

    // Replaces the categories for an article.
    public function replace_genres($id, $genres = [])
    {
        $this->db->trans_start();

            $this->db->delete('tbl_movie_genre', ['movies_id' => $id]);

            // Multiple categories can be chosen, we'll need to loop.
            if (count($genres) > 0)
            {
                $inserts = [];
                foreach ($genres as $gen)
                {
                    $inserts[] = [
                        'movies_id'    => $id,
                        'genre_id'   => $gen
                    ];
                }
                $this->db->insert_batch('tbl_movie_genre', $inserts);
            }

        $this->db->trans_complete();

        // If the query was not successful, we won't register
        // anything on the database.
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    // Updates the article title in the database.
    public function update_movie($id, $title)
    {
        // Since the title has changed, the slug will too.
        $slug = url_title($title, 'dash', TRUE);

        $this->db->where('id', $id)
                ->update('tbl_movies', [
                    'title' => $title,
                    'slug'  => $slug
                ]);

        // to check that this query worked, we'll check the affected rows.
        return $this->db->affected_rows() == 1;
    }
}
