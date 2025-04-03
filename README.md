# SUMBO APP

SUMBO APP is a Farmer Training and Support Platform designed to equip local farmers with knowledge on sustainable agricultural practices, irrigation techniques, and post-harvest management. The platform features an AI-driven chatbot, an e-learning module, and an e-store for farmers to connect with buyers.

## Features

- **E-Learning Platform:** Interactive lessons on sustainable farming practices.
- **AI Chatbot:** Provides instant support and answers farming-related questions.
- **E-Store:** Connects farmers with potential buyers.
- **User Authentication:** Secure sign-up and login system.
- **Dashboard:** Provides farmers with insights and updates.

---

## Getting Started

### Prerequisites

Before you begin, ensure you have the following installed:

- [XAMPP](https://www.apachefriends.org/download.html) (Includes Apache, PHP, and MySQL)
- [Git](https://git-scm.com/)
- A web browser (Google Chrome, opera mini etc)

### Clone the Repository

```sh
git clone https://github.com/your-github-username/SUMBO.git
cd SUMBO
```

---

## Configuration

### 1. Set Up XAMPP

1. Open **XAMPP Control Panel**.
2. Start **Apache** and **MySQL**.
3. Open **phpMyAdmin** by visiting: `http://localhost/phpmyadmin/`

### 2. Create a Database

1. In phpMyAdmin, click on **Databases**.
2. Create a new database named `sumbo_db`.
3. Import the database schema:
   - Click on **Import**.
   - Choose `database/sumbo-app.sql` from the project folder.
   - Click **Go**.

### 3. Configure Database Connection

1. Open `config.php` in the project directory.
2. Update the database credentials:

```php
<?php
$host = 'localhost';
$user = 'root'; // Default XAMPP user
$pass = ''; // Leave empty if no password
$db_name = 'sumbo_db';
$conn = new mysqli($host, $user, $pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 4. Running the Project

1. Move the project folder (SUMBO) to `htdocs` inside the XAMPP installation directory.
2. Open a web browser and navigate to:
   ```
   http://localhost/SUMBO/
   ```
3. The homepage should now load successfully.

---

## Directory Structure

```
/htdocs/SUMBO
│── /css              # Stylesheets
│── /js               # JavaScript files
│── /database         # Database scripts
│── /includes         # Reusable PHP components
│── /pages            # Web pages
│── /uploads          # User uploads
│── config.php        # Database connection
│── index.php         # Main entry point
│── README.md         # Project documentation
```

---

## Deployment
I have deployed the project already and you can access it at sumbo.site.

To deploy the application by yourself:

1. Purchase a domain and hosting (e.g., via Hostinger, Bluehost).
2. Upload the project files to the `public_html` directory using FTP.
3. Configure a remote MySQL database and update `config.php` with the new credentials.
4. Ensure `.htaccess` and file permissions are set correctly.

---

## API Endpoints

### Authentication

- `POST /api/auth/register.php` - Register a new user
- `POST /api/auth/login.php` - Login and get a session token

### Courses

- `GET /api/courses.php` - Fetch all courses
- `POST /api/courses.php` - Add a new course (Admin only)

### Chatbot

- `POST /api/chat.php` - Send a message to the AI chatbot

### Marketplace

- `GET /api/products.php` - View products available for sale
- `POST /api/products.php` - Add a new product

---

## Contribution Guide

If you'd like to contribute:

1. Fork the repository
2. Create a new branch (`git checkout -b feature-branch`)
3. Make your changes and commit (`git commit -m 'Add new feature'`)
4. Push to the branch (`git push origin feature-branch`)
5. Open a Pull Request

---


## Contact

For inquiries or support, email **[m.abu@alustudent.com] or visit sumbo.site(https://github.com/your-github-username/sumbo-app).

