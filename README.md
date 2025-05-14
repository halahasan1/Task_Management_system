
# Task Management API

This is a RESTful API built with Laravel for managing tasks, comments, and statuses with role-based permissions. It follows best practices using Form Requests, Policies, Gates, and a Service Layer for clean, maintainable code.

## Features

* Full CRUD operations for tasks, statuses, and comments
* Role-based access control (manager, team-lead, member)
* Permissions managed using Laravel Policies and Gates
* Request validation using Form Requests
* Task filtering and searching (title, priority, status, etc.)
* Clean service-based architecture
* Ready for testing with Postman or other API tools

## Installation

1. Clone the repository:

   ```
   git clone https://github.com/halahasan1/Task_Management_system.git
   cd task-api
   ```

2. Install dependencies:

   ```
   composer install
   ```

3. Copy the `.env` file:

   ```
   cp .env.example .env
   ```

4. Generate application key:

   ```
   php artisan key:generate
   ```

5. Configure the `.env` file with your database credentials:

   ```
   DB_DATABASE=your_db
   DB_USERNAME=your_user
   DB_PASSWORD=your_password
   ```

6. Run migrations and seeders:

   ```
   php artisan migrate --seed
   ```

7. Start the development server:

   ```
   php artisan serve
   ```

[Postman Collection](https://www.postman.com/research-geoscientist-78470583/workspace/my-workspace/collection/39063412-eefc694e-17f5-436a-a24e-b6ce08cb981c?action=share&creator=39063412)

## API Endpoints

| Method | Endpoint           | Description                        |
| ------ | ------------------ | ---------------------------------- |
| GET    | /api/tasks         | List all tasks (with filters)      |
| POST   | /api/tasks         | Create a new task                  |
| PUT    | /api/tasks/{id}    | Update a task                      |
| DELETE | /api/tasks/{id}    | Delete a task                      |
| POST   | /api/comments      | Add a comment to a task            |
| PUT    | /api/comments/{id} | Update a comment                   |
| DELETE | /api/comments/{id} | Delete a comment                   |
| GET    | /api/statuses      | List all statuses                  |
| POST   | /api/statuses      | Create a new status (manager only) |
| PUT    | /api/statuses/{id} | Update a status                    |
| DELETE | /api/statuses/{id} | Delete a status                    |

## User Roles and Access

| Role      | Capabilities                            |
| --------- | --------------------------------------- |
| Manager   | Full access including status management |
| Team Lead | Create/update tasks and comments        |
| Member    | View tasks, write comments              |

* Policies are used for tasks and comments.
* Gates are used for status management (`manage-statuses`).

## Filtering and Search

Tasks can be filtered using query parameters:

* `search` (by title)
* `priority`
* `created_by`
* `assigned_to`
* `status_id`

Example:

```
GET /api/tasks?search=feature&priority=high
```

## Testing

* Use Postman or similar tools to test the endpoints.
* Authorization headers may be required depending on the authentication method used.


## Project Structure

* `app/Http/Controllers/Api/` - API controllers
* `app/Services/` - Business logic
* `app/Policies/` - Authorization logic
* `app/Http/Requests/` - Form validation
* `database/seeders/` - Sample data

