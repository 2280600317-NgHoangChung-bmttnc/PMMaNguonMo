<h2>Sửa danh mục</h2>

<form method="post" action="index.php?controller=category&action=update">
    <!-- Gửi ID danh mục ngầm để controller biết đang sửa danh mục nào -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($category->id) ?>">

    <!-- Tên danh mục -->
    <label for="name">Tên danh mục:</label><br>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($category->name) ?>" required><br><br>

    <!-- Mô tả danh mục -->
    <label for="description">Mô tả:</label><br>
    <textarea name="description" id="description" rows="4" cols="40"><?= htmlspecialchars($category->description) ?></textarea><br><br>

    <!-- Nút cập nhật -->
    <button type="submit">Cập nhật</button>
</form>