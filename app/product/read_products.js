jQuery(($)=>{
    $('#response').html("");
    $(document).on("click", "#read_products", ()=>{
      showProducts();
      console.log(1);
    });
  });
  
  function showProducts() {
    $.getJSON("api/product/read.php", (data)=>{
      readProductTemplate(data, "")
    });
  }