<?php
$rows = $imageData;
$imageName = is_array($rows) ? ($rows['image'] ?? '') : ($rows->image ?? '');
$rawCaption = is_array($rows) ? ($rows['caption'] ?? ($rows['name'] ?? '')) : ($rows->caption ?? ($rows->name ?? ''));
$caption = htmlspecialchars((string) $rawCaption, ENT_QUOTES, 'UTF-8');
$id = is_array($rows) ? ($rows['id'] ?? '') : ($rows->id ?? '');
$imageSrc = !empty($imageName) ? base_url('uploads/gallery/' . $imageName) : '';
?>

<div class="admin-container">
    <div class="admin-page-header">
        <h1 class="admin-page-title">Edit Gallery Image</h1>
    </div>

    <div class="form-card">
        <?= form_open_multipart(base_url() . "admin/edit-image/" . $id); ?>
        <input type="hidden" name="admin_form_submit_token" value="<?= $admin_form_submit_token ?>">

        <div class="image-preview">
            <label>Current Image:</label>
            <?php if (!empty($imageSrc)) { ?>
                <img src="<?= $imageSrc ?>" width="300" alt="<?= $caption ?>" />
            <?php } else { ?>
                <p>N/A</p>
            <?php } ?>
        </div>

        <div class="custom-file">
            <input type="file" class="custom-file-input files" id="gallery_image" name="gallery_image" accept="image/jpeg, image/jpg, image/png, image/webp">
            <label class="custom-file-label" for="gallery_image">Change image (leave empty to keep current)</label>
        </div>

        <div class="form-group">
            <label for="image_caption">Image Caption *</label>
            <input type="text" class="form-control" id="image_caption" name="image_caption" placeholder="Enter a descriptive caption for the image" value="<?= $caption ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit" id="submitBtn" class="mw-button btn-submit">
                <span class="admin-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <path d="M17 21v-8H7v8"></path>
                        <path d="M7 3v5h8"></path>
                    </svg>
                </span>
                Update Image
            </button>
            <a href="<?= base_url(); ?>admin/gallery" class="mw-button btn-cancel">
                <span class="admin-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 6L6 18"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                </span>
                Cancel
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
    $(document).on('change input', '.custom-file input', function() {
        if (!this.files || !this.files.length) {
            return;
        }
        var filename = this.files[0].name;
        $(this).siblings(".custom-file-label").text(filename);
    });

    $('form').on('submit', function() {
        $('#submitBtn').prop('disabled', true);
    });
</script>

</main>
</body>
</html>
