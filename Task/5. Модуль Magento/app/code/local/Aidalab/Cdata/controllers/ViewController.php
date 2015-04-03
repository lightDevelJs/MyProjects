<?php

class Aidalab_Cdata_ViewController extends Mage_Core_Controller_Front_Action
{
    protected $data = array();
    protected $obtainedToken;

    public function indexAction()
    {
        $this->obtainedToken = $this->getRequest()->getParam("token");
        $savedToken = Mage::getStoreConfig('aidalabcdatasystem/customers/token');
        $costumerId = $this->getRequest()->getParam("id");

        $customer_data = Mage::getModel('customer/customer')->load($costumerId);

        if ($this->obtainedToken == $savedToken && $customer_data->getFirstname()) {
            $this->data['firstname'] = $customer_data->getFirstname();
            $this->data['lastname'] = $customer_data->getLastname();
            $this->data['login'] = $customer_data->getEmail();
            print_r(Mage::helper('core')->jsonEncode($this->data)) ;
        } else {
            print_r('User not found or incorrect token');
        }

    }
   
}