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
2 - There are two types of roles (Admin, Advertiser). So I used Saptie laravel permission package to handle this and for scalability in the future<br>
3 - The Admin have all permissions, Advertiser can show its Ads and can filter them <br>
4 - Each Ad has many related tags and each tag has many ads So the relation will be <b>ManyToMany</b><br>
5 - I added created_by_user_id attribute in ads table to know who did add the ad if we have different users (ex: sales, HR, ...) can manage the ads in the future 

