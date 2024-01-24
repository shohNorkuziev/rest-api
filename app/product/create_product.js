jQuery(($)=>{
    $(document).on("click", ".create-product-button",()=>{
        $.getJSON("api/category/read.php", (data)=>{
            let category_option = `<select name="category_id" class="form-control">`
            $.each(data.records, (key , val)=>{
                category_option += `<option value="`+val.id+`">` + val.name + `</option>`;
            })
            category_option += `</select>`;
            let create_product = `
            <div id="read_products" class="btn btn-primary read-product-button">
            Товары
            </div>
            <form action="#" id="create-product-form" method="post" border="0">
                <table class="table table-bordered table-hover">
                    <tr>
                        <td>Название</td>
                        <td><input type="text" name="name" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>Цена</td>
                        <td><input type="number" name="price" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>Описание</td>
                        <td><textarea  name="description" class="form-control" required> </textarea></td>
                    </tr>
                    <tr>
                        <td>Категория</td>
                        <td>`+ category_option +`</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">Создать товар</button>
                        </td>
                    </tr>
                </table>
            </form>`;
            $("#app").html(create_product);
        });
    });
    $(document).on("submit", "#create-product-form", function(){
        let form_data = JSON.stringify($(this).serializeObject());
        $.ajax({
            url:"api/product/create.php",
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