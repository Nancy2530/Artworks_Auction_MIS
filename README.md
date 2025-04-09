
# 🎨 Online Auction System for Artworks

This is a web-based platform designed to bridge the gap between artists and buyers by enabling online auctioning of artworks. The system allows artists to showcase their talent to a global audience and ensures that their art reaches its maximum value through competitive bidding.

---

## 🚀 Features

- **User Roles:** Admin, Artists, and Buyers
- **Artist Module:**
  - Registration and verification by admin
  - Submit artwork for auction
- **Buyer Module:**
  - Registration and verification by admin
  - Browse and place bids on active auctions
- **Admin Module:**
  - Verify users (artists & buyers)
  - Approve artwork for auction
  - Determine auction winners
  - Facilitate artist-buyer connections for payment and delivery

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript (optionally Bootstrap)
- **Backend:** PHP
- **Database:** MySQL
- **Server:** Apache (via XAMPP/LAMPP)

---

## 🧩 Prerequisites

Before running the system, ensure the following is installed on your machine:

- [XAMPP/LAMPP](https://www.apachefriends.org/download.html)
- A modern web browser
- Basic knowledge of PHP and MySQL (optional but helpful)

---

## 📦 Installation & Setup

### 1. Clone or Download the Project

```bash
git clone https://github.com/Nancy2530/Artworks_Auction_MIS.git
```

Or download the ZIP and extract it to your web server directory.

### 2. Move Project to Server Directory

Move the project to the appropriate web root:

- **Linux (LAMPP):** `/opt/lampp/htdocs/`
- **Windows (XAMPP):** `C:\xampp\htdocs\`

### 3. Start Apache and MySQL

Open XAMPP/LAMPP Control Panel and start:
- Apache
- MySQL

### 4. Import the Database

- Visit [phpMyAdmin](http://localhost/phpmyadmin)
- Create a new database (e.g., `earworks_auction`)
- Import the provided SQL file:
  - Click the **Import** tab
  - Select `earworks_auction.sql` from the project folder
  - Click **Go**

### 5. Configure Database Connection

Open the project’s `config.php` or `db.php` file and set:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "earworks_auction";
$conn = mysqli_connect($host, $user, $password, $database);
```

Make sure these match your local MySQL settings.

### 6. Run the Application

Visit your browser and go to:

```
http://localhost/eArworksAuction/
```



---

## 👤 User Roles

- **Admin:** Manages users, approves artworks, finalizes auctions.
- **Artist:** Registers and submits artworks for auction.
- **Buyer:** Registers and places bids on desired artworks.

