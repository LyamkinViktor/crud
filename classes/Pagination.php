<?php

class Pagination
{
    protected $db;
    protected $usersOnPages = 2;

    /**
     * Pagination constructor.
     *
     * assigns a $db database connection
     */
    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * @return float
     *
     * returns counts the number of pages
     */
    public function countPages()
    {
        $sql = 'SELECT COUNT(*) as count FROM users';
        $count = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC)[0]['count'];
        $pages = ceil($count / $this->usersOnPages);
        return $pages;
    }

    /**
     * @param int $page
     * @return array
     *
     * returns a list of users by the specified number (property $usersOnPages) per page
     */
    public function paginate(int $page)
    {
        $fromPage = ($page - 1) * 2;
        $sql = 'SELECT * FROM users ORDER BY login LIMIT ' . $fromPage . ', ' . $this->usersOnPages;

        /*
         $params = [
            'fromPage' => $fromPage,
            'usersOnPage' => $this->usersOnPages
        ];
        */

        $result = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}