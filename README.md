
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
I started work on this 2 days after reading the brief & regrettably missed out a required feature - the ability to create a new Todo list & edit it's name. This is currently being  addressed & work has started on a new branch called `feature/create_new_list` for now, I thought it best to show what's been done so far.
As it stands, the app is a single Todo list with the ability to add new 'todo items', mark them as completed via the checkbox & delete them via the delete button.
The app is built using Vue.js components along with axios for requests.

Feature & Unit tests have been added to the Tests folder.

### Further info
I spent a couple of days on/off building this with most of that time refreshing my Vue.js knowledge, familiarising myself with Vite & axios & some of the Laravel 10 features.
The most challenging aspect was working with Vue, whilst fun to use, I'm a little rusty!
Nice to have's would have been the option to add 'Due by' functionality with email reminders & calendar integration, I would also secure the Todo list with a login page. 
To increase the performance, I would minify all assets. As there's not really much to this app, performance issues aren't expected.