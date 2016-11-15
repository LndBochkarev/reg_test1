<?php
require_once 'config.php';
require_once $registry['site_root'] . 'model/Model.php';
require_once $registry['site_root'] . 'actions/AbstractAction.php';
require_once $registry['site_root'] . 'model/AbstractQueryHandler.php';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

if (!$action) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

    if (!$action) {
        $action = 'index';
    }
}

//basic request routing
$actionPath = $registry['site_root'] . 'actions/' . $action . '.php';

if (file_exists($actionPath)) {
    require_once $actionPath;

    $actionObj = new $action($registry);
    $actionObj->execute();
} else {
    session_start();
    ?>

    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="css/main.css"/>        
            <script type="text/javascript" src="jquery-3.1.1.js"></script>

        </head>
        <body>

            <div id='header'>

                <?php if (isset($_SESSION['user_id'])) { ?> 
                    <a href="logout">
                        <div class="hbutton">Logout</div>
                    </a>
                <?php } ?>            

            </div>

            <div id='content'>
                <div id="center">

                    <a class="button1" href="Registration">Registration</a>
                    <a class="button1" href="Login">Login</a>
                    
                </div>

            </div>

            <footer>
            </footer>
        </body>
    </html>

<?php } ?>