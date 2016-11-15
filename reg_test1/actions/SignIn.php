<?php

class SignIn extends AbstractAction {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function execute() {

        //check if user is already logged in
        if ($this->userId) {
            $this->redirectToProfile();
            
        } else {
            //validates login data
            $udh = $this->model->getUserDataHandler();
            $loginData = $udh->validateLoginData();

            if ($loginData['is_valid']) {

                $uqh = $this->model->getUserQueryHandler();
                
                try {
                    $dbData = $uqh->getPasswordByEmail($loginData['email']);
                    
                    //compares the entered password with the stored
                    if (password_verify($loginData['password'], $dbData['password'])) {
                        
                        session_start();
                        
                        //authorises the user
                        $_SESSION['user_id'] = $dbData['id'];
                        $this->redirectToProfile();
                    } else {
                        echo 'here false';
                    }                       
                    
                } catch (Exception $ex) {
                    $this->viewData['error_msg'] = $ex;
                }
                
            } else {
                $this->viewData['incorrect_login_data'] = $loginData;
            }
            
            $this->loadView('login.php');
        }     
    }
    
    private function redirectToProfile() {
        header('Location Profile');
    }

}
