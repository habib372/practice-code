<!-- Email Schedule command | app/Console/Commands/SendBirthdayEmails.php-->
php artisan make:command SendBirthdayEmails




Test::
login cpanel using terminal or cmd->
ssh user@82.307.158.155 -p2222      //cpnael_userName@cpanel_ip  -p2222(default port),
password
cd ~/folder_name                    //folder_name: 'public_html' or 'sub_domain_folder_name'
php artisan emails:send-birthday    //command name: 'emails:send-birthday'