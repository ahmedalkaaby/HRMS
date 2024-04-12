<h1 align="center">HR Management System for Driver Onboarding</h1>

<p align="center">
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Overview

The HR Management System for Driver Onboarding is a web-based application designed to streamline the process of recruiting and managing new drivers. Developed using Laravel and Blade, this system allows Human Resources (HR) personnel to create employee profiles, upload necessary documents and pictures, and handle an approval process to ensure all requirements are met before a driver is officially onboarded.

## Key Features
- __Employee Profile Management__: Create, read, update, and delete driver profiles.
- __Document Management__: Secure uploading and storage of documents required for driver validation.
- __Photo Upload__: Functionality to add and store driver photographs for easy identification.
- __Approval Workflow__: A structured system for supervisors to approve or reject drivers based on submitted profiles and documents.
- __Notification System__: Automated alerts and notifications for actions needing attention, such as pending approvals or profile updates.
- __Audit Logging__: Comprehensive logging of all system activities to maintain records and compliance.
- __Reporting__: Ability to generate and export reports in PDF, XLSX, or CSV formats.
- __User Management__: Manage user roles and permissions for HR personnel and supervisors.

## Technical Stack

- __Backend Framework__: Laravel
- __Frontend Framework__: Blade with CSS and Tailwind for styling
- __Database__: MySQL
- __Version Control__: Git
- __Deployment__: Deployed on Heroku for accessibility and reliability

## Getting Started

### Prerequisites
## Requirements
* PHP >= 8.1
* Laravel >= 9.0

## Installation

1- Clone the repository:
```bash
git clone https://github.com/ahmedalkaaby/HRMS.git
cd HRMS
```
2- Install dependencies
```bash
composer install
```
3- Set up environment 
#### Copy .env.example to .env and modify it to suit your database and mail settings.
```bash
cp .env.example .env
```
4- Generate application key
```bash
php artisan key:generate
```
5- Run migrations
```bash
php artisan migrate
```
6- Serve the application
```bash
php artisan serve
```
The application will be available at http://localhost:8000.

## Usage
- Log in as an HR user to create, update, and manage driver profiles and documents.
- Supervisor accounts review and approve submissions through the approval workflow.
- Utilize the reporting features to generate insights and maintain records.

## Contributing
Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are greatly appreciated

- Fork the Project
- Create your Feature Branch (git checkout -b feature/AmazingFeature)
- Commit your Changes (git commit -m 'Add some AmazingFeature')
- Push to the Branch (git push origin feature/AmazingFeature)
- Open a Pull Request

## License
Distributed under the MIT License. See [LICENSE](https://opensource.org/licenses/MIT) for more information.

## Contact
- **Ahmed Atiyah (Owner)**: <a href="mailto:hi@k3be.dev">hi@k3be.dev</a>
- **Project Link**: https://github.com/ahmedalkaaby/HRMS