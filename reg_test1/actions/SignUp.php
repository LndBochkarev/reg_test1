<?php

class SignUp extends AbstractAction {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function execute() {
        //https?
        // save valid data in cookies*

        if ($this->userId) {

            header('location: Profile');
        } else {
            
            //prevents repeated registrations from the same ip
            //in time less than specified in config.php file
            $ihm = $this->model->getIpHistoryManager();
            $ihm->isNeedToWait();

            //validating data and preparing to inserting to db
            $udh = $this->model->getUserDataHandler();
            $userData = $udh->prepareUserData();


            //inserting data
            if ($userData['is_valid']) {
                try {
                    $uqh = $this->model->getUserQueryHandler();
                    $userId = $uqh->insertUser($userData);

                    //saving client ip and time of registration
                    $ihm = $this->model->getIpHistoryManager();
                    
                    try {
                        $ihm->successfulRegFrom($clientIP);
                    } catch (Exception $ex) {
                        //log error
                    }
                    header('location: Login');
                    
                } catch (Exception $ex) {
                    $this->viewData['error_msg'] = "$ex";
                }
            } else {
                $this->viewData['incorrect_reg_data'] = $userData;
            }
            $this->loadView('registration.php');
        }
    }

}
