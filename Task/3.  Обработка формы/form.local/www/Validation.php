<?php

class Validation
{
    private $data = array();
    private $end_date;

    function __construct($params)
    {
        foreach ($params as $item =>$key) {
            $this->data[$item] .= $key;
        }
        $this->validate();
    }

    protected function _redirect($param)
    {
        header('Location: ' . 'http://www.form.local/?error=' . $param);
    }

    protected function _prepareRow()
    {
        $this->data['date'] = date('Y-m-d', strtotime($_POST['date']));
        $this->end_date = new DateTime($_POST['date']);
        $this->data['phone'] = preg_replace('[\s|-]', '', $this->data['phone']);
        $this->data['end_date'] = date('Y-m-d', $this->end_date->getTimestamp() + 15 * 24 * 60 * 60);

        print_r($this->data);
    }

    protected function validate()
    {
        if (preg_match('/\w+\s\w+/', $this->data['name'])) {
            if (preg_match('/^\+\\((\d{3,5})\)\s(\d{3}-\d{2}-\d{2})$/', $this->data['phone'])) {

                $this->_prepareRow();
            } else {

                $this->_redirect('phone');
            }
        } else {
            $this->_redirect('name');
        }
    }


}



