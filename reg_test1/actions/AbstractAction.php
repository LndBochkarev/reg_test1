<?php

abstract class AbstractAction {

    protected $registry;
    protected $model;
    protected $viewData;
    protected $userId;
    
    /**
     * Prevents loading template second time
     *
     * @var boolean
     */
    private $isViewLoaded;

    public function __construct($registry) {
        $this->registry = $registry;
        $this->model = new Model($registry);
        $this->viewData = $registry['view_data'];

        $this->userId = $this->getUserId();
        $isViewLoaded = false;
        
        /**
         * @todo add request counter for specified ip
         */
    }
    
    abstract public function execute();

    /**
     * Basic authorization
     * 
     * @return mixed
     */
    private function getUserId() {
        session_start();

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $userId = filter_var($userId, FILTER_VALIDATE_INT);
            
            if ($userId) {
                return $userId;
            }
            return false;
        }
    }

     /**
     * Prevents loading template second time
     */
    protected function loadView($fileName) {
        if (!$this->isViewLoaded) {
            require_once $this->registry['templates_path'] . $fileName;
        }
    }

}
