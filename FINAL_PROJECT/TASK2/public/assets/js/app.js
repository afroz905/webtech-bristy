function loadBrands(catId){
    fetch("/computer-shop-task2/api/brand/getByCategory.php?category_id="+catId)
    .then(res=>res.json())
    .then(data=>{
        let html="";
        data.forEach(b=>{
            html+=`<option value="${b.id}">${b.name}</option>`;
        });
        document.getElementById("brand").innerHTML = html;
    });
}