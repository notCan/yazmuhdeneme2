<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="763662932278-992cbm5aflrpgrvfoqkmgh81f8m6u97v.apps.googleusercontent.com">
    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/kayit.css" />
    <title>Kayıt Ol</title>
</head>
<?php
    include 'inc/dbConnect.php';
?>
<body>
    <section id="cover" style="background-image:url('../uploads/back2.jpeg')">
        <div class="container">
            <div class="row">
                <div class="columnlogin col-md-4 shadow-lg p-3 mb-5 bg-info rounded">
                    <div class="login">
                        <div class="loginimg">
                            <img src="../uploads/login.png" class="img-responsive" alt="">
                        </div>
                        <form action="/kayit" method="POST" method="GET">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mail Adresiniz</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="name@example.com" name="mailg" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Şifreniz</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="parolag" required>
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-warning" name="giris">Giriş Yap</button>
                            </div>
                        </form>
                        <form action="/kayit" method="POST">
                            <div class="button">
                            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" name="facebook"></fb:login-button>
                                </div>
                        </form>
                        <form action="/kayit" method="POST">
                            <div class="g-signin2" data-onsuccess="onSignIn" name="google"></div>
                        </form>
                    </div>
                </div>
<?php
    if (isset($_POST['giris']))
    {
        $useremail = $_POST["mailg"] ;
        $userpass = $_POST["parolag"] ;

        $sorgu = $db->query("SELECT * FROM users WHERE userMail='$useremail' AND userPass='$userpass' LIMIT 1 ");

        $sorgu->execute();

        while ($row = $sorgu->fetch() ) {
            $mail = $row['userMail'];
            $parola = $row['userPass'];
        }


        if($useremail == $mail)
        {
            if($userpass == $parola)
            {
                session_start();
                $_SESSION["loggedin"] = true;
                $sorgu = $db->prepare("SELECT * FROM users WHERE userMail='$useremail' AND userPass='$userpass'");
                $sorgu->execute();
                while ($row = $sorgu->fetch())
                {
                    $userid = $row["userid"];
                }
                $_SESSION["uid"] = $userid;
                header("location: / ");
            }
            else
            {
                echo 'şifreniz yanlış';
            }
        }
        else
        {
            echo 'mail adresiniz yanlış';
        }
    }
?>
                <div class="col-md-4"></div>
                <div class="columnsign col-md-4 shadow-lg p-3 mb-5 bg-info rounded">
                    <div class="signup">
                        <div class="loginimg">
                            <img src="../uploads/signup.png" class="img-responsive" alt="">
                        </div>
                        <form action="/kayit" method="POST">
                        <div class="form-group">
                            <label >Kullanıcı Adı:</label>
                            <input type="text" name="nick" class="form-control" pattern="[a-z0-9]{3,15}" placeholder="Kullanıcı adınız" required>
                        </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mail Adresiniz</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="name@example.com" name="mail" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Şifreniz</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="parola" required>
                            </div>
                            <div class="button">
                                <button type="submit" class="btn btn-warning" name="kayit">Kayıt Ol</button>
                            </div>
                        </form>
                    </div>
                </div>
<?php
    if (isset($_POST['kayit']))
    {
        $usernick = $_POST["nick"] ;
        $useremail = $_POST["mail"] ;
        $userpass = $_POST["parola"] ;

        $kaydet = "INSERT INTO users (userNick,userMail,userPass) VALUES ('$usernick', '$useremail', '$userpass')";

        $db->exec($kaydet);
    }
?>
            </div>
        </div>
    </section>
    <!--JS-->
<script>
    function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    window.location = "http://localhost/";
    }
</script>

<script>

   function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
      testAPI();
    } else {
      document.getElementById('status').innerHTML = '';
    }
  }


   function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }


   window.fbAsyncInit = function() {
    FB.init({
      appId      : '638830730039455',
      cookie     : true,
      xfbml      : true,
      version    : 'v7.0'
    });


    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  };


  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=name,email', function(response) {
      console.log('Successful login for: ' + response.name);
     });
     FB.api('/me?fields=name,email', function(response) {
       console.log('Successful login for: ' + response.name);
       window.location = "http://localhost/";
      });
  }

  </script>

  <div id="status">

<script src="js/jquery-3.5.1.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
