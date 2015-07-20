<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">İş Ağı</a>
    </div>
    <div class="collapse navbar-collapse">


        <form class="navbar-form navbar-right" role="form" method="post" action="/giris">
            <div class="form-group">
                <input onkeyup="globalf.login.checkEnable()" type="text" name="user_mail" placeholder="Kullanıcı Adı" class="form-control" >
                <input onkeyup="globalf.login.checkEnable()" type="password" name="user_pass" placeholder="Şifre" class="form-control" >
            </div>
            <input type="submit" id="logb" name="slogin" class="btn btn-success btn-large disabled">Giriş Yap</a>
        </form>
    </div><!--/.nav-collapse -->
</div>