<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Viewport meta tag for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta title (displayed as the page title) -->
    <title>ArtByFelicia - Stained Glass Courses</title>

    <!-- Meta description for search engines and link previews -->
    <meta name="description" content="Join ArtByFelicia’s stained glass courses! Learn the art of stained glass with expert guidance from Felicia.">

    <!-- Favicon for browser and app icons -->
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets/img/favicon.jpg?v=2">

    <!-- Open Graph meta tags for social media link previews (e.g., Telegram, WhatsApp) -->
    <meta property="og:title" content="ArtByFelicia - Stained Glass Courses">
    <meta property="og:description" content="Master the art of stained glass with Felicia’s expert-led courses at ArtByFelicia. Enroll now to create stunning glass art!">
    <meta property="og:image" content="<?= base_url(); ?>assets/img/favicon.jpg?v=2">
    <meta property="og:url" content="<?= base_url(); ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card meta tags for Twitter sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ArtByFelicia - Stained Glass Courses">
    <meta name="twitter:description" content="Master the art of stained glass with Felicia’s expert-led courses at ArtByFelicia. Enroll now to create stunning glass art!">
    <meta name="twitter:image" content="<?= base_url(); ?>assets/img/favicon.jpg?v=2">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css?dev=<?= rand(); ?>">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/header.css?dev=<?= rand(); ?>">
<?php
    $active_controller = $this->router->fetch_class();
    $active_method = $this->router->fetch_method();
    $is_home = $active_controller === 'HomeController' && $active_method === 'index';
    $is_courses = $active_controller === 'CoursesController';
    $is_gallery = $active_controller === 'GalleryController';
?>
<header <?php if (!$is_home) { ?> class="active" <?php } ?> >
    <div class="header-wrapper container flex flex-vcenter flex-spread">
        <a class="brand" href="<?= base_url(); ?>">
            <img src="<?= base_url(); ?>assets/img/logo-transparent.svg?v=1" alt="ArtByFelicia Logo" class="header-logo black-logo" />
            <img src="<?= base_url(); ?>assets/img/logo-white-transparent.svg?v=1" alt="ArtByFelicia Logo" class="header-logo white-logo" />
        </a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-menu">
            <span class="sr-only">Menu</span>
            <span class="bar bar-1"></span>
            <span class="bar bar-2"></span>
            <span class="bar bar-3"></span>
        </button>
        <nav id="site-menu" class="site-nav site-menu" aria-label="Main">
            <a class="nav-link <?php if ($is_home) { ?>is-active<?php } ?>" href="<?= base_url(); ?>">Home</a>
            <a class="nav-link <?php if ($is_courses) { ?>is-active<?php } ?>" href="<?= base_url(); ?>courses">Courses</a>
            <a class="nav-link <?php if ($is_gallery) { ?>is-active<?php } ?>" href="<?= base_url(); ?>gallery">Gallery</a>
        </nav>
    </div>
</header>

<script>
    $(document).ready(function() {
        initMenuToggle();
<?php if ($is_home) { ?>
        initHeaderAnimation();
<?php } ?>
    });

    function initMenuToggle() {
        var $header = $('header');
        var $toggle = $('.menu-toggle');
        var $menuLinks = $('.site-menu .nav-link');

        $toggle.on('click', function() {
            var isOpen = $header.hasClass('menu-open');
            $header.toggleClass('menu-open', !isOpen);
            $toggle.attr('aria-expanded', (!isOpen).toString());
        });

        $menuLinks.on('click', function() {
            if ($header.hasClass('menu-open')) {
                $header.removeClass('menu-open');
                $toggle.attr('aria-expanded', 'false');
            }
        });

        $(window).on('resize', function() {
            if (window.innerWidth > 767 && $header.hasClass('menu-open')) {
                $header.removeClass('menu-open');
                $toggle.attr('aria-expanded', 'false');
            }
        });
    }

    function initHeaderAnimation() {
        $(window).scroll(function() {
            var scrollTop = $(document).scrollTop();
            if (scrollTop > 10) {
                $('header').addClass('active');
            } else {
                $('header').removeClass('active');
            }
        });
    }
</script>
<main class="main-content">
