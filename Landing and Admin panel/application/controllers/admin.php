<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('date');

    }

    public function index()
    {

        $this->load->view('landpage_view');
    }

    public function landpage()
    {
        $this->load->view('landpage_view');
    }

    public function users()
    {
        $users = $this->AdminModel->getAllUsers();
        $this->load->view('users_view', array('users' => $users));
    }

    public function portfolio_list()
    {
        $this->getPortfolios();

    }

    public function authentification()
    {
        $this->load->view('authentification_view');
    }

    public function portfolio_view()
    {

        $this->load->view('portfolio-view_view');
    }

    public function notification()
    {
        $this->load->view('notification_view');
    }

    public function login()
    {
        if ($this->AdminModel->check($this->input->post('login'), $this->input->post('password'))) {
            $this->session->set_userdata('login', $this->input->post('login'));

        }
        $this->_routing('admin_view', 'authentification_view.php', array("error" => 'Login or password is incorrect!'));
    }

    private function _routing($ifTrue, $ifFalse, $data = array())
    {
        if (!$this->session->userdata('login')) {
            $this->load->view($ifFalse, $data);
        } else {
            $this->load->view($ifTrue);
        }
    }

    public function logout()
    {
        $this->session->set_userdata("login", null);
        $this->_routing('admin_view', 'authentification_view');
    }

    public function addNewUser()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('login', 'Login', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[12]');

        if ($this->form_validation->run() == FALSE) {
            $this->users();

        } else {
            $this->AdminModel->addUsers($this->input->post('name'), $this->input->post('login'), $this->input->post('email'), $this->input->post('password'));
            $this->users();
        }
    }

    public function deleteSelectedUser()
    {
        $userId = $this->input->post('radio');
        $this->AdminModel->deleteUsers($userId);
        $this->users();
    }

    public function addNewPortfolio()
    {
        $this->do_upload();
        $this->getPortfolios();
    }

    public function deleteSelectedPortfolio()
{
    $portfolioId = $this->input->post('radio');
    $this->AdminModel->deletePortfolio($portfolioId);
    $this->getPortfolios();
}

    private function do_upload($withoutAdd = false)
    {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('discription', 'Discription', 'required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('userfile', 'Userfile', 'required');

        $config['upload_path'] = 'images/portfolio';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        $config['file_name'] = 'decision_ua_' . substr(now(), 0, -2);


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload() && $this->form_validation->run() == FALSE) {
            $error = array('error' => $this->upload->display_errors()); //ДОБАВИТЬ переменную
        } else {
            $data = array('upload_data' => $this->upload->data());
            if(!$withoutAdd) {
                $this->AdminModel->addNewPortfolio($data);///Sendig New Portfolio files params
            }
            return "images/portfolio/".$data["upload_data"]["file_name"];
        }
    }

    private function getPortfolios()
    {
        $portfolios = $this->AdminModel->getAllPortfolios();

        $this->load->view('portfolio-list_view', array('portfolios' => $portfolios));
    }

    public function updateValue()
    {
        $result = $this->AdminModel->updateValueAdminData();
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(array("error" => "can`t update"));
        }
    }

    public function updatePortfolio()
    {
        if(!empty($_FILES)) {
            $this->AdminModel->filePath = $this->do_upload(true);
        }

        $result = $this->AdminModel->updateValueAdminData("portfolio");
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(array("error" => "can`t update"));
        }
    }

}
