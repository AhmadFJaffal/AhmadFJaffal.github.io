# Intern Management System

## About
This project is a web application designed to facilitate intern applications and program management for students and IDS staff. It aims to streamline the application process, manage program details, and provide a user-friendly interface for both students and staff members.

## Features
- User authentication and authorization
- Profile management for students and staff
- Internship programs details and application
- Contact and support integration
- Admin Panel for management of interns, instructors, and internship programs
- RESTful API for secure data exchange

## Installation

Before installing, make sure you have XAMPP or similar server stack installed on your system. 

To get started with this project:

1. Clone the repository into the `htdocs` directory of your XAMPP installation.
    ```bash
    git clone https://github.com/AhmadFJaffal/IDS_Website.git
    ```

2. Navigate to the project directory:
    ```bash
    cd /path/to/xampp/htdocs/IDS_Website
    ```

3. Start XAMPP and ensure that the Apache and MySQL services are running.

4. Create a new database and import any necessary SQL files, if provided.

## Usage

To use the application:

1. Open your web browser.

2. Navigate to `http://localhost/IDS_Website` to access the application.

3. Log in or register as required to start using the system.

Make sure to update the database connection settings in your project as per your XAMPP MySQL configuration if needed.

## Configuration

You might need to adjust configuration files within the project for it to connect to the database properly. Here's an example for a typical PHP application:

1. Find the `database.php` file in the API file.

2. Update the database configuration settings with your local information, like this:
    ```php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root'); // default XAMPP username
    define('DB_PASSWORD', ''); // default XAMPP is blank
    define('DB_DATABASE', 'ids'); // your database name
    ```

3. Save the changes.

## If you have any questions or issues, please open an issue in the repository or contact me at jaffal250@gmail.com.
