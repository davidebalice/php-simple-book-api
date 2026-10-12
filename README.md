# PHP Simple Book API

A simple REST API in plain PHP to manage a list of books (CRUD), with PDO and MySQL.
Every request is authenticated with a token that combines the user email, password and API key. The `calls/` folder contains example PHP clients that call the API with cURL.

## Features

- Create, read, update and delete books (ISBN, title, author)
- Token authentication: `Authorization: Bearer base64(email:password:apikey)`, checked against hashed password and API key stored in the database
- JSON responses with proper HTTP status codes
- Prepared statements with PDO
- Example cURL clients for every operation

## Tech stack

- [PHP](https://www.php.net/) (no framework)
- [PDO](https://www.php.net/manual/en/book.pdo.php) and [MySQL](https://www.mysql.com/)
- [cURL](https://www.php.net/manual/en/book.curl.php) for the example clients

## Getting started

### Requirements

- PHP 7.4 or later with the PDO MySQL and cURL extensions
- MySQL
- Apache (or any web server that runs PHP)

### Installation

```bash
git clone https://github.com/davidebalice/php-simple-book-api.git
```

Place the folder in your web server document root and create the database:

```sql
CREATE DATABASE books;
USE books;

CREATE TABLE books (
  ISBN VARCHAR(50) PRIMARY KEY,
  author VARCHAR(255),
  title VARCHAR(255)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(100),
  lastname VARCHAR(100),
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  apikey VARCHAR(255)
);
```

Both `password` and `apikey` must be stored as hashes created with PHP `password_hash()`.

### Configuration

Database credentials are set in `config/database.php` (default: host `localhost`, database `books`, user `root`, empty password).

The included `.htaccess` forwards the `Authorization` header to PHP when running on Apache.

## API endpoints

All endpoints accept and return JSON and require the header:

```text
Authorization: Bearer <base64 of "email:password:apikey">
```

| Method | Endpoint                      | Body                            | Description           |
| ------ | ----------------------------- | ------------------------------- | --------------------- |
| GET    | `/controller/book/read.php`   | -                               | List all books        |
| POST   | `/controller/book/create.php` | `{ "ISBN", "title", "author" }` | Create a book         |
| POST   | `/controller/book/update.php` | `{ "ISBN", "title", "author" }` | Update a book by ISBN |
| POST   | `/controller/book/delete.php` | `{ "ISBN" }`                    | Delete a book by ISBN |

Example:

```bash
TOKEN=$(printf 'info@example.com:password:apikey' | base64)
curl -H "Authorization: Bearer $TOKEN" http://localhost/php-simple-book-api/controller/book/read.php
```

## Example clients

The scripts in `calls/` (`read.php`, `create.php`, `update.php`, `delete.php`) use the `callAPI()` helper in `calls/class.php` to call the API. Update the URL and the credentials in each script before running them.

## Project structure

```text
├── config/database.php     # PDO connection
├── models/
│   ├── book.php            # Book model (CRUD queries)
│   └── login.php           # Token authentication
├── controller/book/        # API endpoints
└── calls/                  # Example cURL clients
```

## Author

**Davide Balice** – [davidebalice.dev](https://www.davidebalice.dev)
