# Poker hands comparison
A simple tool to compare poker hands and find out the winner. Created with Laravel framework.

Here are the steps you need to do for making this project work.

**Follow this [Heroku link](http://frozen-falls-27772.herokuapp.com/) to see the tool online or deploy the project locally using the steps below.**
1. Clone the repository
2. Create a virtual host that follows `/public` folder or run `php -S localhost:8081 -t ./public`
3. Run`composer update`
4. Create a mysql database
5. Create an `.env` file, copying from `.env.example`
6. Change values for DB connection
7. Run `php artisan key:generate`
8. Run `php artisan migrate`

After deploying 
1. Go to `/register` page and create a new user (no email confirmation)
2. At the home page compare two poker hands filling the inputs or upload the "hands.txt" file which you can find a the root directory.
