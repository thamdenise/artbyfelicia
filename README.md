# ArtByFelicia

CodeIgniter 3 website for Felicia Yong's stained glass studio.

The project includes:
- Public pages: Home, Courses, Gallery
- Admin panel: Blog, Gallery, Courses management
- File uploads for blog images, course images, and gallery images

## Tech Stack
- PHP (CodeIgniter 3)
- MySQL/MariaDB
- Apache (XAMPP)
- Composer dependencies (including Stripe SDK and Dompdf)
- jQuery + TinyMCE (admin editor)

## Project Structure
- `application/controllers` - public + admin controllers
- `application/models` - data access models
- `application/views` - public and admin views
- `assets/` - CSS, JS, images, fonts
- `uploads/` - runtime user-uploaded files

## Local Setup (XAMPP)
1. Place the project at:
   - `/Applications/XAMPP/xamppfiles/htdocs/artbyfelicia`
2. Start Apache and MySQL in XAMPP.
3. Install PHP dependencies:
   ```bash
   composer install
   ```
4. Configure app base URL:
   - `application/config/config.php`
5. Configure database connection:
   - `application/config/database.php`
6. Ensure upload/cache/log directories are writable by PHP.

## Main Routes
### Public
- `/` -> `HomeController::index`
- `/courses` -> `CoursesController::index`
- `/gallery` -> `GalleryController::index`

### Admin
- `/admin` -> login
- `/admin/blogs`
- `/admin/add-blog`
- `/admin/edit-blog/{id}`
- `/admin/gallery`
- `/admin/add-image`
- `/admin/edit-image/{id}`
- `/admin/courses`
- `/admin/add-course`
- `/admin/edit-course/{id}`

Routing is defined in `application/config/routes.php`.

## Upload Folders
Runtime uploads are stored in:
- `uploads/blog`
- `uploads/courses`
- `uploads/gallery`

These should generally stay out of Git and be backed up separately in production.

## Git Notes
Current `.gitignore` excludes:
- `/vendor/`
- `/node_modules/`
- `/uploads/*`
- cache/log runtime files
- selected config/controller files

If a file was committed before being added to `.gitignore`, it remains tracked until removed from index.

## Deployment Notes
- Set production `base_url`
- Set production DB credentials
- Create/upload writable directories with correct permissions
- Run `composer install --no-dev` on server

## License
Framework is based on CodeIgniter (MIT). Project-specific assets/content belong to ArtByFelicia.
