# ByteBuild — Build Your Perfect PC

## Current structure

```text
index.html              public single-page experience
css/style.css           responsive dark navy/cyan UI
js/data.js              component data, advisor, builder and compatibility logic
api/orders.php          prepared-statement contact request endpoint
config/db.php           PDO connection using environment variables
database/schema.sql     MySQL schema and relationships
admin/index.php         protected admin dashboard entry point
html/index.html         redirect to the public entry point
```

## Run locally

The public experience works directly from `index.html`. For PHP requests and MySQL:

1. Create a MySQL database by importing `database/schema.sql`.
2. Set `BYTEBUILD_DB_HOST`, `BYTEBUILD_DB_NAME`, `BYTEBUILD_DB_USER`, and `BYTEBUILD_DB_PASS`.
3. Serve the project with PHP: `php -S localhost:8000`.
4. Open `http://localhost:8000/index.html`.

The contact form uses `api/orders.php` over HTTP and has a safe local-file fallback for previewing the UI.

## Implemented

- Responsive marketing homepage with advisor, builder, builds, components and contact sections.
- Four-step PC Advisor with usage, budget, preferences, and three generated recommendations.
- PC Builder with selectable categories, estimated total, compatibility rules for socket, memory, cooler socket and PSU capacity.
- Component filtering/sorting and detail contact feedback.
- Contact request validation on the client and PHP server, with prepared SQL statements.
- MySQL schema for users, admins, components, builds, orders, contacts and compatibility rules.

## Next production steps

Admin CRUD screens, secure admin login/session middleware, image upload, database-backed component/build APIs, CSRF protection and server-side compatibility validation should be added before production deployment. No default admin password is included intentionally.
