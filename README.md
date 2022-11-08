How to run this project in local server(Xampp)
1. We must have xampp server. (installed)
2. Make new folder in htdocs, folder name “complaintBox”
3. Paste all file in complaintBox folder or file (Path: - C:\xampp\htdocs\complaintBox)
4. start two function of xampp server
a) Apache
b) MySQL
import database file in phpMyAdmin, database file present in root folder

 change this file (C:\Windows\System32\drivers\etc\hosts)
# localhost name resolution is handled within DNS itself.
	127.0.0.1       complaintbox.co.in
	127.0.0.1       localhost

# file content|| file Name: httpd-vhosts.conf 


<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\complaintBox"
    ServerName complaintbox.co.in
    ServerAlias www.complaintbox.co.in
    ErrorLog "logs/complaintbox.co.in-error.log"
    CustomLog "logs/complaintbox.co.in-access.log" common
</VirtualHost>
<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs"
</VirtualHost>

# file content end 

5. just paste this code on path C:\xampp\apache\conf\extra\ httpd-vhosts.conf 
6. if your xampp already started stop it, and start again
7.Now we are ready to run our portal just search in browser http://complaintbox.co.in
