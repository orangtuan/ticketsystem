# ticketsystem

## Introduction

This project is a PHP-based ticket system that uses Docker for easy setup and deployment. It includes a PHP web server and a MariaDB database.

## Prerequisites

Before you begin, ensure you have Docker Desktop installed on your system. Docker Desktop includes both Docker Engine and Docker Compose, which are required to run this project.

## Installation

### Install Docker Desktop

1. [Download Docker Desktop](https://www.docker.com/products/docker-desktop) for your operating system using the link provided above.
2. Install Docker Desktop:
   - On macOS, drag and drop the Docker icon to the Applications folder.
   - On Linux, follow the package installation instructions provided on the Docker
   website.
   - On Windows, run the installer and follow the on-screen instructions.

### Clone and Run the Project

Clone this repository and run the project using the following commands:

```bash
git clone git@github.com:orangtuan/ticketsystem.git
cd ticketsystem
sudo docker-compose up --build # omit sudo on Windows, use an elevated terminal
```

### Accessing the Application

- Web Interface: After the containers are up and running, access the web interface at <http://localhost:8070>.
- Database: Connect to the database using any database management tool at `localhost:3305`. Use the credentials provided in your .env file or the default credentials `(MYSQL_USER: xampp, MYSQL_PASSWORD: xampp)`.

### Additional Notes

- The project's source code is mounted into the web container, so changes in the src directory will be reflected in the container.
- SQL scripts placed in the src/sql directory will be executed when the database container is first initialized.
