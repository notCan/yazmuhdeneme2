
    <br>
    <div class="container" style="background-color:#e6e6fa;">
      <div class="row">
        <div class="col-lg-12">
          <h1>Destek ve İletişim</h1>
          <h3>E-mail:</h3>
          <p>info@meslekform.com</p>
          <h3>Telefon:</h3>
          <p>+90 543 XXX XX XX</p>
          <h3>Sosyal Medya:</h3>
          <a href="#" class="fa fa-facebook-official fa-2x" style="color:#424242;" aria-hidden="true"></a>
          <a href="#" class="fa fa-twitter-square fa-2x" style="color:#424242;" aria-hidden="true"></a>
          <a href="#" class="fa fa-instagram fa-2x" style="color:#424242;" aria-hidden="true"></a>
          <h4>İletişim Formu:</h4>
          <form action="/destek" method="post">
              <div class="form-group">
                <label for="exampleFormControlInput1">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput2">Konu:</label>
                <input type="text" class="form-control" name="konu" required>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Mesaj:</label>
                <textarea class="form-control" name="mesaj" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-info" name="gonder">Gönder</button>
              </div>
          </form>
          <?php
            if(isset($_POST["gonder"])){
                $email = $_POST["email"];
                $konu = $_POST["konu"];
                $mesaj = $_POST["mesaj"];

                $to = "meslekform@localhost.com";
                $subject =  "" . $konu; // Konu
                $message = "" . $mesaj; //mesaj içeriği
                $headers = 'From: ' . "\r\n"; //gönderen kimliği
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($to,$subject,$message,$headers);
            }
          ?>
        </div>
      </div>
    </div>
    <br>
    