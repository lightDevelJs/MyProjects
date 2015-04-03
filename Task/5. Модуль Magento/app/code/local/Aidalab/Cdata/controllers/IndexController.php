<?php

class Aidalab_Cdata_IndexController extends Mage_Core_Controller_Front_Action
{
    protected $obtainedToken;

    public function indexAction()
    {
        $this->obtainedToken = $this->getRequest()->getParam("token");
        $savedToken = Mage::getStoreConfig('aidalabcdatasystem/customers/token');

        $users = Mage::getModel('customer/customer')->getCollection()
            ->addAttributeToSelect('firstname')
            ->addAttributeToSelect('lastname');


        if ($this->obtainedToken == $savedToken) {
            $temporary = array();
            $flag = 1;
            foreach ($users as $user) {
                $temporary[$flag] .= $user->getFirstname();
                $temporary[$flag] .= ' ' . $user->getLastname();
                $flag++;
            }
            echo Mage::helper('core')->jsonEncode($temporary);
        }
    }
}