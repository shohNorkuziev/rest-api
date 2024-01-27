jQuery(($) => {
  $(document).on("click", "#update_account", function () {
    // let jwtString = document.cookie
    // var idValue = (jwtString.split(';')[1]).split('=')[1]
    let cookie = getCookie("id");
    $.getJSON("api/user/read.php?id=" + cookie, (data) => {
      console.log(data);
      let html =
        `
      <form action="#" id="form-update" class="m-t-15px">
      <h1>Редактировать профиль</h1>
      <input type="hidden" name="jwt" value="` +
        getCookie("jwt") +
        `">
      <input type="hidden" name="id" value="` +
        data.id +
        `">
        <div class="first_name">
            <input class="form-control" name="firstname" type="text" placeholder="Имя" value="` +
        data.firstname +
        `">
        </div>
        <div class="last_name">
            <input class="form-control m-t-15px" name="lastname" type="text" placeholder="Фамилия" value="` +
        data.lastname +
        `">
        </div>
        <div class="email">
            <input class="form-control m-t-15px" name="email" type="email" placeholder="Почта" value="` +
        data.email +
        `">
        </div>
        <div class="password">
            <input class="form-control m-t-15px" name="password" type="password" placeholder="Пароль">
        </div>
        <div class="btn">
        <button type="submit" class="btn btn-primary">Изменить профиль</button>
        </div>
      </form>`;
      $("#app").html(html);
    });
  });
});
$(document).on("submit", "#form-update", function () {
  let form_data = JSON.stringify($(this).serializeObject());
  $.ajax({
    url: "api/user/update.php",
    type: "POST",
    dataType: "json",
    data: form_data,
    success: (result) => {
      $("#response").html(
        "<h1 class='alert-primary alert'>Успешно изменено</h1>"
      );
      showProducts();
    },
    error: (xhr, resp, text) => {
      $("#response").html(
        "<h1 class='alert-danger alert'>Произошла ошибка</h1>"
      );
      console.log(xhr, resp, text);
    },
  });
  return false
});

function getCookie(name) {
  let matches = document.cookie.match(
    new RegExp(
      "(?:^|; )" +
        name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
        "=([^;]*)"
    )
  );
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
