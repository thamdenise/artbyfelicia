<div class="admin-container">
    <div class="admin-page-header">
        <h1 class="admin-page-title">Blog Posts</h1>
        <a href="<?= base_url(); ?>admin/add-blog" class="mw-button add-blog">
            <span class="admin-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 8v8"></path>
                    <path d="M8 12h8"></path>
                </svg>
            </span>
            Add New Blog
        </a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Published Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                date_default_timezone_set("Asia/Singapore");
                foreach ($results as $blog) {
                    $image = $blog->image;
                    $title = $blog->title;
                    $author = $blog->author;
                    $content = $blog->content;
                    $id = $blog->id;

                    $mmDDYYFormat = date("d M Y", $blog->published_at);
                ?>
                    <tr>
                        <td>
                            <a href="<?= base_url("uploads/blog/{$image}") ?>" target="_blank">
                                <img src="<?= base_url("uploads/blog/{$image}") ?>" width="90" height="90" alt="<?php echo htmlspecialchars($title); ?>" />
                            </a>
                        </td>
                        <td><strong><?php echo htmlspecialchars($title); ?></strong></td>
                        <td><?php echo $mmDDYYFormat; ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url() . 'admin/edit-blog/' . $id; ?>" class="mw-button edit-button">
                                    <span class="admin-icon" aria-hidden="true">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 3 21l.5-4.5L17 3z"></path>
                                        </svg>
                                    </span>
                                    Edit
                                </a>
                                <a href="<?= base_url() . 'admin/delete-blog/' . $id . '/' . $image; ?>" class="mw-button delete-button" onclick="return confirm('Are you sure you want to delete this blog post?');">
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

</main>
</body>
</html>
