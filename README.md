# ArtByFelicia

CodeIgniter 3 site for Felicia Yong's stained glass studio. Public pages showcase courses and the gallery; an admin area lets Felicia manage blog posts, gallery images, and courses (images stored in `/uploads`). This document maps every page so another developer can pick it up quickly.

## Tech & setup
- PHP 7.x+ with Composer (see `composer.json`), Apache/Nginx configured to point at `index.php`.
- Configure `base_url` and database credentials in `application/config/config.php` and `application/config/database.php`.
- Writable directories: `/uploads/blog`, `/uploads/courses`, `/uploads/gallery` (auto-created in admin flows) plus `application/cache` if you enable CI caching.
- Dependencies installed via `composer install`; front-end uses vanilla PHP views plus jQuery, Swiper, and TinyMCE (admin add/edit blog).

## Public site pages
- `/` → `HomeController::index` → `application/views/HomeView.php` (layout via `header.php`/`footer.php`). Pulls `CoursesModel::list()` to show the first three courses, links out to WhatsApp using each course's `text_message` seed, and includes hero/vision copy. Styles: `assets/css/home.css`, `assets/css/header.css`, `assets/css/main.css`.
- `/courses` → `CoursesController::index` → `application/views/courses.php`. Lists every course from `CoursesModel::list()` with image, description, duration, and WhatsApp CTA. Includes filter UI (All/Taster/Comprehensive) driven by jQuery. Styles: `assets/css/courses.css`, shared header/footer CSS.
- `/gallery` → `GalleryController::index` → `application/views/gallery.php`. Intended to render uploaded gallery images from `GalleryModel::list([], true)`. Currently swapped to demo placeholders (see `$demoImages` in the view); switch back by restoring the commented block. Styles: `assets/css/gallery.css`.
- Shared layout: `application/views/header.php` injects meta tags, global CSS/JS, and a scroll-reactive header; `footer.php` holds social links and copyright. Global utilities and typography live in `assets/css/main.css`.

## Admin pages (auth required)
- `/admin` → `admin/AdminController::index` → `application/views/admin/login.php`. Checks credentials against the `admin` table (password verified with `password_verify`). On success, stores `session_admin_login` and redirects to `/admin/blogs`. Logout at `/admin/logout` clears the session.
- `/admin/blogs` → `admin/BlogPostController::index` → `application/views/admin/blogs.php`. Lists blog posts (from `blogpost` table) with image preview, title, and published date; links to edit/delete.
  - `/admin/add-blog` → form at `application/views/admin/add-blog.php`. Requires title, publish date, image (upload to `/uploads/blog`), alt/meta fields, content (TinyMCE). Duplicate submits guarded by `AdminModel::setAdminFormSubmitToken` / `checkAdminFormSubmitToken`.
  - `/admin/edit-blog/{id}` → `application/views/admin/edit-blog.php` (not open in IDE but wired in controller) to update fields and optionally replace images/author image.
  - `/admin/delete-blog/{id}/{filename}` → deletes DB record and uploaded file.
- `/admin/gallery` → `admin/GalleryController::index` → `application/views/admin/gallery.php`. Shows gallery images and allows deletion. Data from `GalleryModel::list([], true)`.
  - `/admin/add-image` → `application/views/admin/add-image.php`. Uploads an image to `/uploads/gallery`, requires caption, and stores record via `GalleryModel::store()`.
  - `/admin/delete-image/{id}` → deletes DB row and the uploaded file.
- `/admin/courses` → `admin/CoursesController::index` → `application/views/admin/courses.php`. Lists courses (image, name, duration) with edit/delete actions.
  - `/admin/add-course` → `application/views/admin/add-course.php`. Uploads course image to `/uploads/courses` and stores name/description/duration/text_message.
  - `/admin/edit-course/{id}` → `application/views/admin/edit-course.php`. Updates text fields and optionally swaps the image.
  - `/admin/delete-course/{id}/{filename}` → removes DB row and uploaded image.

## Data models & storage
- Models: `CoursesModel`, `BlogPostModel`, `GalleryModel`, and `AdminModel` sit in `application/models`. CRUD helpers like `list()`, `store()`, and `edit()` are used in controllers; DB tables expected: `courses`, `blogpost`, `gallery`, `admin`.
- Upload targets: `/uploads/blog`, `/uploads/courses`, `/uploads/gallery` (created on demand). File names are generated with prefixes like `blogpost_<rand>_<timestamp>`.
- Form spam/duplicate protection: admin create/edit forms use a session-backed token (`admin_form_submit_token`).

## Notes for the next developer
- If you swap the gallery off demo data, restore the real image loop in `application/views/gallery.php` and ensure `/uploads/gallery` is writable.
- Header meta tags are currently static; update `application/views/header.php` if you need per-page SEO overrides.
- Scripts pull jQuery/Swiper/TinyMCE from CDNs; vendor-less fallback isn't included. Pin or self-host if offline deployments are required.
