# Human Resources Information System (HRIS)

## Overview
A comprehensive Human Resources Information System designed to streamline HR processes, manage employee data, and improve organizational efficiency. This system provides a robust platform for managing various HR functions including employee management, attendance tracking, leave management, and more.

## Features
- Employee Information Management
- Leave Management System
- Attendance Tracking
- Holiday Calendar
- Career Portal
- Performance Management
- Document Management
- Reporting and Analytics

## Tech Stack
- PHP/Laravel Framework
- MySQL Database
- HTML5/CSS3
- JavaScript
- Docker Support

## Prerequisites
- PHP >= 8.0
- Composer
- Node.js & NPM
- MySQL >= 5.7
- Docker (optional)

## Installation

### Local Setup
1. Clone the repository
```bash
git clone [repository-url]
cd hris
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

4. Configure environment variables
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hris
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run database migrations
```bash
php artisan migrate
```

7. Start the development server
```bash
php artisan serve
npm run dev
```

### Docker Setup
1. Build and start containers
```bash
docker-compose up -d
```

2. Access the application container
```bash
docker-compose exec app bash
```

3. Follow steps 2-6 from the Local Setup inside the container

## Usage
Access the application through your web browser:
- Local development: `http://localhost:8000`
- Production: Configure your domain accordingly

## Testing
Run the test suite using PHPUnit:
```bash
php artisan test
```

## Contributing
1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Security
If you discover any security-related issues, please email [security-email] instead of using the issue tracker.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support
For support, please contact [support-email] or create an issue in the repository.

## Acknowledgments
- Laravel Team
- All contributors who have helped shape this project
