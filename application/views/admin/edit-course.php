<?php
$rows = $results;
$id = $rows->id;
$image = $rows->image;
$name = $rows->name;
$description = $rows->description;
$duration = $rows->duration;
$text_message = $rows->text_message;
?>

<div class="admin-container">
  <div class="admin-page-header">
    <h1 class="admin-page-title">Edit Course</h1>
  </div>

  <div class="form-card">
    <?= form_open_multipart(base_url() . "admin/edit-course/" . $id); ?>
    <input type="hidden" name="admin_form_submit_token" value="<?= $admin_form_submit_token ?>">

    <div class="image-preview">
      <label>Current Image:</label>
      <img src="<?= base_url("uploads/blog/{$image}") ?>" width="300" alt="<?= htmlspecialchars($name) ?>" />
    </div>

    <div class="custom-file">
      <input type="file" class="custom-file-input files" id="course_image" name="course_image" accept="image/jpeg, image/jpg, image/png, image/webp">
      <label class="custom-file-label" for="course_image">Change course image (leave empty to keep current)</label>
    </div>

    <div class="form-group">
      <label for="course_id">Course ID</label>
      <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo $id ?>" disabled>
    </div>

    <div class="form-group">
      <label for="name">Course Name *</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter course name" value="<?= htmlspecialchars($name) ?>" required>
    </div>

    <div class="form-group">
      <label for="duration">Duration *</label>
      <input type="text" class="form-control" id="duration" name="duration" placeholder="e.g., 4 weeks, 8 sessions" value="<?= htmlspecialchars($duration) ?>" required>
    </div>

    <div class="form-group">
      <label for="text_message">WhatsApp Message *</label>
      <input type="text" class="form-control" id="text_message" name="text_message" placeholder="Enter WhatsApp inquiry message" value="<?= htmlspecialchars($text_message) ?>" required>
    </div>

    <div class="form-group">
      <label for="description">Course Description *</label>
      <textarea class="form-control" id="description" name="description"><?= $description ?></textarea>
    </div>

    <div class="form-actions">
      <button type="submit" id="submit-button" class="mw-button btn-submit">
        <span class="admin-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
            <path d="M17 21v-8H7v8"></path>
            <path d="M7 3v5h8"></path>
          </svg>
        </span>
        Update Course
      </button>
      <a href="<?= base_url(); ?>admin/courses" class="mw-button btn-cancel">
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


<script src="https://cdn.tiny.cloud/1/9lehyvqq9ighbnbwbkr64z227rpclccj9oc8aar4ago43rv2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea'
  });
</script>
<script>
  $(document).on('change', '#course_image,', function() {
    var filename = this.files[0].name;
    $(this).siblings(".custom-file-label").text(filename);
  });

</script>

</main>
</body>
</html>
