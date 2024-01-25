jQuery(($)=>{
    $(document).on("submit", "#search-product-form", function(){
        const keywords = $(this).find("input[name='keywords']").val()
        $.getJSON("api/product/search.php?s=" + keywords, data=>{
            readProductTemplate(data, keywords)
        })
        return false
    })
})