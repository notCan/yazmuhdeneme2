<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/m_style.css">
    <title>Kategori Sil</title>
  </head>
  <body>
    <?php include "navbar.php" ?>
    <p></p>
    <p></p>
<div class="container" style="background-color:#ffff;">
  <div class="row">
    <div class="col-lg-12">
      <h2>Kategori Silme</h2>
      <p>Silmek istediğiniz kategoriyi  yanında ki sil butonuna basarak silebilirsiniz.</p>
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";

      try {
        $conn = new PDO("mysql:host=$servername;dbname=hardreza_maindata;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }

      $sorgu = $conn->prepare("SELECT * FROM categories WHERE catconfirm = 1");
          $sorgu->execute();
          while ($row = $sorgu->fetch() ) {
            $catid[] = $row["catid"];
            $cattitle[] = $row["cattitle"];

            $lenght = count($cattitle);
          }
          if (empty($lenght)) {
            $lenght = 0;
          }

          function delete($id) {
            $delete = $conn->prepare("DELETE FROM categories WHERE catid = ?");
	          $delete->execute(array($id));
          }
      ?>
      <h4>Kategoriler:</h4>
      <div class="container">
      <?php for ($x = 0 ; $x < $lenght ; $x++) : ?>
        <div class="row">
            <div class="col">
              <form  action="kat_sil.php" method="post">
              <label><?php echo $cattitle[$x] ; ?></label>
              <input type="hidden" name="<?php echo $catid[$x]; ?>" value="<?php echo $catid[$x]; ?>">
            </div>
            <div class="col">
              <button type="submit" name="<?php echo "delete".$catid[$x]; ?>" class="btn btn-danger">Sil</button>
              </form>
            </div>
          <?php
            if(isset($_POST["delete".$catid[$x]])) {
              $delete = $conn->prepare("DELETE FROM categories WHERE catid = ?");
  	          $delete->execute(array($catid[$x]));
              header("Refresh: 0;");
              echo "<script type='text/javascript'>alert('SİLME İŞLEMİ BAŞARILI!');</script>";
            }
           ?>
        </div>
        <hr />
      <?php endfor; ?>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
