<link rel="stylesheet" href="../../public/assets/css/style.css">
<h2>Add Category</h2>

<form id="categoryForm" method="POST">

    <label>Category Name</label>
    <input type="text" id="catName" name="name">

    <label>Parent Category (Optional)</label>
    <input type="number" name="parent_id" placeholder="0 for main category">

    <button type="submit" name="submit">Save Category</button>

</form>

<script src="../../public/assets/js/validation.js"></script>