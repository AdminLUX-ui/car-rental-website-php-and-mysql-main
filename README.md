<h1>Car Rental Website | A Car Rental System using PHP & MYSQL</h1>
<h2>Car Rental Online Reservations</h2>
<p>
Car Rental Website using PHP and Mysql, HTML, CSS, JS, VUE JS.
The website has two sides; 1- The client-side and 2- The admin side.
1- for the client-side, the user or the client can reserve a car by selecting the pickup and return date then the user will get a collection of cars that are available during the selected time, and finally, the user has to enter his details, and then the reservations will be created successfully.
2- for the admin side, the admin can manage reservations and manage cars, car brands, and car types (Create, Read, Update, Delete)	
</p>
<hr>
<div>
	<h3>Technologies</h3>
  	<ul>
		<li>HTML & CSS</li>
		<li>Bootstrap</li>
		<li>JavaScript & Jquery & VUE JS</li>
		<li>PHP & MYSQL</li>
	</ul>
</div>
<hr>
<div>
	<h3>Website DEMO</h3>
  	<ul>
		
		<li>Admin Login Page: http://localhost/car-rental-website-php-and-mysql/admin/</li>
	</ul>
	<p>
		Username: admin
		<br>
		Password: 123456789
	</p>
</div>
<hr>
<div>
	<h3>Installation</h3>
  	<ol>
		<li>Download the files + database file (.sql)</li>
		<li>Create new database with the name "car_rental" and then Import the sql file downloaded </li>
		<li>Check the files connect.php to make sure that everything is working</li>
		<li>The website is ready to use</li>
		<li>Feel free to edit the missig parts or the existing parts</li>
	</ol>
</div>

# Lux Car Rental Web Application

## Overview
This is a PHP & MySQL-based car rental web application. It allows users to reserve cars online, with an email verification system to confirm reservations. The admin dashboard provides management for cars, clients, and reservations.

---

## Features
- Car reservation with pickup/return location and date selection
- Email confirmation for reservations (with verification link)
- Admin dashboard for managing cars, brands, types, and clients
- Responsive frontend using Bootstrap
- Secure input handling and session management

---

## Email Verification Flow
1. **User makes a reservation**: Enters details and submits the reservation form.
2. **Token Generation**: A unique email verification token is generated and stored in the `reservations` table (`email_token`, `email_verified`).
3. **Confirmation Email**: The system sends an email with a verification link to the user's email address using PHPMailer and SMTP (credentials are read from environment variables).
4. **User clicks the link**: The link points to `verify_email.php`, which marks the reservation as verified if the token is valid.
5. **Admin dashboard**: You can update your admin dashboard to show reservation status, including whether the email is verified. To do this, display the `email_verified` column from the `reservations` table in your admin reservation management page. This allows admins to see which reservations have been confirmed by email.

---

## Setup Instructions

### 1. Database
- Import `database.sql` to create/update the required tables.
- Ensure the `reservations` table has `email_token` (VARCHAR(64)) and `email_verified` (TINYINT(1) DEFAULT 0) columns.

### 2. Dependencies
- PHP 8.1+
- MySQL
- [Composer](https://getcomposer.org/) for dependency management
- PHPMailer (installed via Composer)

#### Install dependencies:
```bash
composer install
```

### 3. SMTP Configuration
- Set your SMTP credentials in your Azure App Service or local environment as environment variables:
  - `SMTP_MAIL_PASSWORD` (your SMTP/app password)
- Update `send_email.php` with your SMTP host, username, and from address.

### 4. Deployment
- The app is ready for deployment on Azure App Service.
- The GitHub Actions workflow (`.github/workflows/main_lux-web-application.yml`) will build and deploy the app, running `composer install` automatically if `composer.json` is present.

---

## File Structure
- `reserve.php` — Main reservation logic, generates token, sends email
- `send_email.php` — Sends confirmation emails using PHPMailer
- `verify_email.php` — Handles email verification via token
- `admin/` — Admin dashboard and management pages
- `composer.json` — Composer dependencies (PHPMailer)
- `database.sql` — Database schema

---

## Troubleshooting
- **Email not sending?**
  - Ensure PHPMailer is installed (`vendor/` directory exists)
  - Check SMTP credentials and environment variable setup
  - Review Azure App Service logs for errors
- **Header errors in admin?**
  - Ensure no whitespace/BOM before `<?php` in PHP files, especially in `admin/Includes/functions/functions.php`

---

## Credits
- Built with PHP, MySQL, Bootstrap, and PHPMailer

---

## Improvements
- The verification page (`verify_email.php`) now displays a clear message (success, error, or missing token) and automatically redirects the user to the home page after 3 seconds using JavaScript. This ensures a smooth user experience regardless of browser or output buffering.
