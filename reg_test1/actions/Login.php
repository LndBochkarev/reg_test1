<?php

class Login extends AbstractAction {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function execute() {

        if ($this->userId) {
            header('location: Profile');
        }

        $this->loadView('login.php');
    }

}
