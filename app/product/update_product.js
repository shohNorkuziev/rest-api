jQuery(($) => {
  $(document).on("click", ".update-product-button", function () {
    const id = $(this).attr("data-id");
    $.getJSON("api/product/read_one.php?id=" + id, (data) => {
      $.getJSON("api/category/read.php", (secondData) => {
        let category_option = `<select name="category_id" class="form-control">`;
        $.each(secondData.records, (key, val) => {
          if (data.category_id == val.id) {
            category_option +=
              `<option value="` +
              val.id +
              `" selected>` +
              val.name +
              `</option>`;
          } else {
            category_option +=
              `<option value="` + val.id + `">` + val.name + `</option>`;
          }
        });
        category_option += `</select>`;
      

      let update_product =
        `<div id="read_products" class="btn btn-primary read-product-button">Товары</div>
        <form action="#" id="update-product-form" method="post" border="0">
        <input type="hidden" name="id" id="" value="`+ data.id +`">
        <table class="table table-bordered table-hover">
        <tr>
            <td>Название</td>
            <td><input type="text" name="name" class="form-control" value="` +
        data.name +
        `" required></td>
        </tr>
        <tr>
            <td>Цена</td>
            <td><input type="number" name="price" class="form-control" value="` +
        data.price +
        `" required></td>
        </tr>
        <tr>
            <td>Описание</td>
            <td><textarea  name="description" class="form-control" required>` +
        data.description +
        `</textarea></td>
        </tr>
        <tr>
            <td>Категория</td>
            <td>` +
        category_option +
        `</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Измнить товар</button>
            </td>
        </tr>
    </table>
    </form>`;
      $("#app").html(update_product);
    });
    });
  });
  $(document).on("submit", "#update-product-form", function(){
    let form_data = JSON.stringify($(this).serializeObject());
    $.ajax({
        url:"api/product/update.php",
        type: "POST",
        dataType: "json",
        data: form_data,
        success: (result)=>{
            showProducts();
        },
        error:(xhr, resp, text)=>{
            console.log(xhr, resp, text);
        }
    })
    return false;
})
});
