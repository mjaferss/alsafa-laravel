# AlSafa Project Structure

## Overview
This document provides a comprehensive map of the project structure, explaining the purpose of each important directory and file, and tracking the implementation progress of different modules.

## Directory Structure

### 🌐 Root Directory
```
alsafa/
├── app/                    # Application core code
│   ├── Http/              # HTTP layer (Controllers, Middleware, etc.)
│   ├── Models/            # Database models
│   └── Traits/            # Reusable traits
├── config/                # Configuration files
├── database/             # Database migrations and seeders
├── public/               # Publicly accessible files
│   ├── css/             # Compiled CSS files
│   ├── js/              # Compiled JavaScript files
│   └── images/          # Image assets
└── resources/           # Raw resources
    ├── views/           # Blade templates
    └── lang/            # Language files
```

## 📊 Implementation Progress

### ✅ Completed Modules
1. **Users Management (إدارة المستخدمين)** - 100% Complete
   - Full CRUD operations
   - Role-based access control
   - Status management (active/inactive)
   - Multilingual support

2. **Branches Management (إدارة الفروع)** - 100% Complete
   - Full CRUD operations
   - Status management (active/inactive)
   - Multilingual support (names and addresses in Arabic and English)
   - Role-based access control

### ⏳ Pending Modules
1. **Departments Management (إدارة الأقسام الرئيسية)** - 0% Complete
   - Structure created but implementation pending

2. **Towers Management (إدارة الأبراج)** - 0% Complete
   - Structure created but implementation pending

3. **Maintenance Requests (طلبات الصيانة)** - 0% Complete
   - Structure created but implementation pending

### 📝 Views Structure
```
resources/views/
├── admin/               # Admin panel views
│   ├── users/                  # User management ✅
│   │   ├── index.blade.php     # List all users ✅
│   │   ├── create.blade.php    # Create new user ✅
│   │   └── edit.blade.php      # Edit existing user ✅
│   ├── branches/               # Branch management ✅
│   │   ├── index.blade.php     # List all branches ✅
│   │   ├── create.blade.php    # Create new branch ✅
│   │   └── edit.blade.php      # Edit existing branch ✅
│   ├── departments/            # Department management ⏳
│   │   ├── index.blade.php     # List all departments ⏳
│   │   ├── create.blade.php    # Create new department ⏳
│   │   └── edit.blade.php      # Edit existing department ⏳
│   ├── towers/                 # Tower management ⏳
│   │   ├── index.blade.php     # List all towers ⏳
│   │   ├── create.blade.php    # Create new tower ⏳
│   │   └── edit.blade.php      # Edit existing tower ⏳
│   └── maintenance/            # Maintenance requests ⏳
│       ├── index.blade.php     # List all maintenance requests ⏳
│       ├── create.blade.php    # Create new maintenance request ⏳
│       └── edit.blade.php      # Edit existing maintenance request ⏳
├── auth/                # Authentication views ✅
│   ├── login.blade.php         # Login page ✅
│   └── register.blade.php      # Registration page ✅
├── layouts/             # Layout templates ✅
│   ├── admin_new.blade.php     # Admin panel layout ✅
│   ├── guest.blade.php         # Guest/public layout ✅
│   └── partials/              # Layout partials ⏳
│       ├── head.blade.php      # Head section with meta tags and CSS ⏳
│       ├── sidebar.blade.php    # Admin sidebar navigation ⏳
│       ├── navbar.blade.php     # Top navigation bar ⏳
│       └── scripts.blade.php    # JavaScript includes and scripts ⏳
├── components/          # Reusable components ✅
└── pagination/          # Pagination templates ✅
    └── bootstrap-5.blade.php   # Bootstrap 5 pagination template ✅
```

### 🌍 Language Files Structure
```
resources/lang/
├── ar.json              # Arabic translations in JSON format ✅
├── en.json              # English translations in JSON format ✅

```

## 🔑 Key Files and Their Purposes

### Controllers
- `DashboardController.php`: Manages the admin dashboard view and statistics ✅
- `LanguageController.php`: Handles language switching functionality ✅
- `UserController.php`: Manages user CRUD operations ✅
- `BranchController.php`: Manages branch CRUD operations ✅
- `DepartmentController.php`: Manages department CRUD operations ⏳
- `TowerController.php`: Manages tower CRUD operations ⏳
- `MaintenanceController.php`: Manages maintenance request CRUD operations ⏳

### Models
- `User.php`: User model with authentication and role management ✅
- `Activity.php`: Logs user activities and changes ✅
- `Branch.php`: Manages branch information ✅
- `Department.php`: Manages department information ⏳
- `Tower.php`: Manages tower information ⏳
- `Maintenance.php`: Manages maintenance request information ⏳

### Layouts
- `admin_new.blade.php`: Main layout for authenticated users with: ✅
  - Fixed header
  - Collapsible sidebar
  - Content area
  - Language switcher
- `guest.blade.php`: Public layout with: ✅
  - Navigation bar
  - Language switcher
  - Content area
  - Footer
- `partials/`: Layout components for better organization: ⏳
  - `head.blade.php`: Meta tags, CSS links, and other head elements
  - `sidebar.blade.php`: Admin sidebar with navigation menu
  - `navbar.blade.php`: Top navigation bar with user menu
  - `scripts.blade.php`: JavaScript files and inline scripts

## 🔧 Configuration
Important configuration files that should not be duplicated:
- `config/app.php`: Application configuration ✅
- `config/auth.php`: Authentication configuration ✅
- `config/database.php`: Database configuration ✅

## 📋 Development Guidelines
1. All new features should follow this structure
2. Language files should be kept in sync between Arabic and English
3. Use the existing layouts instead of creating new ones
4. Follow the established naming conventions
5. Use the LogsActivity trait for models that need activity tracking
6. Implement role-based access control for all new modules
7. Ensure all views are responsive and work on mobile devices
8. Maintain multilingual support for all user-facing content
