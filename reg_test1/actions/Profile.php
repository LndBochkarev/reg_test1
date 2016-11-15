<?php

class Profile extends AbstractAction {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function execute() {

        if ($this->userId) {
            $uqh = $this->model->getUserQueryHandler();
            
            try {
                $data = $uqh->getUserById($this->userId);
                
                $this->viewData['user_data'] = $data;
                $this->loadView('profile.php');
            } catch (Exception $ex) {
                echo 'wat?';
            }
        } else {
            header('location: Login');
        }
    }

}
