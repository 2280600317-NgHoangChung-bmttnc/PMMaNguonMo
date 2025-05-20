<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Danh sách danh mục
    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    // Thêm danh mục
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $this->categoryModel->addCategory($name, $description);
            header('Location: index.php?controller=category&action=list');
            exit;
        }
        include 'app/views/category/add.php';
    }

    // Sửa danh mục
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            header('Location: index.php?controller=category&action=list');
            exit;
        }

        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            echo "Không tìm thấy danh mục.";
            exit;
        }

        include 'app/views/category/edit.php';
    }

    // Cập nhật danh mục
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if ($id && is_numeric($id)) {
                $this->categoryModel->updateCategory($id, $name, $description);
            }
        }

        header('Location: index.php?controller=category&action=list');
        exit;
    }

    // Xóa danh mục
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id && is_numeric($id)) {
            $this->categoryModel->deleteCategory($id);
        }

        header('Location: index.php?controller=category&action=list');
        exit;
    }
}