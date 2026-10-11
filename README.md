
# Equipment Management API

**Course:**  CIT 3102 – Systems Integration and Architecture  
**Activity:**  Module 5 – Build an API  
**Partner 1:**  Petaca, Aegene Troy R.
**Partner 2:**  Assin, Miguel James 
**Section:**  IT1E  
**Resource:**  Equipment

## 1. Project Setup

This project is a REST API created using Laravel, SQLite, and Laravel Sanctum. It allows authenticated users to create, view, update, and delete equipment records.

### Requirements
- PHP 8.4 or compatible version
- Composer
- Laravel
- SQLite support
- Bruno API Client
- Git

### Installation Steps

1. Clone the public GitHub repository.

   git clone https://github.com/itscarms/cit3102-m5-equipment.git

2. Enter the project directory.

   cd cit3102-m5-equipment

3. Install the project dependencies.

   composer install

4. Copy the environment configuration.

   Windows:
   copy .env.example .env

   macOS/Linux:
   cp .env.example .env

5. Generate the application key.

   php artisan key:generate

6. Set the database connection in the .env file.

   DB_CONNECTION=sqlite

7. Create the SQLite database file if it does not exist.

   Windows Command Prompt:
   if not exist database\database.sqlite type nul > database\database.sqlite

   macOS/Linux:
   touch database/database.sqlite

8. Run the database migrations.

   php artisan migrate

9. Start the Laravel development server.

   php artisan serve

10. Open Bruno and test the API using:

    http://127.0.0.1:8000/api

Protected endpoints require a Bearer token obtained through the login endpoint.

## 2. API Routes

| HTTP Method | Endpoint | Description | Token Required |
|---|---|---|---|
| POST | /api/register | Registers a new user | No |
| POST | /api/login | Authenticates a user and generates a token | No |
| POST | /api/logout | Logs out and revokes the current token | Yes |
| GET | /api/me | Retrieves the authenticated user | Yes |
| GET | /api/equipment | Retrieves equipment records and supports filtering | Yes |
| POST | /api/equipment | Creates a new equipment record | Yes |
| GET | /api/equipment/{equipment} | Retrieves equipment by ID | Yes |
| PUT | /api/equipment/{equipment} | Updates an existing equipment record | Yes |
| DELETE | /api/equipment/{equipment} | Deletes an equipment record | Yes |

### Equipment Fields

| Field | Data Type |
|---|---|
| name | String |
| category | String |
| location | String |
| quantity | Integer |
| condition | String |

Filtering is supported through the category and location query parameters.

Example:

GET /api/equipment?category=Computer&location=Room%20101

## 3. Bruno API Testing Screenshots

### Test 1 – Register User (201 Created)

![Register User](Screenshots/01%20-%20Register.png)

### Test 2 – Login User (200 OK)

![Login User](Screenshots/02%20-%20Login.jpg)

### Test 3 – Access Equipment Without Token (401 Unauthorized)

![Without Token](Screenshots/03%20-%20Equipment%20No%20Token.png)

### Test 4 – Access Equipment With Token (200 OK)

![With Token](Screenshots/04%20-%20Equipment%20With%20Token.png)

### Test 5 – Create Equipment (201 Created)

![Create Equipment](Screenshots/05%20-%20Create%20Equipment.png)

### Test 6 – Missing Required Field (422 Unprocessable Entity)

![Validation Error](Screenshots/06%20-%20Missing%20Required%20Field.png)

### Test 7 – Get Equipment by ID (200 OK)

![Get Equipment](Screenshots/07%20-%20Get%20Equipment%20By%20ID.png)

### Test 8 – Equipment Not Found (404 Not Found)

![Not Found](Screenshots/08%20-%20Equipment%20Not%20Found.png)

### Test 9 – Update Equipment (200 OK)

![Update Equipment](Screenshots/09%20-%20Update%20Equipment.png)

### Test 10 – Delete Equipment (204 No Content)

![Delete Equipment](Screenshots/10%20-%20Delete%20Equipment.png)

## 4. Why Does DELETE Return 204 Instead of 200?

For me, DELETE returns 204 because the requested equipment was successfully deleted and the server does not need to send back any information. The status code already tells us that the action was successful. A 200 status can also mean success, but it is usually used when the server returns a response body. Since there is nothing else to display after deleting the equipment, 204 No Content is more appropriate.
