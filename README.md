# Advertising

To Run The project <br>
1 - clone the project from git <br>
2 - copy .env.example file and rename the new copy .env only <br>
3 - add your DB details in .env file <br>
4 - Run composer install command <br>
5 - Run php artisan key:generate command <br>
6 - Run php artisan migrate:fresh --seed command <br>
7 - Run php artisan serve command <br>

/*******************************************************/
# Assumtions

1 - This Module is one langauge <br>
2 - There are two types of roles (Admin, Advertiser).
So I used <b>Saptie laravel permissions package</b> 
to handle this and for scalability in the future<br>
3 - I used <b>JWT Package</b> and perform register, login and logout methods<br>
4 - The Admin have all permissions, Advertiser can show All Ads, Filter them and show his Ads. <br>
5 - Each Ad has many related tags and each tag has many ads So the relation will be <b>ManyToMany</b><br>
6 - I added created_by_user_id attribute in ads table to know who did add the ad
for scalability if we have different users not admin (ex: sales, HR, ...) can add the ads in the future 

/********************************************************/
# Admin Permissions
1 - login <br>
2 - logout <br>
3 - MAnage Tags <br>
4 - Manage Categories <br>
5 - View All Ads <br>
6 - Filter Ads <br>
7 - Add ads <br>
8 - show Advertiser's Ads <br>

# Admvertiser Permissions
1 - Register <br>
2 - login <br>
3 - logout <br>
4 - View All Ads <br>
5 - Filter Ads <br>
6 - show His Ads <br>

/********************************************************/

# Unit Tests

- Added Unit Tests for Test The Response of Routes

/********************************************************/

# To Run Collection On Postman 
Add to Variables in collection
1 - url 
2 - token

/********************************************************/

Note : I used my personal emial on Mailtrap to receieve daily email 

if you want to see and test it please contact me



