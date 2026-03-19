<div class="admin-container">
    <div class="admin-page-header">
        <h1 class="admin-page-title">Add New Course</h1>
    </div>

    <div class="form-card">
        <?= form_open_multipart(base_url() . "admin/add-course"); ?>
        <input type="hidden" name="admin_form_submit_token" value="<?= $admin_form_submit_token ?>">

        <div class="form-group">
            <label for="name">Course Name *</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter course name" required>
        </div>

        <div class="custom-file">
            <input type="file" class="custom-file-input files" id="course_image" name="course_image" accept="image/jpeg, image/jpg, image/png, image/webp" required>
            <label class="custom-file-label" for="course_image">Choose course image (JPG, PNG, or WebP)</label>
        </div>

        <div class="form-group">
            <label for="duration">Duration *</label>
            <input type="text" class="form-control" id="duration" name="duration" placeholder="e.g., 4 weeks, 8 sessions" required>
        </div>

        <div class="form-group">
            <label for="text_message">WhatsApp Message *</label>
            <input type="text" class="form-control" id="text_message" name="text_message" placeholder="Enter WhatsApp inquiry message" required>
        </div>

        <div class="form-group">
            <label for="description">Course Description *</label>
            <textarea class="form-control" id="description" name="description" placeholder="Write course description here..."></textarea>
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
                Publish Course
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
    </script>

</main>
</body>
</html>
