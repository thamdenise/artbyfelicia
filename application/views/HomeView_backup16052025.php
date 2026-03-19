<link rel="stylesheet" href="<?= base_url(); ?>assets/css/home.css?dev=<?= rand(); ?>">

<section class="section-one">
    <div class="hero-wrapper">
        <img src="<?= base_url(); ?>assets/img/hero-5.jpeg" class="hero-image" />
    </div>
</section>
<section class="section-two">
    <div class="section-two-wrapper container">
        <h2>
            ABOUT
        </h2>
        <p>
            Felicia Yong, a pioneer in Singapore’s stained glass scene, began her craft over 40 years ago with Pegasus Stained Glass Studio. She later founded The Glass Atelier in 1995, creating iconic works like the Old Jurong Bird Park skylight and awards such as the NUS Best Researcher Award. Passionate about sharing her craft, she conducts workshops to inspire creativity and uses stained glass to foster connections, ensuring this traditional art form remains vibrant and inclusive.
        </p>
    </div>
</section>
<section class="courses-section">
    <div class="courses-swiper container">
        <h2>
            COURSES
        </h2>
        <div class="swiper-wrapper">
            <?php foreach ($courses as $course) { ?>
                <div class="swiper-slide course">
                    <div class="course-wrapper flex flex-col flex-spread">
                        <div class="course-image-wrapper">
                            <img src="<?= base_url(); ?>assets/img/courses/sun-catcher.jpg" alt="<?= $course['name']; ?>" />
                        </div>
                        <div class="course-details container">
                            <h3>
                                <?= $course['name']; ?>
                            </h3>
                            <p>
                                <?= $course['description']; ?>
                            </p>
                        </div>
                        <div class="duration container flex">
                            <p>
                                <b>Duration: <?= $course['duration']; ?></b>
                            </p>
                            <a href="https://wa.me/6597617528?text=<?= urlencode($course['text_message']); ?>" class="button" target="_blank">
                                I'm Interested!
                            </a>
                        </div>
                    </div>
                </div>
            <?php  } ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5c5c5c">
                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
            </svg>
        </div>
        <div class="swiper-button-next">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5c5c5c">
                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
            </svg>
        </div>
    </div>
</section>
<section class="section-three">
    <div class="section-three-wrapper container">
        <!-- <img src="<?= base_url(); ?>assets/img/felicia.jpeg" /> -->
        <img src="https://cassette.sphdigital.com.sg/image/zaobao/e3a820d9d6003bee63af59ab89978592e3bc273acba6e64efeb3803cee8732b9" alt="Felicia Yong" class="section-three-image" />
        <p class="caption">
            Source: <a href="https://www.zaobao.com.sg/lifestyle/feature/story20250113-5714161" target="_blank">Lianhe Zaobao</a>
        </p>
        <h2>
            VISION
        </h2>
        <p>
            Felicia Yong envisions a world where the timeless art of stained glass transcends its traditional boundaries to inspire creativity, foster connections, and promote sustainability. She is committed to preserving this craft while innovating its applications, using stained glass as a medium to bring people together, celebrate cultural heritage, and create meaningful, enduring works that resonate with future generations.
        </p>
    </div>
</section>
<section class="blogs-section">
    
</section>

<script>
    $(document).ready(function() {
        initHeroAnimation();
        const swiper = new Swiper('.courses-swiper', {
            speed: 400,
            spaceBetween: 10,
            slidesPerView: 1,
            loop: true,
            breakpoints: {
                989: {
                    slidesPerView: 3,
                    spaceBetween: 20
                }
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },  
        });

        sizeSlides();
    })

    function initHeroAnimation() {
        $(window).scroll(function() {
            var scrollTop = $(document).scrollTop();
            if (scrollTop > 10) {
                $('.section-one .hero-image').addClass('active');
                $('header').addClass('active');
            } else {
                $('.section-one .hero-image').removeClass('active')
                $('header').removeClass('active')
            }
        })
    }

    function sizeSlides() {
        var height = 0;
        $('.courses-section .course').each(function() {
            if ($(this).outerHeight(true) > height) {
                height = $(this).outerHeight(true);
            }
        });
        $('.courses-section .course').height(height + 'px');
    }
</script>