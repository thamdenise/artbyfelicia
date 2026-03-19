<?php
$rows = $results;
$image = $rows->image;
$title = $rows->title;
$meta_title = $rows->meta_title ? $rows->meta_title : $title;
$meta_desc = $rows->meta_desc ? $rows->meta_desc : $title;
$image_alt = $rows->image_alt ? $rows->image_alt : $title;
$content = $rows->content;
$id = $rows->id;
$published_date = date("d-m-Y", $rows->published_at);
?>

<div class="admin-container">
  <div class="admin-page-header">
    <h1 class="admin-page-title">Edit Blog Post</h1>
  </div>

  <div class="form-card">
    <?= form_open_multipart(base_url() . "admin/edit-blog/" . $id); ?>
    <input type="hidden" name="admin_form_submit_token" value="<?= $admin_form_submit_token ?>">

    <div class="image-preview">
      <label>Current Image:</label>
      <img src="<?= base_url("uploads/blog/{$image}") ?>" width="300" alt="<?= htmlspecialchars($title) ?>" />
    </div>

    <div class="custom-file">
      <input type="file" class="custom-file-input files" id="blogpost_image" name="blogpost_image" accept="image/jpeg, image/jpg, image/png, image/webp">
      <label class="custom-file-label" for="blogpost_image">Change blog image (leave empty to keep current)</label>
    </div>

    <div class="form-group">
      <label for="blogpost_id">Blog ID</label>
      <input type="text" class="form-control" id="blogpost_id" name="blogpost_id" value="<?php echo $id ?>" disabled>
    </div>

    <div class="form-group">
      <label for="blogpost_title">Blog Title *</label>
      <input type="text" class="form-control" id="blogpost_title" name="blogpost_title" placeholder="Enter blog title" value="<?= htmlspecialchars($title) ?>" required>
    </div>

    <div class="form-group">
      <label for="publish_date">Publish Date *</label>
      <input class="form-control" type="text" id="publish_date" name="publish_date" value="<?= $published_date; ?>" placeholder="DD-MM-YYYY" autocomplete="off" required>
    </div>

    <div class="form-group">
      <label for="blogpost_image_alt">Image Alt Text *</label>
      <input type="text" class="form-control" id="blogpost_image_alt" name="blogpost_image_alt" value="<?php echo htmlspecialchars($image_alt) ?>" required>
    </div>

    <div class="form-group">
      <label for="blogpost_meta_title">Meta Title (SEO) *</label>
      <input type="text" class="form-control" id="blogpost_meta_title" name="blogpost_meta_title" value="<?php echo htmlspecialchars($meta_title) ?>" required>
    </div>

    <div class="form-group">
      <label for="blogpost_meta_desc">Meta Description (SEO) *</label>
      <input type="text" class="form-control" id="blogpost_meta_desc" name="blogpost_meta_desc" value="<?php echo htmlspecialchars($meta_desc) ?>" required>
    </div>

    <div class="form-group">
      <label for="blogpost_content">Blog Content *</label>
      <textarea class="form-control" id="blogpost_content" name="blogpost_content"><?= $content ?></textarea>
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
        Update Blog Post
      </button>
      <a href="<?= base_url(); ?>admin/blogs" class="mw-button btn-cancel">
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

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
<script src="https://cdn.tiny.cloud/1/9lehyvqq9ighbnbwbkr64z227rpclccj9oc8aar4ago43rv2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea'
  });
</script>
<script>
  $(document).on('change', '#blogpost_image, #blogpost_author_image', function() {
    var filename = this.files[0].name;
    $(this).siblings(".custom-file-label").text(filename);
  });

  $(document).ready(function() {
    getCategories();
    selectCat();
    $('#publish_date').datepicker();
    $('#publish_date').datepicker('setDate', '<?= $mmDDYYFormat; ?>');
  })

  function getCategories() {
    $.ajax({
      url: "<?= base_url('admin/get-blog-categories'); ?>",
      method: 'GET',
      async: false,
      dataType: 'json',
      timeout: 0
    }).done(function(response) {
      $.each(response, function(id, item) {
        var cat_id = item['id'];
        var cat_name = item['name'];
        var blog_categories = '<?= $rows->blog_category; ?>'.split(',');
        if (blog_categories.includes(cat_id)) {
          // $('#blogpost_category_select').append(`
          //               <option value="${cat_id}" selected>${cat_name}</option>
          //           `)

          $('#blogpost_category_select').append(`
              <li>
                  <label>
                      <input type="checkbox" value="${cat_id}" checked>
                      ${cat_name}
                  </label>
              </li>
          `);
        } else {
          // $('#blogpost_category_select').append(`
          //   <option value="${cat_id}">${cat_name}</option>
          // `)

          $('#blogpost_category_select').append(`
              <li>
                  <label>
                      <input type="checkbox" value="${cat_id}">
                      ${cat_name}
                  </label>
              </li>
          `);
        };
      });
    });

    // $(document).on('change', '#blogpost_category_select', function() {
    //   $('#blogpost_category').val($(this).val());
    // });
  }

  $(document).on('paste', '#publish_date', function(e) {
    var pastedDate = e.originalEvent.clipboardData.getData("text");
    var parsedDate = new Date(pastedDate);
    if (parsedDate !== null) {
      console.log(parsedDate);
      $(this).datepicker("setDate", parsedDate);
    }

    e.preventDefault();
  })

  function selectCat() {
    const dropdownButton =
      document.getElementById('multiSelectDropdown');
    const dropdownMenu =
      document.querySelector('.dropdown-menu');
    let mySelectedItems = '<?= $rows->blog_category; ?>'.split(',');
    let mySelectedItemsText = '<?= $rows->categories; ?>'.split(',');
    dropdownButton.innerText = mySelectedItems.length > 0 ?
      mySelectedItemsText.join(', ') : 'Select blog category';

    function handleCB(event) {

      const checkbox = event.target;

      var text = $(checkbox).text().trim();
      var selectedCatIds = [];
      var selectedCats = [];
      $('#blogpost_category_select input[type="checkbox"]').each(function() {
        if ($(this).prop('checked')) {
          selectedCatIds.push($(this).val());
          selectedCats.push($(this).closest('label').text().trim());
        }
      });

      dropdownButton.innerText = selectedCatIds.length > 0 ?
        selectedCats.join(', ') : 'Select blog category';

      $('#blogpost_category').val(selectedCatIds.join(','));
    }

    dropdownMenu.addEventListener('change', handleCB);
  }
</script>

</main>
</body>
</html>
