Demo: http://www.testingzone.ga/reg_test1/

#Directory properties:
<Directory "">  
    Options -Indexes

    RewriteEngine on 

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d

    RewriteRule ^(.*)$ index.php?action=$1 [L,QSA]
</Directory>

#Tables:
users: id, first_name, last_name, password, email, bio
ip_history: ip, last_reg
