# PHP PDO

This project demonstrates basic CRUD (Create, Read, Update, Delete) operations using PHP's PDO (PHP Data Objects) extension with MySQL database.

## Project Structure

```
├── connection.php    # Database connection configuration
├── select.php       # Read operations (SELECT queries)
├── insert.php       # Create operations (INSERT queries)
├── update.php       # Update operations (UPDATE queries)
├── delete.php       # Delete operations (DELETE queries)
├── users.sql        # Database schema and sample data
└── README.md        # This file
```

## Database Setup

1. Create a MySQL database named `pdo`
2. Import the database schema and sample data from [users.sql](users.sql)

The `users` table structure:
- `id` (int, primary key, auto-increment)
- `name` (varchar, 255)
- `email` (varchar, 255, unique)
- `password` (varchar, 255)

## Configuration

Update the database credentials in [connection.php](connection.php):

```php
$host = 'localhost';
$dbname = 'pdo';
$username = 'root';
$password = 'root';
$port = 3306;
```

## Usage Examples

### Database Connection
The [connection.php](connection.php) file establishes a PDO connection to MySQL database and returns the PDO instance.

### Select Operations
[select.php](select.php) demonstrates various ways to retrieve data:
- Fetch all users
- Fetch single user with prepared statements
- Named parameter binding
- **Note**: Contains an example of SQL injection vulnerability for educational purposes

### Insert Operations
[insert.php](insert.php) shows how to:
- Insert new records using prepared statements
- Handle PDO exceptions
- Use named parameter binding for security

### Update Operations
[update.php](update.php) demonstrates:
- Updating existing records
- Using prepared statements with named parameters

### Delete Operations
[delete.php](delete.php) shows:
- Deleting records safely
- Using prepared statements with positional parameters

## Security Features

This project demonstrates:
- **Prepared Statements**: Protection against SQL injection
- **Parameter Binding**: Both positional (`?`) and named (`:parameter`) placeholders
- **Exception Handling**: Proper error handling with try-catch blocks

## Running the Examples

1. Ensure you have PHP and MySQL installed
2. Set up the database using [users.sql](users.sql)
3. Configure database connection in [connection.php](connection.php)
4. Run individual PHP files:
   ```bash
   php select.php
   php insert.php
   php update.php
   php delete.php
   ```

## Requirements

- PHP 7.0 or higher
- MySQL 5.7 or higher (or MariaDB)
- PDO MySQL extension enabled

## Security Warning

The [select.php](select.php) file contains an intentional SQL injection example for educational purposes. Never use direct string concatenation in SQL queries in production code.