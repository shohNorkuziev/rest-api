$(document).on("click", "#login", () => {
  showLoginPage();
});

function showLoginPage() {
//   setCookie("jwt", "", 1);
  let html = `
        <h1>Авторизация</h1>
        <form action="#" id="login-form" class="m-t-15px">
            <div class="email">
                <input class="form-control m-t-15px" name="email" type="email" placeholder="Почта">
            </div>
            <div class="password">
                <input class="form-control m-t-15px" name="password" type="password" placeholder="Пароль">
            </div>
            <div class="btn">
            <button type="submit" class="btn btn-primary">Войти</button>
            </div>
        </form>`;
  $("#app").html(html);
  showLogoutMenu();
}

$(document).on("submit", "#login-form", function(){
    const form_data = JSON.stringify($(this).serializeObject());
    $.ajax({
        url:"api/user/login.php",
        type: "POST",
        dataType: "json",
        data: form_data,
        success: (result)=>{
            setCookie("jwt", result.jwt, 1)
            setCookie("id", result.id, 1)
            $("#response").html("<h1 class='alert-primary alert'>Успешный вход</h1>")
            showLogInMenu();
            showProducts();
        },
        error:(xhr, resp, text)=>{
            console.log(xhr, resp, text);
            $("#response").html("<h1 class='alert-danger alert'>Неправильный логин или пароль</h1>")
        }
    })
    return false;
})
function showLogoutMenu(){
    $("#login, #sign-up").show()
    $("#logout").hide()
}

function showLogInMenu(){
    $("#login, #sign-up").hide()
    $("#logout, #update_account").show()
}

function setCookie(cname, cvalue, exdays){
    var d = new Date()
    d.setTime(d.getTime + (exdays*60*60*24))
    var expires = "expires="  + d.toUTCString()
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/"
}

$(document).on("click", "#logout", () => {
    showLoginPage();
  });