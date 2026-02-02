# Supplier Management System (Test Project)

This is a simple CRUD application built for the interview test. It allows managing suppliers with Create, Read, Update, and Delete functionalities.

**Built With:**
* Laravel (Framework)
* Livewire 
* Tailwind CSS 
* SweetAlert2 (For custom popup alerts)

---

### How to Run this Project

Follow these simple steps to set it up on your local machine:

**1. Setup the Project**
* Extract the zip file.
* Open the terminal in the project folder and run:
    ```bash
    composer install
    npm install
    npm run build
    ```

**2. Configure Database**
* Create a MySQL database named: `inbizsys_test`
* Rename the `.env.example` file to `.env`
* Open `.env` and update your DB credentials (username/password).
* Run this command to generate the app key:
    ```bash
    php artisan key:generate
    ```

**3. Import Data**
* I have attached a file named `inbizsys_test.sql` in the project folder.
* Please import this `.sql` file into your database to get the table structures.
* *(Alternatively, you can run `php artisan migrate`)*

**4. Run the Server**
```bash
php artisan serve
