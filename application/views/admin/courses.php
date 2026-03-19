<div class="admin-container">
    <div class="admin-page-header">
        <h1 class="admin-page-title">Courses</h1>
        <a href="<?= base_url(); ?>admin/add-course" class="mw-button add-blog">
            <span class="admin-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 8v8"></path>
                    <path d="M8 12h8"></path>
                </svg>
            </span>
            Add New Course
        </a>
    </div>

    <div class="table-card">
        <div class="form-actions" style="justify-content: flex-end; margin-bottom: 12px;">
            <button type="button" id="saveCoursesOrder" class="mw-button btn-submit" disabled>
                <span class="admin-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <path d="M17 21v-8H7v8"></path>
                        <path d="M7 3v5h8"></path>
                    </svg>
                </span>
                Save Order
            </button>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width: 40px;">Order</th>
                    <th>Image</th>
                    <th>Course Title</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="courses-sortable">
                <?php
                foreach ($results as $course) {
                    $image = $course['image'];
                    $title = $course['name'];
                    $content = $course['description'];
                    $id = $course['id'];
                    $duration = $course['duration'];
                    $text_message = $course['text_message'];
                ?>
                    <tr data-id="<?= $id; ?>">
                        <td class="drag-handle" title="Drag to reorder"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                                <path d="M160-360v-80h640v80H160Zm0-160v-80h640v80H160Z" />
                            </svg></td>
                        <td>
                            <a href="<?= base_url("uploads/courses/{$image}") ?>" target="_blank">
                                <img src="<?= base_url("uploads/courses/{$image}") ?>" width="90" height="90" alt="<?php echo htmlspecialchars($title); ?>" />
                            </a>
                        </td>
                        <td><strong><?php echo htmlspecialchars($title); ?></strong></td>
                        <td><?php echo htmlspecialchars($duration); ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url() . 'admin/edit-course/' . $id; ?>" class="mw-button edit-button">
                                    <span class="admin-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 3 21l.5-4.5L17 3z"></path>
                                        </svg>
                                    </span>
                                    Edit
                                </a>
                                <a href="<?= base_url() . 'admin/delete-course/' . $id . '/' . $image; ?>" class="mw-button delete-button" onclick="return confirm('Are you sure you want to delete this course?');">
                                    <span class="admin-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M3 6h18"></path>
                                            <path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2"></path>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                            <path d="M10 11v6"></path>
                                            <path d="M14 11v6"></path>
                                        </svg>
                                    </span>
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<style>
    .drag-handle {
        cursor: move;
        text-align: center;
        font-size: 18px;
        color: #555;
        user-select: none;
    }

    #courses-sortable tr.ui-sortable-helper {
        background: #f5f7fa;
    }

    #courses-sortable tr.ui-sortable-placeholder {
        height: 64px;
        background: #edf2f7;
        visibility: visible !important;
    }
</style>
<script>
    $(function() {
        var $tbody = $('#courses-sortable');
        var $saveBtn = $('#saveCoursesOrder');

        $tbody.sortable({
            handle: '.drag-handle',
            helper: function(e, ui) {
                ui.children().each(function() {
                    $(this).width($(this).width());
                });
                return ui;
            },
            placeholder: 'ui-sortable-placeholder',
            update: function() {
                $saveBtn.prop('disabled', false);
            }
        });

        $saveBtn.on('click', function() {
            var order = [];
            $tbody.find('tr').each(function() {
                order.push($(this).data('id'));
            });

            $.post("<?= base_url('admin/courses-reorder'); ?>", {
                order: order
            }).done(function() {
                $saveBtn.prop('disabled', true);
            }).fail(function() {
                alert('Failed to save order. Please try again.');
            });
        });
    });
</script>

</main>
</body>
</html>
