
##   Minesoft dev test
**Introduction:**
This MVP is intended to demonstrate how I would build a Todo app using Laravel 10.14.1 & Vue.js 3.2.36

**Installation:**
I've used an AWS database so you'll need to add your own database details in the .env file.

CD into the root directory *minesoft_todo* and run `composer install`, followed by `npm install`.
After configuring your database and creating the `minesoft-todo` schema, run `php artisan migrate` to create the required tables.

To start the webserver, run `php artisan server`.
The app will now be available at *http://127.0.0.1:8000/*

I've made use of the new Laravel Vite for asset bundling. 
To make code updates, simply run `npm run dev` where Vite will watch for updates & reload the browser when needed.

### The app
This is a sinlge page application that allows a user to create a new todo list, add & delete todo items as well as marking them completed using the checkbox, update the todo list name and delete an entire todo list.
The app is built using Vue.js components along with axios for requests.

Feature & Unit tests have been added to the Tests folder.

### Further info
I spent a couple of days on/off building this with most of that time refreshing my Vue.js knowledge, familiarising myself with Vite & axios & some of the Laravel 10 features.
The most challenging aspect was working with Vue, whilst fun to use, I'm a little rusty!
Nice to have's would have been the option to add 'Due by' functionality with email reminders & calendar integration, I would also secure the Todo list with a login page. 

I did attempt to use font-awesome as I wanted a trash can icon for deleting todo's & also a square-plus icon instead of the 'Add' button but had issues importing the correct library & didn't want to waste anymore time.

To increase the performance, I would minify all assets. As there's not really much to this app, performance issues aren't expected.