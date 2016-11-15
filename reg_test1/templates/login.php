<?php
global $registry;
$data = $registry['view_data'];
$ildata = $data['incorrect_login_data'];
?>


<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="stylesheet" type="text/css" href="css/form.css"/>
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

                <?php if (isset($data['error_msg'])) { ?> 
                    <div id="error_msg"><?php echo $data['error_msg']; ?></div>
                <?php } ?>

                <form action="SignIn" method="post">

                    <div class="regin_holder">
                        <label for="login">Login:</label>
                        <input type="text" name="email" placeholder="Your email">

                        <?php if (isset($ildata['email_msg'])) { ?> 
                            <div class='form_hint'><?php echo $ildata['email_msg']; ?></div>
                        <?php } ?>
                    </div>

                    <div class="regin_holder">
                        <label for="password">Password:</label>
                        <input class="password" type="password" name="password">

                        <?php if (isset($ildata['password_msg'])) { ?> 
                            <div class='form_hint'><?php echo $ildata['password_msg']; ?></div>
                        <?php } ?>
                    </div>

                    <input class="subutton" type="submit" value="Sign in" name="sign_in">

                </form>

            </div>

        </div>
        
        <footer>          
        </footer>

    </body>
</html>