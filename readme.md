# Sidekicker Coding Challenge

## Setup
* Download and extract ZIP file (contains frontend and backend in Lumen)
* Install dependenies: `composer install`
* Configure `.env`
  * Create database `sidekicker` in MySQL
  * Update `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` to match your MySQL access settings
* Run migration: `php artisan migrate`
* Run seeder for Location table: `php artisan db:seed --class=LocationTableSeeder`
* Download `job-list.csv`
* Run the Import CSV artisan command: `php artisan importcsv:jobs \full\path\to\job-list.csv`.
  * Command will throw and error if the file parameter is not passed
  * Please ensure the file has read permission
  * On successful import you should see the message `Finished import`
* To view the list of records
  * Start PHP server - `php -S localhost:8000 -t public`
  * Open the URL `http://localhost:8000` in the browser
  * Page shows list of jobs imported
  * Click on `View Applications` to see a list of applicants who have applied for the job
