<link rel="stylesheet" href="../../public/assets/css/style.css">
<h2>Add Product</h2>

<form id="productForm" method="POST" enctype="multipart/form-data">

    <label>Product Name</label>
    <input type="text" id="productName" name="name">

    <label>Description</label>
    <textarea name="description"></textarea>

    <label>Manufacturer Review</label>
    <textarea name="manufacturer_review"></textarea>

    <label>Price</label>
    <input type="number" id="price" name="price">

    <label>Stock</label>
    <input type="number" id="stock" name="stock">

    <label>Category ID</label>
    <input type="number" name="category_id">

    <label>Brand ID</label>
    <input type="number" name="brand_id">

    <label>Product Image</label>
    <input type="file" name="image">

    <button type="submit" name="submit">Add Product</button>

</form>

<script src="../../public/assets/js/validation.js"></script>