<h2>Danh sách danh mục</h2>
<a href="index.php?controller=category&action=add" class="btn btn-success">Thêm danh mục</a>
<ul>
    <?php foreach ($categories as $cat): ?>
        <li>
            <?= htmlspecialchars($cat->name) ?>
            <a href="index.php?controller=category&action=edit&id=<?= $cat->id ?>">Sửa</a>
            <a href="index.php?controller=category&action=delete&id=<?= $cat->id ?>" onclick="return confirm('Xóa?')">Xóa</a>
        </li>
    <?php endforeach; ?>
</ul>