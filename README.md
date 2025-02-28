
# Mess Management System

The Mess Management System is a web-based application designed to streamline and automate the management of a mess or shared bachelor house. This system helps track expenses, meal counts, member contributions and overall financial records efficiently.

![MMS](https://github.com/user-attachments/assets/ffe89678-6a63-4243-9c1e-3e66362dcade)

## Features

- Role-based Access Control:
    - Admin: Full access, who creates task, deposit, add meal and others expense.
    - Users: who can track all market and add and see own market and display overall expense in profile section.

- Admin Section
    - Dashboard: Overview of total expenses, deposits, and meal statistics.
    - Task: Assign and track daily mess-related tasks.
    - Deposit: Record member deposits and contributions.
    - Meal: Records daily meal counts for each member.
    - Others: Add monthly mess expenses like rent, gass, elctricity etc.
      
- Users Section
    - Dashboard: Displays daily prayer times.
    - Market: View all market lists.
    - Profile: View personal account details and Manage individual market.


## Technologies Used

- Frontend: HTML, tailwind CSS,AJAX and jQuery
- Backend: Laravel and Rest API
- Database: MySQL

## Installation Guide

Follow these steps to set up the project on your local machine:

### Prerequisites

- PHP (>= 8.0)
- Composer
- MySQL
- Git




## Setup Instructions

 1. Clone the repository:

```bash
    git clone https://github.com/smmehedi4u/mess-management-system.git
```
2. Moved new Folder
```bash
    cd mess-management-system
```

3. Install dependencies:

```bash
    composer install
```

4. Setup Environment: 

```bash
    cp .env.example .env
```

5. Open .env and configure the following:

```bash
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
```

6. Generate application key:

```bash
    php artisan key:generate
```

7. Run migrations and seed the database:

This command will create the database tables and populate initial data using seeders.

```bash
    php artisan migrate --seed
```

8. Serve the application:

Start the Laravel development server.

```bash
    php artisan serve
```

9.Access the application:

Open your browser and visit http://localhost:8000.





