# **Scandiweb Assessment Project Documentation**

## **Project Overview**

This project is a PHP-based web application built as part of a backend development assessment. It includes features such as product management, dynamic product type handling, and more.

## **Prerequisites**

- **PHP Version**: `8.3` or higher
- **Composer** (PHP Dependency Manager)
- **MySQL** (Database)
- **Apache** or PHP's built-in server for local development

## **Installed Packages**

The following Composer packages are required for the project:

- **[composer](https://getcomposer.org/)**: Dependency management
- **[leaguephp/route](https://route.thephpleague.com/)**: Route management
- **[leaguephp/container](https://container.thephpleague.com/)**: Dependency Injection
- **[Twig](https://twig.symfony.com/)**: Template engine for PHP
- **[laminas/laminas-diactoros](https://docs.laminas.dev/laminas-diactoros/)**: PSR-7 HTTP Message Implementation
- **[laminas/laminas-httphandlerrunner](https://docs.laminas.dev/laminas-httphandlerrunner/)**: PSR-15 HTTP Handler Runner
- **[vlucas/phpdotenv](https://github.com/vlucas/phpdotenv)**: Environment variable loader

## **Installation Instructions**

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-repo/project-name.git
   ```

2. **Navigate into the Project Directory:**
   ```bash
   cd project-name
   ```

3. **Install Composer Dependencies:**
   ```bash
   composer install
   ```

4. **Set up Environment Variables:**

   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

   Update the `.env` file with your specific database credentials and any other necessary environment variables:
   ```bash
   DB_HOST=your-host
   DB_NAME=your-database-name
   DB_USER=your-username
   DB_PASS=your-password
   ```

## **Running the Project**

### **PHP Built-in Server**

To run the project locally using PHP’s built-in server, execute the following command:
   ```bash
   php -S localhost:8000 -t public
   ```

   Replace `8000` with any desired port number.

### **Apache Server (Optional)**

If you're using Apache or another web server, ensure the `BASE_PATH` is set correctly in the environment configuration to match the server's document root.

## **Seeding the Database**

To seed the database, run the following command:
   ```bash
   php public/seed
   ```

- This will generate essential product types (e.g., books, DVDs, furniture).
- **Note:** Seeding can only be done once, as the product types are persistent. Rerunning this command will not affect the pre-seeded types.

## **Database Configuration**

- **Database Credentials**:
  - Update the `.env` file with the correct database information.
    ```bash
    DB_HOST=your-host
    DB_NAME=your-database-name
    DB_USER=your-username
    DB_PASS=your-password
    ```

## **Live Website**

The live version of the application is hosted at:

[https://myassessmenttestscandiweb.store/](https://myassessmenttestscandiweb.store/)

---

## **Additional Notes**

- Ensure you are running PHP version `8.3` or above for compatibility with the application.
- All server environment configurations can be modified within the `.env` file as needed.
