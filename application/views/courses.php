<section class="courses">
    <div class="courses-hero container">
        <h1>
            Courses by Felicia
        </h1>
        <p class="courses-subtitle">
            Discover stained glass classes for every experience level, crafted with Felicia’s signature style and care.
        </p>
    </div>
    <div class="courses-wrapper container">
        <div class="filter-container flex">
            <div class="filter-button">
                <input id="all" name="all" value="All" type="checkbox" checked>
                <label for="all" class="button">All</label>
            </div>
            <div class="filter-button">
                <input id="taster" name="taster" value="taster" type="checkbox">
                <label for="taster" class="button">Taster</label>
            </div>
            <div class="filter-button">
                <input id="comprehensive" name="comprehensive" value="comprehensive" type="checkbox">
                <label for="comprehensive" class="button">Comprehensive</label>
            </div>
        </div>
        <div class="courses-grid">
            <?php foreach ($courses as $key => $course) { ?>
                <?php
                    $full_description = strip_tags($course['description']);
                    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
                        $snippet = mb_strlen($full_description) > 140 ? mb_substr($full_description, 0, 140) . '…' : $full_description;
                    } else {
                        $snippet = strlen($full_description) > 140 ? substr($full_description, 0, 140) . '…' : $full_description;
                    }
                ?>
                <article class="course-card" data-name="<?= strtolower($course['name']); ?>">
                    <div class="course-media">
                        <img src="<?= base_url() . 'uploads/courses/' . $course['image']; ?>?v=<?= rand(); ?>" alt="<?= $course['name']; ?>" />
                    </div>
                    <div class="course-body">
                        <h2>
                            <?= $course['name']; ?>
                        </h2>
                        <p class="course-description" data-full="<?= htmlspecialchars($course['description'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?= htmlspecialchars($snippet, ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                        <p class="course-duration">
                            Duration: <?= $course['duration']; ?>
                        </p>
                        <div class="course-actions">
                            <a href="https://wa.me/6597617528?text=<?= urlencode($course['text_message']); ?>" class="course-pill" target="_blank" rel="noopener">
                                I'm Interested
                            </a>
                            <button
                                class="course-view button"
                                type="button"
                                data-title="<?= htmlspecialchars($course['name'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-description="<?= htmlspecialchars($course['description'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-duration="<?= htmlspecialchars($course['duration'], ENT_QUOTES, 'UTF-8'); ?>"
                                data-image="<?= base_url() . 'uploads/courses/' . $course['image']; ?>?v=<?= rand(); ?>">
                                View Course
                            </button>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
<div class="course-modal" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="course-modal-backdrop"></div>
    <div class="course-modal-content" role="document">
        <button class="course-modal-close" type="button" aria-label="Close">×</button>
        <div class="course-modal-media">
            <img src="" alt="" />
        </div>
        <div class="course-modal-body">
            <h2></h2>
            <p class="course-modal-description"></p>
            <p class="course-modal-duration"></p>
            <a class="course-modal-cta button" href="#" target="_blank" rel="noopener">I'm Interested</a>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/courses.css?dev=<?= rand(); ?>">
<script>
    $(document).ready(function() {
        filterCourses();
    });

    function filterCourses() {
        $(document).on('click','.filter-button .button', function() {
            var parent = $(this).closest('.filter-button');
            var input = parent.find('input');
            // input.prop('checked', true);
            parent.siblings().find('input').prop('checked', false);
            var value = input.val().toLowerCase();
            if (value == 'all') {
                $('.course-card').show();
            } else {
                $('.course-card').hide();
                $('.course-card').each( function() {
                    var name = $(this).data('name');
                    if (name.includes(value)) {
                        $(this).show();
                    }
                })
            }
        })
    }

    $(document).on('click', '.course-view', function() {
        var $card = $(this).closest('.course-card');
        var title = $(this).data('title');
        var description = $(this).data('description');
        var duration = $(this).data('duration');
        var image = $(this).data('image');
        var interestedLink = $card.find('.course-pill').attr('href');

        $('.course-modal h2').text(title);
        $('.course-modal-description').html(description);
        $('.course-modal-duration').text('Duration: ' + duration);
        $('.course-modal-media img').attr('src', image).attr('alt', title);
        $('.course-modal-cta').attr('href', interestedLink);

        $('.course-modal').addClass('open').attr('aria-hidden', 'false');
        $('body').addClass('modal-open');
    });

    $(document).on('click', '.course-modal-close, .course-modal-backdrop', function() {
        closeCourseModal();
    });

    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCourseModal();
        }
    });

    function closeCourseModal() {
        $('.course-modal').removeClass('open').attr('aria-hidden', 'true');
        $('body').removeClass('modal-open');
    }
</script>
