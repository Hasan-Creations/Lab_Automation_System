# Lab Automation System (LAS)

A simplified Laboratory Automation System built with Laravel, designed for tracking batch lifecycles, test results, and CPRI submissions.

## Project Background
This project has been refactored to be **beginner-friendly**. It uses explicit logic, manual property assignments, and basic Laravel features to make the codebase easy to understand for students and junior developers.

## Prerequisites
- **XAMPP** (or any server with PHP 8.1+ and MySQL)
- **Composer**
- **Node.js & NPM**

## Installation Steps

Follow these steps to run the system on your local machine:

### 1. Extract and Navigate
If you downloaded the ZIP, extract it and open your terminal (cmd/Powershell) in the project folder.

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install JavaScript Dependencies
```bash
npm install
npm run build
```

### 4. Setup Environment File
Copy the example environment file:
```bash
copy .env.example .env
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Configure Database
1. Open **XAMPP Control Panel** and start **Apache** and **MySQL**.
2. Go to [phpMyAdmin](http://localhost/phpmyadmin/) and create a new database named `lab_automation`.
3. Open the `.env` file in a text editor and update the database settings:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lab_automation
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### 7. Run Migrations and Seeders
This will create the tables and add the initial admin and tester accounts.
```bash
php artisan migrate --seed
```

### 8. Run the Application
Start the Laravel development server:
```bash
php artisan serve
```
You can now access the system at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Default Credentials
After seeding, you can log in with:

- **Admin Account**: `admin` / `admin123`
- **Tester Account**: `tester` / `test123`

## Key Features
- **Batch Tracking**: Monitor the movement of batches through different departments.
- **QC Testing**: Log pass/fail/pending results for various electrical and mechanical tests.
- **CPRI Workflow**: Manage submissions and results from the Central Power Research Institute.
- **Simple UI**: Clean, mobile-responsive interface built with Bootstrap 5.
