document.addEventListener("DOMContentLoaded", function () {

    // ================= CATEGORY =================
    let categoryForm = document.getElementById("categoryForm");

    if(categoryForm){
        categoryForm.addEventListener("submit", function(e){

            let name = document.getElementById("catName").value;

            if(name.trim() === ""){
                alert("Category name is required");
                e.preventDefault();
            }
        });
    }

    // ================= BRAND =================
    let brandForm = document.getElementById("brandForm");

    if(brandForm){
        brandForm.addEventListener("submit", function(e){

            let name = document.getElementById("brandName").value;

            if(name.trim() === ""){
                alert("Brand name is required");
                e.preventDefault();
            }
        });
    }

    // ================= PRODUCT =================
    let productForm = document.getElementById("productForm");

    if(productForm){
        productForm.addEventListener("submit", function(e){

            let name = document.getElementById("productName").value;
            let price = document.getElementById("price").value;
            let stock = document.getElementById("stock").value;

            if(name.trim() === ""){
                alert("Product name is required");
                e.preventDefault();
            }

            if(price === "" || price <= 0){
                alert("Price must be greater than 0");
                e.preventDefault();
            }

            if(stock === "" || stock < 0){
                alert("Stock cannot be negative");
                e.preventDefault();
            }
        });
    }

});