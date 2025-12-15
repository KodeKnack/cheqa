# Cheqa - Laravel Expense Tracker

A complete Laravel expense tracking application built with PHP 8.x and Laravel 12.x.

## Features

- **Dashboard**: Overview of total expenses, monthly expenses, and analytics by category/payment method
- **Expense Management**: Full CRUD operations for expenses with filtering by date ranges (daily, weekly, monthly, yearly)
- **Category Management**: Organize expenses into categories
- **Payment Method Management**: Track different payment methods
- **Search Functionality**: Search expenses by description
- **Responsive Design**: Bootstrap 5 responsive interface
- **Date Filtering**: Filter expenses by various time periods

## Requirements

- PHP 8.2+
- Composer
- Laravel Herd (recommended) or any local development environment
- SQLite (default) or MySQL/PostgreSQL

## Installation

### 1. Clone the Repository

```bash
git clone <your-repo-url> cheqa
cd cheqa
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup

The project is configured to use SQLite by default. The database file will be created automatically.

```bash
php artisan migrate:fresh --seed
```

This will:
- Create all necessary tables
- Seed default categories (Food & Dining, Transportation, Bills & Utilities, etc.)
- Seed default payment methods (Cash, Credit Card, Debit Card, etc.)

### 5. Start the Development Server

If using Laravel Herd:
```bash
# Herd will automatically serve your application
# Access at: http://cheqa.test
```

If using Artisan serve:
```bash
php artisan serve
# Access at: http://localhost:8000
```

## Usage

### Dashboard
- View total expenses and monthly expenses
- See expense breakdowns by category and payment method
- View recent expenses

### Managing Expenses
- **Add Expense**: Click "Add Expense" to create new expense entries
- **Edit Expense**: Click the pencil icon to modify existing expenses
- **Delete Expense**: Click the trash icon to remove expenses
- **Filter Expenses**: Use the dropdown to filter by Today, This Week, This Month, or This Year
- **Search Expenses**: Use the search bar to find expenses by description

### Managing Categories
- Navigate to Categories to add, edit, or delete expense categories
- Each category shows the number of associated expenses

### Managing Payment Methods
- Navigate to Payment Methods to manage how you pay for expenses
- Each payment method shows usage statistics

## Project Structure

```
cheqa/
├── app/
│   ├── Http/Controllers/
│   │   ├── CategoryController.php
│   │   ├── DashboardController.php
│   │   ├── ExpenseController.php
│   │   └── PaymentMethodController.php
│   └── Models/
│       ├── Category.php
│       ├── Expense.php
│       └── PaymentMethod.php
├── database/
│   ├── migrations/
│   │   ├── create_categories_table.php
│   │   ├── create_expenses_table.php
│   │   └── create_payment_methods_table.php
│   └── seeders/
│       ├── CategorySeeder.php
│       └── PaymentMethodSeeder.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── categories/
│   ├── expenses/
│   ├── payment_methods/
│   └── dashboard.blade.php
└── routes/
    └── web.php
```

## Database Schema

### Categories Table
- `id` (Primary Key)
- `name` (String)
- `created_at`, `updated_at` (Timestamps)

### Payment Methods Table
- `id` (Primary Key)
- `name` (String)
- `created_at`, `updated_at` (Timestamps)

### Expenses Table
- `id` (Primary Key)
- `description` (String)
- `amount` (Decimal 10,2)
- `category_id` (Foreign Key)
- `payment_method_id` (Foreign Key)
- `expense_date` (Date)
- `created_at`, `updated_at` (Timestamps)

## Git Workflow

The project includes two main branches:
- `main`: Production-ready code
- `dev`: Development branch for new features

```bash
# Switch to development branch
git checkout dev

# Make changes and commit
git add .
git commit -m "Your commit message"

# Push to development
git push origin dev

# Merge to main when ready
git checkout main
git merge dev
git push origin main
```

## Technologies Used

- **Backend**: Laravel 12.x, PHP 8.x
- **Database**: SQLite (configurable)
- **Frontend**: Blade Templates, Bootstrap 5
- **Icons**: Bootstrap Icons
- **Version Control**: Git

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).