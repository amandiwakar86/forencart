<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/includes/admin-header.php";

?>

<main class="admin-content">

    <h1>Manage Banners</h1>
<a href="add-banner.php" class="admin-btn add-btn">
    + Add New Banner
</a>    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Banner Image</th>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM banners ORDER BY id DESC");

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>

                <td>
                    <?php if (!empty($row['image'])) { ?>
                        <img 
                            src="<?php echo $base_url; ?>assets/images/hero/<?php echo $row['image']; ?>" 
                            class="banner-thumb"
                        >
                    <?php } else { ?>
                        No Image
                    <?php } ?>
                </td>

                <td><?php echo htmlspecialchars($row['title']); ?></td>

                <td>
                    <?php if ($row['is_active']) { ?>
                        <span style="color: green; font-weight: bold;">Active</span>
                    <?php } else { ?>
                        <span style="color: red; font-weight: bold;">Inactive</span>
                    <?php } ?>
                </td>

                <td>
                    <a href="edit-banner.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    
                    <a href="toggle-banner.php?id=<?php echo $row['id']; ?>">
                        <?php echo $row['is_active'] ? 'Deactivate' : 'Activate'; ?>
                    </a> |
                    
                    <a 
                        href="delete-banner.php?id=<?php echo $row['id']; ?>" 
                        onclick="return confirm('Are you sure you want to delete this banner?');"
                    >
                        Delete
                    </a>
                </td>
            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='5'>No banners found</td></tr>";
        }
        ?>
        </tbody>
    </table>

</main>

</div> <!-- admin-wrapper -->
</body>
</html>
