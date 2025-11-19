# CampusConnect - University Management System

## 📋 Project Description

CampusConnect is a university management system developed with Laravel that allows managing announcements, room and equipment reservations for different types of users (students, teachers, administrators).

## ✨ Features

### 🎓 For Students
- View announcements
- Browse available rooms and equipment
- Profile management

### 👨‍🏫 For Teachers
- Announcement management (create, edit, delete)
- Room and equipment reservations
- Reservation tracking
- Profile management

### 👨‍💼 For Administrators
- Complete user management
- Management of all user announcements
- Reservation supervision
- Resource management (rooms and equipment)
- Statistics access

## 🛠️ Technologies Used

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, TailwindCSS, Alpine.js
- **Database**: MySQL
- **Cache/Session**: Database
- **Queue**: Database
- **Mail**: Log (development)
- **Development Tools**: Vite, PostCSS

## ⚙️ Prerequisites

Before starting, make sure you have installed:
- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **Node.js** >= 16.x and **npm**
- **MySQL** (XAMPP, WAMP, LARAGON, or standalone MySQL)
- **Git**

## 🚀 Complete Installation and Setup

```bash
# 1. Clone the project
git clone <repository-url>
cd CampusConnect

# 2. Install dependencies
composer install
npm install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Start MySQL (via XAMPP/LARAGON/WAMP)
# Make sure MySQL uses the password: 18junior

# 5. Create the database
mysql -u < your user name > < your password >
CREATE DATABASE CampusConnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE CampusConnect;
EXIT;

# 6. Create Laravel system tables
php artisan session:table
php artisan queue:table
php artisan cache:table
php artisan queue:failed-table

# 7. Create main migrations
php artisan make:migration add_role_to_users_table
php artisan make:migration create_categories_table
php artisan make:migration create_announcements_table
php artisan make:migration create_rooms_table
php artisan make:migration create_materials_table
php artisan make:migration create_reservations_table

# 8. Run all migrations
php artisan migrate

# 9. Create and run seeders
php artisan make:seeder UserSeeder
php artisan make:seeder CategorySeeder
php artisan make:seeder RoomSeeder
php artisan make:seeder MaterialSeeder
php artisan make:seeder AnnouncementSeeder
php artisan db:seed

# 10. Create controllers
php artisan make:controller StudentDashboardController
php artisan make:controller TeacherDashboardController
php artisan make:controller AdminDashboardController

# 11. Create models
php artisan make:model Category
php artisan make:model Announcement
php artisan make:model Room
php artisan make:model Material
php artisan make:model Reservation

# 12. Create role middleware
php artisan make:middleware RoleMiddleware

# 13. Compile assets and start application
npm run dev

# 14. Start server (in another terminal)
php artisan serve

# 15. Access the application
# http://localhost:8000
```

## 📄 .env File Configuration

Your `.env` file should contain these configurations:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=CampusConnect
DB_USERNAME=<your user name>
DB_PASSWORD=<your password>


VITE_APP_NAME="${APP_NAME}"
```

## 🗂️ Project Structure

```
CampusConnect/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/
│   │   ├── StudentDashboardController.php
│   │   ├── TeacherDashboardController.php
│   │   └── AdminDashboardController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Announcement.php
│   │   ├── Room.php
│   │   ├── Material.php
│   │   ├── Reservation.php
│   │   └── Category.php
│   └── Middleware/
│       └── RoleMiddleware.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php
│   │   │   └── partials/
│   │   │       ├── sidebar.blade.php
│   │   │       └── header.blade.php
│   │   ├── dashboard/
│   │   │   ├── etudiant/
│   │   │   │   ├── dashboard.blade.php
│   │   │   │   ├── annonces.blade.php
│   │   │   │   ├── salles.blade.php
│   │   │   │   └── profil.blade.php
│   │   │   ├── enseignant/
│   │   │   │   ├── dashboard.blade.php
│   │   │   │   ├── announcements.blade.php
│   │   │   │   ├── rooms.blade.php
│   │   │   │   ├── reservations.blade.php
│   │   │   │   └── profil.blade.php
│   │   │   └── admin/
│   │   │       ├── dashboard.blade.php
│   │   │       ├── users.blade.php
│   │   │       ├── annonces.blade.php
│   │   │       ├── reservations.blade.php
│   │   │       ├── ressources.blade.php
│   │   │       └── stats.blade.php
│   │   └── auth/
│   │       ├── login.blade.php
│   │       └── register.blade.php
│   ├── css/app.css
│   └── js/app.js
├── routes/web.php
├── database/
│   ├── migrations/
│   └── seeders/
├── .env
└── README.md
```

## 👥 Test Accounts

After running the seeders:

**Administrator**
- Email: admin@campusconnect.com
- Password: password123

**Teacher**
- Email:  jean.leclerc@campusconnect.com  
- Password: password123

**Student**
- Email: alexandre.durand@etudiant.campusconnect.com
- Password: password123

## 🔧 Useful Commands

```bash
# Daily development
php artisan serve                    # Start server
npm run dev                         # Compile assets
php artisan cache:clear             # Clear cache
php artisan config:clear            # Clear config
php artisan view:clear              # Clear views
php artisan route:clear             # Clear routes

# Database management
php artisan migrate:status          # Check migration status
php artisan migrate                 # Run new migrations
php artisan migrate:fresh --seed    # Reset and seed
php artisan migrate:rollback        # Rollback last migration

# Create elements
php artisan make:controller NameController
php artisan make:model NameModel -m
php artisan make:middleware NameMiddleware
php artisan make:seeder NameSeeder

# Production
npm run build                       # Compile for production
php artisan config:cache            # Cache config
php artisan route:cache             # Cache routes
php artisan view:cache              # Cache views
```

## 🐛 Troubleshooting

```bash
# Database connection error
php artisan tinker
DB::connection()->getPdo();

# Permission issues (Linux/Mac)
chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache

# Asset compilation problems
rm -rf node_modules package-lock.json
npm install
npm run dev

# Application key issues
php artisan key:generate
php artisan config:clear

# Completely recreate database
DROP DATABASE CampusConnect;
CREATE DATABASE CampusConnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
php artisan migrate:fresh --seed
```

## 🎨 User Interface

The project uses:
- **TailwindCSS** for styling
- **Alpine.js** for lightweight JavaScript interactions
- Responsive design adapted for mobile and tablets
- Interface with adaptive sidebar based on user role
- Modals for creating/editing elements
- Notification system with user feedback

## 🔒 Role System

The application manages 3 types of users:
- **student**: View only access
- **teacher**: Announcement management + reservations
- **admin**: Full access to all features

## 📊 Main Features

### Announcement Management
- Create, edit, delete announcements
- Announcement categorization
- View and engagement system
- Modern interface with modals

### Reservation System
- Room and equipment booking
- Real-time availability checking
- Time slot management
- Reservation tracking

### Adaptive Dashboard
- Different interface based on role
- Personalized statistics
- Intuitive navigation with sidebar
- Responsive design

## 📝 Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/my-feature`)
3. Commit your changes (`git commit -m 'Add feature'`)
4. Push to the branch (`git push origin feature/my-feature`)
5. Open a Pull Request

## 📄 License

Project under MIT License - IFRI Doc L3, Semester 5, Advanced Laravel.

---

**Important**: 
- Make sure MySQL uses the password `18junior` before starting
- Keep XAMPP/LARAGON/WAMP open during development
- Use `npm run dev` for automatic asset reloading
- Check Laravel logs for errors: `tail -f storage/logs/laravel.log`

**Authors**: IFRI L3 Development Team - Advanced Laravel Course