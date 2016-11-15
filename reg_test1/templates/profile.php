<?php
global $registry;
$viewData = $registry['view_data'];
$data = $viewData['user_data'];
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <script type="text/javascript" src="jquery-3.1.1.js"></script>

    </head>
    <body>
        <div id='header'>

            <a href="cat">
                <div class="hbutton">Back</div>
            </a>

            <?php if (isset($_SESSION['user_id'])) { ?> 
                <a href="Logout">
                    <div class="hbutton">Logout</div>
                </a>
            <?php } ?>

        </div>

        <div id='content'>
            <div id="center">

                Profile
                <?php
                if ($data) {
                    foreach ($data as $key => $value) {
                        echo '<br>' . $key . ': ' . $value;
                    }
                }
                ?>

            </div>
        </div>
        
        <footer>          
        </footer>
        
    </body>
</html>