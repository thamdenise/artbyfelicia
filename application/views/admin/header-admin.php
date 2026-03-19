<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard - Felicia Yong</title>
    <!-- <link rel="apple-touch-icon" sizes="200x200" href="<?= base_url(); ?>assets/img/favicon_200x200.png?dev=1">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon.png?dev=1">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon_32x32.png?dev=1">
  <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/img/favicon_16x16.png?dev=1"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css?dev=<?= rand(); ?>">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/admin/blogs.css?dev=<?= rand(); ?>">
</head>

<body>
    <header class="admin-header">
        <nav class="admin-nav">
            <div class="admin-nav-left">
                <a href="<?= base_url(); ?>admin/blogs" class="admin-brand">
                    <span class="admin-icon admin-icon--lg" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 20a7 7 0 1 0-7-7 7 7 0 0 0 7 7z"></path>
                            <path d="M12 4v2"></path>
                            <path d="M4.9 6.1l1.4 1.4"></path>
                            <path d="M3 12h2"></path>
                            <path d="M4.9 17.9l1.4-1.4"></path>
                            <path d="M12 20v0"></path>
                            <path d="M17.7 17.9l-1.4-1.4"></path>
                            <path d="M19 12h2"></path>
                            <path d="M17.7 6.1l-1.4 1.4"></path>
                        </svg>
                    </span>
                    Felicia Yong Admin
                </a>
            </div>
            <div class="admin-nav-right">
                <a href="<?= base_url(); ?>admin/blogs">
                    <span class="admin-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <path d="M14 2v6h6"></path>
                            <path d="M16 13H8"></path>
                            <path d="M16 17H8"></path>
                            <path d="M10 9h-2"></path>
                        </svg>
                    </span>
                    Blogs
                </a>
                <a href="<?= base_url(); ?>admin/courses">
                    <span class="admin-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                    </span>
                    Courses
                </a>
                <a href="<?= base_url(); ?>admin/gallery">
                    <span class="admin-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <path d="M21 15l-5-5-11 11"></path>
                        </svg>
                    </span>
                    Gallery
                </a>
                <a href="<?= base_url(); ?>" target="_blank">
                    <span class="admin-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M2 12h20"></path>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </span>
                    View Site
                </a>
                <a href="<?= base_url(); ?>admin/logout" class="admin-logout">
                    <span class="admin-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <path d="M16 17l5-5-5-5"></path>
                            <path d="M21 12H9"></path>
                        </svg>
                    </span>
                    Logout
                </a>
            </div>
        </nav>
    </header>

    <main class="admin-content">
