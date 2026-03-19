<section class="gallery">
    <div class="gallery-header container">
        <h1 class="gallery-title">Gallery</h1>
    </div>
    <?php /* ?>
    <?php if (!empty($images)) { ?>
        <div class="gallery-grid container">
            <?php foreach ($images as $image) {
                $imageSrc = base_url('uploads/gallery/' . $image['image']);
                $caption = htmlspecialchars($image['caption'], ENT_QUOTES, 'UTF-8');
            ?>
                <figure class="gallery-item">
                    <img src="<?= $imageSrc ?>" alt="<?= $caption ?>" loading="lazy">
                    <figcaption class="gallery-caption">
                        <span><?= $caption ?></span>
                    </figcaption>
                </figure>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p class="gallery-empty container">No images available yet. Check back soon!</p>
    <?php } ?>
    <?php */ ?>

    <?php
    $demoImages = [
        ['src' => 'https://picsum.photos/id/1015/800/600', 'caption' => 'River Mist Morning'],
        ['src' => 'https://picsum.photos/id/1025/800/600', 'caption' => 'Feathered Texture Study'],
        ['src' => 'https://picsum.photos/id/1035/800/600', 'caption' => 'Sunset Cloudscape'],
        ['src' => 'https://picsum.photos/id/1040/800/600', 'caption' => 'Golden Field Horizon'],
        ['src' => 'https://picsum.photos/id/1050/800/600', 'caption' => 'Forest Light Patterns'],
        ['src' => 'https://picsum.photos/id/1063/800/600', 'caption' => 'Soft Petal Closeup'],
        ['src' => 'https://picsum.photos/id/1074/800/600', 'caption' => 'Blooming Wildflowers'],
        ['src' => 'https://picsum.photos/id/1084/800/600', 'caption' => 'Pastel Lake Reflections'],
        ['src' => 'https://picsum.photos/id/1080/800/600', 'caption' => 'Coastal Breeze Sketch'],
        ['src' => 'https://picsum.photos/id/1081/800/600', 'caption' => 'Seafoam Rhythm'],
        ['src' => 'https://picsum.photos/id/109/800/600', 'caption' => 'Vintage Flora Study'],
        ['src' => 'https://picsum.photos/id/110/800/600', 'caption' => 'Cerulean Skywash'],
        ['src' => 'https://picsum.photos/id/111/800/600', 'caption' => 'Garden Morning Dew'],
        ['src' => 'https://picsum.photos/id/112/800/600', 'caption' => 'Rose Blush Echo'],
        ['src' => 'https://picsum.photos/id/113/800/600', 'caption' => 'Amber Grove'],
        ['src' => 'https://picsum.photos/id/114/800/600', 'caption' => 'Cottage Light'],
        ['src' => 'https://picsum.photos/id/115/800/600', 'caption' => 'Saffron Sunset'],
        ['src' => 'https://picsum.photos/id/116/800/600', 'caption' => 'Azure Daydream'],
        ['src' => 'https://picsum.photos/id/117/800/600', 'caption' => 'Lilac Whisper'],
        ['src' => 'https://picsum.photos/id/118/800/600', 'caption' => 'Sunlit Sails']
    ];
    ?>

    <div class="gallery-grid container">
        <?php foreach ($images as $image) {
                    $imageName = is_array($image) ? ($image['image'] ?? '') : $image->image;
                    $rawCaption = is_array($image) ? ($image['caption'] ?? ($image['name'] ?? '')) : ($image->caption ?? ($image->name ?? ''));
                    $imageSrc = !empty($imageName) ? base_url('uploads/gallery/' . $imageName) : '';
                    $caption = htmlspecialchars((string) $rawCaption, ENT_QUOTES, 'UTF-8');
        ?>
            <figure class="gallery-item">
                <img src="<?= $imageSrc ?>" alt="<?= $caption ?>" loading="lazy">
                <figcaption class="gallery-caption">
                    <span><?= $caption ?></span>
                </figcaption>
            </figure>
        <?php } ?>
    </div>
</section>
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/gallery.css?dev=<?= rand(); ?>">
