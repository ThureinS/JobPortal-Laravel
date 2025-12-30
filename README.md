# Job Portal

A web application for job posting and application management built with Laravel 12. Employers can post job listings, and job seekers can browse, filter, and apply for positions with CV uploads.

> **Note:** This is a learning project.

## Features

### For Job Seekers

-   **Browse Jobs**: View all available job postings with company information
-   **Advanced Filtering**: Filter jobs by:
    -   Text search (title, description, company name)
    -   Salary range (min/max)
    -   Experience level (Entry, Intermediate, Senior)
    -   Category (IT, Finance, Sales, Marketing)
-   **Apply for Jobs**: Submit applications with expected salary and CV (PDF upload)
-   **Manage Applications**: View and withdraw your submitted applications
-   **Application Stats**: See total applicants and average expected salary for each job

### For Employers

-   **Employer Registration**: Register as an employer with company name
-   **Post Jobs**: Create job listings with title, description, location, salary, experience level, and category
-   **Manage Listings**: Edit or delete your job posts
-   **View Applicants**: See all applications for your jobs, including applicant details and expected salaries
-   **Soft Deletes**: Deleted job posts are soft-deleted, preserving application history

### Authentication & Authorization

-   User login/logout with session management
-   "Remember me" functionality
-   Policy-based authorization:
    -   Only employers can post jobs
    -   Only job owners can edit/delete their posts
    -   Users can only apply once per job
    -   Jobs with applications cannot be edited

## Tech Stack

| Technology   | Version | Purpose                |
| ------------ | ------- | ---------------------- |
| PHP          | ^8.2    | Backend runtime        |
| Laravel      | 12.x    | Web framework          |
| SQLite       | -       | Database (default)     |
| Tailwind CSS | 4.x     | Styling                |
| Alpine.js    | 3.x     | Frontend interactivity |
| Vite         | 7.x     | Asset bundling         |

### Dev Dependencies

-   **Laravel Debugbar** - Debugging and profiling
-   **Laravel Pail** - Real-time log viewer
-   **Laravel Sail** - Docker development environment
-   **PHPUnit** - Testing framework

## Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js and npm

### Quick Setup

```bash
# Clone the repository
git clone <repository-url>
cd job-portal

# Run the setup script (installs dependencies, creates .env, runs migrations, builds assets)
composer setup
```

### Manual Setup

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Install Node dependencies
npm install

# Build frontend assets
npm run build
```

### Database Seeding (Optional)

Seed the database with sample data (300 users, 20 employers, 100 job posts, and random applications):

```bash
php artisan db:seed
```

## Running the Application

### Development Mode

Start all services concurrently (server, queue worker, log viewer, Vite):

```bash
composer dev
```

This runs:

-   Laravel development server at `http://localhost:8000`
-   Queue worker for background jobs
-   Laravel Pail for real-time logs
-   Vite dev server for hot module replacement

### Individual Services

```bash
# Start Laravel server only
php artisan serve

# Start Vite dev server only
npm run dev
```

## Database Schema

```
erDiagram
    users {
        bigint id PK
        string name
        string email UK
        timestamp email_verified_at "nullable"
        string password
        string remember_token "nullable"
        timestamp created_at
        timestamp updated_at
    }

    employers {
        bigint id PK
        string company_name
        bigint user_id FK "nullable"
        timestamp created_at
        timestamp updated_at
    }

    job_posts {
        bigint id PK
        string title
        text description
        unsignedInteger salary
        string location
        string category
        enum experience
        bigint employer_id FK
        timestamp deleted_at "nullable"
        timestamp created_at
        timestamp updated_at
    }

    job_applications {
        bigint id PK
        bigint user_id FK
        bigint job_post_id FK
        unsignedInteger expected_salary
        string cv_path "nullable"
        timestamp created_at
        timestamp updated_at
    }

    users ||--o| employers : "owns"
    employers ||--o{ job_posts : "posts"
    users ||--o{ job_applications : "applies"
    job_posts ||--o{ job_applications : "receives"
}
```

### Relationships

-   **User → Employer**: One-to-One (a user can optionally be an employer)
-   **Employer → JobPost**: One-to-Many (an employer can post multiple jobs)
-   **User → JobApplication**: One-to-Many (a user can submit multiple applications)
-   **JobPost → JobApplication**: One-to-Many (a job can receive multiple applications)

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php         # Login/logout
│   │   ├── EmployerController.php     # Employer registration
│   │   ├── JobApplicationController.php   # Job application submission
│   │   ├── JobPostController.php      # Public job browsing
│   │   ├── MyJobApplicationController.php # User's applications management
│   │   └── MyJobController.php        # Employer's job management
│   ├── Middleware/
│   │   └── Employer.php               # Ensures user is an employer
│   └── Requests/
│       └── JobRequest.php             # Job post validation
├── Models/
│   ├── Employer.php
│   ├── JobApplication.php
│   ├── JobPost.php                    # Includes filtering scope
│   └── User.php
├── Policies/
│   ├── EmployerPolicy.php
│   └── JobPostPolicy.php              # Authorization rules
└── View/
    └── Components/                    # Blade components

resources/views/
├── auth/                              # Login page
├── components/                        # Reusable UI components
│   ├── bread-crumbs.blade.php
│   ├── button.blade.php
│   ├── card.blade.php
│   ├── job-card.blade.php
│   ├── label.blade.php
│   ├── layout.blade.php
│   ├── link-button.blade.php
│   ├── radio-group.blade.php
│   ├── tag.blade.php
│   └── text-input.blade.php
├── employer/                          # Employer registration
├── job-posts/                         # Job browsing views
├── job_application/                   # Application form
├── my_job/                            # Employer job management
└── my_job_application/                # User's applications

routes/
└── web.php                            # All application routes
```

## Routes Overview

| Method | URI                                        | Description                | Auth  |
| ------ | ------------------------------------------ | -------------------------- | ----- |
| GET    | `/`                                        | Redirect to job listings   | No    |
| GET    | `/job-posts`                               | Browse all jobs            | No    |
| GET    | `/job-posts/{job_post}`                    | View job details           | No    |
| GET    | `/login`                                   | Login page                 | No    |
| POST   | `/auth`                                    | Authenticate user          | No    |
| DELETE | `/logout`                                  | Logout user                | Yes   |
| GET    | `/job-posts/{job_post}/application/create` | Application form           | Yes   |
| POST   | `/job-posts/{job_post}/application`        | Submit application         | Yes   |
| GET    | `/my-job-applications`                     | View my applications       | Yes   |
| DELETE | `/my-job-applications/{id}`                | Withdraw application       | Yes   |
| GET    | `/employer/create`                         | Employer registration form | Yes   |
| POST   | `/employer`                                | Register as employer       | Yes   |
| GET    | `/my-jobs`                                 | Employer's job listings    | Yes\* |
| GET    | `/my-jobs/create`                          | Create job form            | Yes\* |
| POST   | `/my-jobs`                                 | Create job                 | Yes\* |
| GET    | `/my-jobs/{id}/edit`                       | Edit job form              | Yes\* |
| PUT    | `/my-jobs/{id}`                            | Update job                 | Yes\* |
| DELETE | `/my-jobs/{id}`                            | Delete job                 | Yes\* |

\*Requires employer middleware
