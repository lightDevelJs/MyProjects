<?php
class Edit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

    }
    public function index()
    {

    }

}