function readProductTemplate(data, keywords){
    let read_products_html = `
    <h1 id="page-title">Все товары</h1>
    <form action="#" id="search-product-form" method="post">
    <div class="input-group pull-left w-30-pt">
        <input type="text" value="`+ keywords +`" name="keywords" class="form-control product-search-keywords" placeholder="Поиск товаров">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-secondary">Найти</button>
        </span>
    </div>
    </form> 
    <div id="create-product" class="btn btn-primary create-product-button">
      Создание товара
    </div>
      <table class="table table-bordered table-hover">
        <tr>
          <th class="w-15-pt">Название</th>
          <th class="w-10-pt">Цена</th>
          <th class="w-15-pt">Категория</th>
          <th class="w-25-pt text-align-center">Действие</th>
        </tr>`;
    $.each(data.records, function(key, val){
      read_products_html += `
      <tr>
        <td>` + val.name +` </td>
        <td>` + val.price + `</td>
        <td>` + val.category_name + `</td>
        <td>
          <button class="btn btn-primary m-t-10px read-one-product-button" data-id="` + val.id + `">Просмотр</button>
          <button class="btn btn-info m-t-10px update-product-button" data-id="` + val.id + `">Редактирование</button>
          <button class="btn btn-danger m-t-10px delete-product-button" data-id="` + val.id + `">Удаление</button>
        </td>
      </tr>`;
    });
    read_products_html += `</table>`;

    $('#app').html(read_products_html);
}