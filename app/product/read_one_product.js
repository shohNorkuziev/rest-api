jQuery(($) => {
  $(document).on("click", ".read-one-product-button", function () {
    const id = $(this).attr("data-id");
    $.getJSON("api/product/read_one.php?id=" + id, (data) => {
      let read_one =
        `<div id="read_products" class="btn btn-primary read-product-button">Товары</div>
      <table class="table table-bordered table-hover">
      <tr>
          <td>Название</td>
          <td>`+ data.name +`</td>
      </tr>
      <tr>
          <td>Цена</td>
          <td>`+ data.price +`</td>
      </tr>
      <tr>
          <td>Описание</td>
          <td>`+ data.description +`</td>
      </tr>
      <tr>
          <td>Категория</td>
          <td>` + data.category_name +`</td>
      </tr>
      <tr>
          <td></td>
          <td>
              <button type="submit" class="btn btn-primary">Создать товар</button>
          </td>
      </tr>
  </table>`;
  $("#app").html(read_one)
    });
  });
});
