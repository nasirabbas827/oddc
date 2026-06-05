# oddc

> **oddc** – A lightweight PHP application that stores contact data in a MySQL database and sends email notifications using **PHPMailer**.

---

## Overview

`oddc` is a small, self‑contained project that demonstrates how to:

* Store and retrieve records with a MySQL database (`Final Database/oddc (2).sql`).
* Send transactional emails through SMTP/OAuth using the robust **PHPMailer** library.
* Manage multilingual email templates (see the `PHPMailer-master/language/` folder).

The repository bundles the full PHPMailer source so the application can run out‑of‑the‑box without additional downloads.

---

## Features

| ✅ | Feature |
|---|----------|
| 📁 | **SQL schema** – ready‑to‑import database dump. |
| 📧 | **PHPMailer** integration with SMTP and OAuth support. |
| 🌐 | **Multilingual** language files (Afrikaans, Arabic, German, Spanish, …). |
| 🔧 | Composer‑based dependency management. |
| 📜 | Comprehensive documentation (`PHPMailer-master/README.md`, `SECURITY.md`). |
| 📄 | License files for both the project and PHPMailer. |

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | PHP 7.4+ |
| Database | MySQL / MariaDB |
| Email | PHPMailer (bundled) |
| Dependency Management | Composer |
| License | MIT (project) + PHPMailer BSD‑3‑Clause |

---

## Installation

> **Prerequisites** – PHP 7.4+, Composer, MySQL server, and an SMTP account (or OAuth credentials).

1. **Clone the repository**

   ```bash
   git clone https://github.com/yourusername/oddc.git
   cd oddc
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

   *The `composer.json` file lives inside `PHPMailer-master/` and pulls in PHPMailer.*

3. **Import the database schema**

   ```bash
   mysql -u YOUR_DB_USER -p YOUR_DB_NAME < "Final Database/oddc (2).sql"
   ```

4. **Configure the application**

   Create a `config.php` (or edit the existing one) with your credentials:

   ```php
   <?php
   // Database
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'YOUR_DB_NAME');
   define('DB_USER', 'YOUR_DB_USER');
   define('DB_PASS', 'YOUR_DB_PASSWORD');

   // Mailer
   define('MAIL_HOST', 'smtp.example.com');
   define('MAIL_USERNAME', 'YOUR_SMTP_USER');
   define('MAIL_PASSWORD', 'YOUR_SMTP_PASSWORD');
   define('MAIL_PORT', 587);               // or 465 for SSL
   define('MAIL_ENCRYPTION', 'tls');       // or 'ssl'
   // For OAuth:
   // define('MAIL_OAUTH_TOKEN', 'YOUR_OWN_API_KEY');
   ?>
   ```

5. **Set up the web server**

   Point your virtual host / document root to the project directory (e.g., `public/` if it exists) and ensure PHP is enabled.

---

## Usage

### Sending an email

```php
require 'config.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try