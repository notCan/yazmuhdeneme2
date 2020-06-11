
    <?php include 'inc/dbConnect.php'; ?>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-lg-12" style="background-color:#e6e6fa";>
          <h1>Kategori Ekleme</h1>
          <p>Eklenmesini istediğiniz kategoriyi aşağıdaki formdan bize iletebilirsiniz. Eğer uygun görürsek sitede yayınlayabiliriz.</p>
          <form  action="/katekle" method="post">
            <div class="form-group">
              <label>Kategori Adı:</label>
              <input type="text" class="form-control" name="kategori" placeholder="" required>
              <small class="form-text text-muted">Aşağıdaki mevcut kategorileri kontrol edip yeni bir kategori giriniz.</small>
            </div>
            <div class="form-group">
              <label>Açıklama:</label>
              <textarea class="form-control" rows="3" name="aciklama" required></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-info" name="kat_gonder">Gönder</button>
            </div>
          </form>
          <?php
            if(isset($_POST["kat_gonder"])){
                $katadı = $_POST["kategori"];
                $aciklama = $_POST["aciklama"];

                $sql = "INSERT INTO categories (cattitle, cattext) VALUES (?,?)";
                $stmt= $db->prepare($sql);
                $stmt->execute([$katadı, $aciklama]);
                echo "<script type='text/javascript'>alert('Kategori ekleme başarılı !');</script>";
            }
          ?>
          <?php
          $sorgu = $db->prepare("SELECT * FROM categories WHERE catconfirm = 1");
              $sorgu->execute();
              while ($row = $sorgu->fetch() ) {
                $catid[] = $row["catid"];
                $cattitle[] = $row["cattitle"];

                $uzunluk = count($cattitle);
              }
          ?>
          <h3>Mevcut Kategoriler:</h3>
          <ul>
          <?php for ($i = 0 ; $i < $uzunluk ; $i++) : ?>
            <li><?php echo $cattitle[$i]; ?></li>
          <?php endfor; ?>
          </ul>
        </div>
      </div>
    </div>
    <br>
    
