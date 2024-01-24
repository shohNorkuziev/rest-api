jQuery(($) => {
  $(document).on("click", ".delete-product-button", function () {
    const id = $(this).attr("data-id");
    bootbox.confirm({
      message: "<h4>Вы точно желаете удалить?</h4>",
      buttons: {
        confirm: {
          label: "Да",
          className: "btn-danger",
        },
        cancel: {
          label: "Нет",
          className: "btn-primary",
        },
      },
      callback: (result) => {
        if (result == true) {
          $.ajax({
            url: "api/product/delete.php",
            type: "POST",
            dataType: "json",
            data: JSON.stringify({id:id}),
            success: (result) => {
              showProducts();
            },
            error: (xhr, resp, text) => {
              console.log(xhr, resp, text);
            },
          });
        }
      },
    });

  });
});
