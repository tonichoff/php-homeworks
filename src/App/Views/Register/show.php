<!--<div class="container registration-form">-->
<!--    <div class="row h-100">-->
<!--        <div class="col-4 offset-4 form-col h-100">-->
<!--            <form class="form-signin" method="POST">-->
<!--                <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>-->
<!--                <input id="inputEmail" name="email" class="form-control" placeholder="Почта"  autofocus="" type="email">-->
<!--                <input id="inputLogin" name="login" class="form-control" placeholder="Логин"  type="text">-->
<!--                <input id="inputPassword" name="password" class="form-control" placeholder="Пароль"  type="password">-->
<!--                <input id="inputCheckPassword" name="check_password" class="form-control" placeholder="Подтвердите пароль"-->
<!--                        type="password">-->
<!--                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<style>-->
<!--    .registration-form {-->
<!--        min-height: 100vh;-->
<!--    }-->
<!---->
<!--    .registration-form > row {-->
<!--        height: 100%;-->
<!--    }-->
<!---->
<!--    .form-col {-->
<!--        display: flex;-->
<!--    }-->
<!---->
<!--    .form-signin {-->
<!--        margin: auto;-->
<!--    }-->
<!--</style>-->

<script>
    function checkInputRegister(e) {
        e.preventDefault();
        var email = $('#email').val();
        var login = $('#login').val();
        var pas = $('#password').val();
        var check_pas = $('#check_password').val();
        var $this = $($this);
        $.ajax({
             type: "POST",
             url: "http://localhost:8080/api/check_input_register",
             data: {
                email: email,
                 login: login,
                 password: pas,
                 check_password: check_pas
                 }
             }).done(function(result) {
             console.log(result);
             if (result) {
                 var errors = jQuery.parseJSON(result);
                 if (!errors.validate) {
                     $('#email_mes').html(errors.email);
                     $('#login_mes').html(errors.login);
                     $('#pas_mes').html(errors.password);
                     $('#check_pas_mes').html(errors.check_password);
                 }
                 else {
                     var form = document.getElementById('reg_form');
                     form.submit();
                 }
             }
         });
    }
</script>

<form method="POST" id="reg_form">
    <p>Почта</p>
    <p><input type="text" name="email" id="email"/></p>
    <div id="email_mes"></div>
    <p>Логин</p>
    <p><input type="text" name="login" id="login"/></p>
    <div id="login_mes"></div>
    <p>Пароль</p>
    <p><input type="password" name="password" id="password"/></p>
    <div id="pas_mes"></div>
    <p>Повторите пароль</p>
    <p><input type="password" name="check_password" id="check_password"/></p>
    <div id="check_pas_mes"></div>
    <p><input type="submit" value="Регистрация" onclick="checkInputRegister(event)"></p>
</form>



