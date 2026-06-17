# 👥 User Management System | Role-Based Access Control (RBAC)

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com)

> A secure, scalable, and feature-rich user management system with role-based access control (Admin & Student), built with PHP, MySQL, HTML, CSS, and JavaScript.

---

## 📋 Overview

The **User Management System** is a complete web application designed to manage users efficiently with role-based permissions. It provides administrators with full control over user data while allowing students to manage only their own profiles. The system features secure authentication, CRUD operations, real-time search, and a responsive user interface.

### 🎯 Key Highlights

- ✅ **Two-Tier Role System** – Admin & Student with distinct privileges
- ✅ **Secure Authentication** – Session-based login/logout system
- ✅ **Full CRUD Operations** – Create, Read, Update, Delete users
- ✅ **Real-Time Search** – Instant filtering with clear button
- ✅ **Responsive Design** – Optimized for all devices
- ✅ **Auto-Hide Messages** – Success/error notifications disappear after 3 seconds
- ✅ **Clean UI/UX** – Modern interface with intuitive navigation

---

## 📊 Features Matrix

| Feature | Admin | Student |
|---------|:-----:|:-------:|
| View All Users | ✅ | ❌ |
| View Own Profile | ✅ | ✅ |
| Add New Users | ✅ | ❌ |
| Update Any User | ✅ | ❌ |
| Update Own Profile | ✅ | ✅ |
| Delete Any User | ✅ | ❌ |
| Delete Own Account | ✅ | ✅ |
| Assign/Change Roles | ✅ | ❌ |
| Search Users | ✅ | ✅ (Own data only) |

---

## 🛠️ Technology Stack

### Backend
- **PHP 7.4+** – Server-side logic & session management
- **MySQL 8.0+** – Relational database
- **Apache** – Web server (XAMPP/WAMP/MAMP)

### Frontend
- **HTML5** – Semantic markup
- **CSS3** – Custom styling with responsive design
- **JavaScript (ES6)** – DOM manipulation, search, animations

### Tools & Environment
- **XAMPP** – Local development environment
- **phpMyAdmin** – Database management
- **VS Code** – Code editor

---

## 🗄️ Database Schema

```sql
CREATE DATABASE user_management;

USE user_management;

CREATE TABLE user_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(100) NOT NULL,
    userGmail VARCHAR(100) NOT NULL UNIQUE,
    userPassword VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
