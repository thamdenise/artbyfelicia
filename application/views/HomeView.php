<link rel="stylesheet" href="<?= base_url(); ?>assets/css/home.css?dev=<?= rand(); ?>">

<section class="section-one">
    <div class="hero-wrapper">
        <img src="<?= base_url(); ?>assets/img/hero.jpeg?v=1" class="hero-image" />
    </div>
</section>
<section class="section-two">
    <div class="section-two-wrapper container">
        <h2>
            Profile
        </h2>
        <p>
            Felicia Yong is a Singapore-based glass artist whose work reveals the lyrical interplay of light, colour, and form. With over four decades in stained glass, she has created luminous artworks for churches, schools, and private spaces, each piece shaped by craftsmanship and quiet narrative.
            <br><br>
            Her practice encompasses stained glass panels and three-dimensional sculptural works that explore light and space. It extends to fused glass, Tiffany-style lamps, metal awards, and large-scale stained glass mosaics with mixed media. Her portfolio ranges from handcrafted pieces to architectural installations.
            <br><br>
            Felicia’s works have received recognition through public commissions, including the skylight at the former Jurong Bird Park, projects for CHIJ Kellock Primary and Holy Innocents’ High School, and ceremonial works for NUS awards.
            <br><br>
            An adjunct lecturer at Nanyang Academy of Fine Arts and mentor in her private studio, she nurtures new makers while continuing to push the expressive boundaries of contemporary glass art.
        </p>
    </div>
</section>
<!-- <section class="courses-section">
    <div class="container flex flex-col flex-vcenter">
        <h2>
            FEATURED COURSES
        </h2>
        <div class="courses flex flex-center">
            <?php foreach ($courses as $key => $course) {
                if ($key < 3) {
            ?>
                    <div class="course">
                        <div class="course-wrapper flex flex-col flex-spread">
                            <div class="course-image-wrapper">
                                <img src="<?= base_url() . 'uploads/courses/' . $course['image']; ?>" />
                            </div>
                            <div class="course-details container">
                                <h3>
                                    <?= $course['name']; ?>
                                </h3>
                                <p>
                                    <?= $course['description']; ?>
                                </p>
                            </div>
                            <div class="duration container flex flex-vcenter flex-col">
                                <p>
                                    <b>Duration: <?= $course['duration']; ?></b>
                                </p>
                                <a href="https://wa.me/6597617528?text=<?= urlencode($course['text_message']); ?>" class="button" target="_blank">
                                    I'm Interested!
                                </a>
                            </div>
                        </div>
                    </div>
            <?php  }
            } ?>
        </div>
        <a href="<?= base_url(); ?>courses" class="view-more">View More</a>
    </div>
</section> -->
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
            A world where the timeless art of stained glass evolves beyond tradition, embracing contemporary expression while honoring its rich heritage. This vision is rooted in preserving the integrity of the craft while continually reimagining its possibilities. Glass becomes more than a material; it becomes a powerful medium that sparks creativity, strengthens community bonds, and supports sustainable practices.
        </p>
        <p>
            Each creation and every workshop is an invitation to celebrate culture, inspire meaningful connection, and shape enduring works that resonate with generations to come.
        </p>
    </div>
</section>
<section class="blogs-section">

</section>

<script>
    $(document).ready(function() {
        initHeroAnimation();
    })

    function initHeroAnimation() {
        $(window).scroll(function() {
            var scrollTop = $(document).scrollTop();
            if (scrollTop > 10) {
                $('.section-one .hero-image').addClass('active');
            } else {
                $('.section-one .hero-image').removeClass('active')
            }
        })
    }
</script>