<div class="admin-container">
    <div class="admin-page-header">
        <h1 class="admin-page-title">Add New Blog Post</h1>
    </div>

    <div class="form-card">
        <?= form_open_multipart(base_url() . "Admin/BlogPostController/addBlogPost"); ?>
        <input type="hidden" name="admin_form_submit_token" value="<?= $admin_form_submit_token ?>">

        <div class="form-group">
            <label for="blogpost_title">Blog Title *</label>
            <input type="text" class="form-control" id="blogpost_title" name="blogpost_title" placeholder="Enter blog title" required>
        </div>

        <div class="form-group">
            <label for="publish_date">Publish Date *</label>
            <input class="form-control" type="text" id="publish_date" name="publish_date" value="" placeholder="DD-MM-YYYY" autocomplete="off" required>
        </div>

        <div class="custom-file">
            <input type="file" class="custom-file-input files" id="blogpost_image" name="blogpost_image" accept="image/jpeg, image/jpg, image/png, image/webp" required>
            <label class="custom-file-label" for="blogpost_image">Choose blog image (JPG, PNG, or WebP)</label>
        </div>

        <div class="form-group">
            <label for="blogpost_image_alt">Image Alt Text *</label>
            <input type="text" class="form-control" id="blogpost_image_alt" name="blogpost_image_alt" placeholder="Describe the image for accessibility" required>
        </div>

        <div class="form-group">
            <label for="blogpost_meta_title">Meta Title (SEO) *</label>
            <input type="text" class="form-control" id="blogpost_meta_title" name="blogpost_meta_title" placeholder="Enter meta title for search engines" required>
        </div>

        <div class="form-group">
            <label for="blogpost_meta_desc">Meta Description (SEO) *</label>
            <input type="text" class="form-control" id="blogpost_meta_desc" name="blogpost_meta_desc" placeholder="Enter meta description for search engines" required>
        </div>

        <div class="form-group">
            <label for="blogpost_content">Blog Content *</label>
            <textarea class="form-control" id="blogpost_content" name="blogpost_content" placeholder="Write your blog content here..."></textarea>
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
                Publish Blog Post
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

<script src="https://cdn.tiny.cloud/1/9lehyvqq9ighbnbwbkr64z227rpclccj9oc8aar4ago43rv2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
        $(document).on('change input', '.custom-file input', function() {
            var filename = this.files[0].name;
            console.log(filename);
            $(this).siblings(".custom-file-label").text(filename);
        });

        $('form').on('submit', function() {
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('h1'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('h2'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('h3'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('h4'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('h5'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('h6'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('p'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('ul'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('ol'), '');
            tinyMCE.activeEditor.dom.addClass(tinyMCE.activeEditor.dom.select('li'), '');

            if ($('#blogpost_image').val().length == 0) {
                $('#submitBtn').prop('disabled', false);
                return false;
            } else {
                $('#submitBtn').prop('disabled', true);
            }
        });

        $(document).ready(function() {
            getCategories();
            $('#publish_date').datepicker();
            selectCat();
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
                    // if (cat_id == 1) {
                    //     $('#blogpost_category_select').append(`
                    //     <option value="${cat_id}" selected>${cat_name}</option>
                    // `)
                    // } else {
                    //     $('#blogpost_category_select').append(`
                    //         <option value="${cat_id}">${cat_name}</option>
                    //     `)
                    // };
                    $('#blogpost_category_select').append(`
                        <li>
                            <label>
                                <input type="checkbox" value="${cat_id}">
                                ${cat_name}
                            </label>
                        </li>
                    `);
                });
                // $('#blogpost_category').val(1);
            })
        }

        // $(document).on('change', '#blogpost_category_select', function() {
        //     $('#blogpost_category').val($(this).val());
        // });

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
            let mySelectedItems = [];
            let mySelectedItemsText = [];

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
