<?php

class AdminModel extends CI_Model
{
    public $filePath;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('date');
    }

    function check($login, $password)
    {
        $this->db->where('login', $login);
        $this->db->where('password', md5($password));
        $query = $this->db->get('admin_user');

        return $query->num_rows();
    }

    function getAllUsers()
    {
        $allUsers = $this->db->get('admin_user');
        return $allUsers->result_array();
    }

    function addUsers($name, $login, $email, $password)
    {
        $datestring = "%Y-%m-%d  %h:%m:%s";
        $time = time();
        $data = array(
            'name' => $name,
            'login' => $login,
            'email' => $email,
            'password' => md5($password),
            'date_created' => mdate($datestring, $time),
            'date_updated' => mdate($datestring, $time)
        );

        $this->db->insert('admin_user', $data);
    }

    function deleteUsers($userId)
    {
        $this->db->delete('admin_user', array('entity_id' => $userId));
    }

    function addNewPortfolio($params)
    {
        $datestring = "%Y-%m-%d  %h:%m:%s";
        $time = time();

        $sending = array(
            'name' => $this->input->post('name'),
            'discription' => $this->input->post('discription'),
            'file_path' => 'images/portfolio/' . $params["upload_data"]["file_name"],
            'date_created' => mdate($datestring, $time),
            'date_updated' => mdate($datestring, $time)
        );

        $this->db->insert('portfolio', $sending);
    }

    function getAllPortfolios()
    {

        $allPortfolios = $this->db->get('portfolio');

        return $allPortfolios->result_array();
    }

    function deletePortfolio($portfolioId)
    {
        $this->db->delete('portfolio', array('entity_id' => $portfolioId));
    }

    function getPortfolioTolanding()
    {
        $this->db->select('title, content, date');

        $query = $this->db->get('portfolio');

        return $query->result_array();
    }

    function updateValueAdminData($table = null)
    {
        $datestring = "%Y-%m-%d  %h:%i:%s";
        $time = time();
        $where = array();
        $set = array('date_updated' => mdate($datestring, $time));
        foreach ($this->input->post() as $key => $post) {
            if ($key == "entity_id") {
                $where = array($key => $post);
            } else {
                if($key == "file_path") {

                }
                $set[$key] = $post;
            }
        }

        if(!empty($this->filePath)) {
            $set["file_path"] = $this->filePath;
        }

        if($this->db->update(empty($table) ? "admin_user" : $table, $set, $where)) {
            return $set;
        } else {
            return false;
        }
    }


}

?>