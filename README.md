How to Access and Run the Project (For Tutor)

This project is a PHP-based e-commerce website built using Visual Studio Code, XAMPP, and MySQL. To access and run this project locally, follow the steps below:

Prerequisites

* Download and install [**XAMPP**](https://www.apachefriends.org/index.html)
* Download and install [**Visual Studio Code (VS Code)**](https://code.visualstudio.com/)
* Clone or download this GitHub repository as a ZIP file
* A modern web browser (Chrome, Edge, Firefox)
 📁 Project Folder Structure

---

### ⚙️ Step-by-Step Installation Guide

#### 📦 1. Set Up XAMPP

1. Install and open **XAMPP Control Panel**
2. Start both **Apache** and **MySQL** modules

#### 📂 2. Place Project in `htdocs`

1. Extract the downloaded project ZIP file from my repository
2. Move it to the XAMPP directory:
   `C:\xampp\htdocs\Tempsclothing`

#### 🗄️ 3. Import the MySQL Database

1. Open a browser and go to:
   `http://localhost/phpmyadmin`
2. Click **Import**, choose `tempsclothing.sql` file from the project folder
3. Click **Go** to import the database

 You will now have a database named `tempsclothing` in phpMyAdmin

#### 🧑‍💻 4. Configure `connect.php` (Optional)

* Navigate to `includes/connect.php`
* Update the credentials if your MySQL password is not blank:

```php
$con = mysqli_connect("localhost", "root", "", "tempsclothing");
```

---

### 💻 5. Open and Run the Project in Browser

* Open a browser and go to:
  `http://localhost/Tempsclothing/index.php`

* Explore the website:

  * Shop page: `display_all.php`
  * Register/Login: `register.php` / `login.php`
  * Cart: `cart.php`
  * Admin product insertion:http://localhost/Tempsclothing/Admin_area/Index.php?Insert_Products
  * For the Contact : http://localhost/Tempsclothing/contact.php
  * To register yourself : http://localhost/Tempsclothing/register.php
---


