# Web Application Security Lab (SQL Injection & XSS)

## Overview
This project demonstrates a web application security simulation built in a controlled local environment. The goal was to replicate common web vulnerabilities such as SQL Injection (SQLi) and Cross-Site Scripting (XSS) to understand how they work and how they can be mitigated.


## Technologies Used
- HTML, CSS, JavaScript
- PHP
- MySQL
- XAMPP
- phpMyAdmin

---

## Lab Setup
- Developed a banking-style web application locally using XAMPP
- Created a backend database with multiple user records
- Implemented login functionality connected to a MySQL database
- Configured the environment to simulate real-world web application behaviour

---

## vulnerabilities Demonstrated

### SQL Injection (SQLi)
- Simulated insecure authentication logic
- Demonstrated how input manipulation can bypass login controls
- Retrieved multiple user records from the database

### Cross-Site Scripting (XSS)
- Injected malicious scripts into the web application
- Demonstrated client-side script execution
- Showed how user input can be exploited in web applications

---

##  Key Findings
- Poor input validation can lead to authentication bypass
- Web applications must sanitise and validate all user inputs
- Vulnerabilities like SQLi and XSS can expose sensitive user data

---
## Full Report
[View Full Web Application Security Report](./Web_Application_Security_Report.pdf)

##  Security Insights & Mitigation
- Use prepared statements to prevent SQL injection
- Implement input validation and output encoding
- Apply secure coding practices in web development
- Use modern frameworks that include built-in protections

---

## 📄Full Report
(Add your report link here)

---

## Author
Dini Vumijojo
