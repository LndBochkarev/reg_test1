<?php
global $registry;
$data = $registry['view_data'];
$irdata = $data['incorrect_reg_data'];
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <link rel="stylesheet" type="text/css" href="css/form.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/general.js"></script>

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

                <form id="registration_form" action="SignUp" method="POST">  

                    <div class="regin_holder_2c" id="first_last_holder">
                        <div>
                            <label for="first_name">First name:</label>
                            <input id="first_name" type="text" name="first_name" required>

                            <?php if (isset($irdata['first_name_msg'])) { ?> 
                                <div class='form_hint'><?php echo $irdata['first_name_msg']; ?></div>
                            <?php } ?>
                        </div>
                        <div class="second">
                            <label for="last_name">Last name:</label>
                            <input id="last_name" type="text" name="last_name" required>

                            <?php if (isset($irdata['last_name_msg'])) { ?> 
                                <div class='form_hint'><?php echo $irdata['last_name_msg']; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="regin_holder_2c">
                        <div>
                            <label for="password">Password:</label>
                            <input id="password" type="password"  name="password" placeholder="At least 6 symbols" required>

                            <?php if (isset($irdata['password_msg'])) { ?> 
                                <div class='form_hint'><?php echo $irdata['password_msg']; ?></div>
                            <?php } ?>
                        </div>
                        <div class="second">
                            <label for="confirm_password">Password confirmation:</label>
                            <input id="confirm_password" type="password" name="confirm_password" required>

                            <?php if (isset($irdata['confirm_password_msg'])) { ?> 
                                <div class='form_hint'><?php echo $irdata['confirm_password_msg']; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="regin_holder">
                        <label for="email">Email:</label>
                        <input id="email" type="email" name="email" required>

                        <?php if (isset($irdata['email_msg'])) { ?> 
                            <div class='form_hint'><?php echo $irdata['email_msg']; ?></div>
                        <?php } ?>
                    </div>

                    <div class="regin_holder">
                        <label for="bio">About me:</label>
                        <textarea id="bio" type="text" name="bio"></textarea>
                    </div>

                    <input class="rebutton" type="submit" value="Sign up" />
                    <input class="rebutton" type="reset" value="Reset" />

                </form>

            </div>

        </div>

        <footer>          
        </footer>

    </body>
</html>