<?php

class Logout extends AbstractAction {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function execute() {

        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }
        header('location: index');
    }

}
