# hospital-management-system
Hospital Management System built using HTML, CSS, JavaScript, PHP and MySQL.

# Hospital Management System

## Overview
The **Hospital Management System** is a role-based web application developed using **PHP and MySQL** to manage core hospital operations in a structured and organized manner. The system supports multiple user roles and provides dedicated dashboards to handle patient records, appointments, medical reports, billing, discharge information, and internal communication.

This project demonstrates practical application of backend development, database design, and role-based system modeling.

---

## Key Features
- Role-based login system (Admin, Doctor, Patient Caretaker, Nurse)
- Patient registration and management
- Doctor assignment to patients
- Appointment scheduling and management
- Patient medical reports handling
- Billing and discharge record management
- Internal messaging between roles
- Modular UI with reusable components
- Relational database with structured tables

---

## Technologies Used
- PHP (Backend development)
- MySQL (Relational database)
- HTML & CSS (Frontend)
- SQL (Database schema & queries)

---

## System Roles
- **Admin**: Manages users, patients, appointments, reports, and billing
- **Doctor**: Views appointments, patients, and medical reports
- **Patient Caretaker**: Views assigned patients and reports
- **Nurse**: Assists in patient-related operations

---

## Database Design
The system uses a relational database with multiple interconnected tables for:
- Users (admin, doctor, patient, caretaker)
- Appointments
- Patient reports
- Billing and discharge records
- Messages and collaborations

SQL dump files are included for database setup and reference.

---

## Project Structure
```text
hospital-management-system/
│
├── authentication & session handling
├── role-based dashboards (admin, doctor, nurse, caretaker)
├── patient, appointment, billing, and report modules
├── database connection and SQL files
├── UI components (header, footer, sidebar)
├── CSS stylesheets
└── README.md

```
## How to Run the Project
1. Install **XAMPP / WAMP / MAMP**
2. Place the project folder inside the `htdocs` directory
3. Import the provided `.sql` file into **phpMyAdmin**
4. Configure database credentials in `connection.php`
5. Start **Apache** and **MySQL** services
6. Open the project in browser:


---

## Learning Outcomes
- Backend web development with PHP
- Relational database design using MySQL
- Role-based system architecture
- CRUD operations
- Session handling and authentication flow
- Modular UI and code organization

---

## Future Improvements
- Password hashing and stronger authentication
- Input validation and SQL injection prevention
- Role-based access control (RBAC)
- Improved UI/UX
- Audit logs and activity tracking
- API-based architecture

---

## Author

Laiba Tariq 

**Software Engineering Student**  

GIFT University, Gujranwala  

GitHub: https://github.com/progr-laibatariq
