
    <?php include 'inc/dbConnect.php'; ?>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-lg-12" style="background-color:#e6e6fa";>
          <h1>Kategoriler</h1>
          <?php
          $sorgu = $db->prepare("SELECT * FROM categories WHERE catconfirm = 1");
              $sorgu->execute();
              while ($row = $sorgu->fetch() ) {
                $catid[] = $row["catid"];
                $cattitle[] = $row["cattitle"];
                $cattext[] = $row["cattext"];

                $lenght = count($cattext);
              }
          ?>
          <?php for ($x = 0 ; $x < $lenght ; $x++) : ?>
            <?php
            $sorguu = $db->prepare("SELECT * FROM posts WHERE catid = ?");
                $sorguu->execute(array($catid[$x]));
                while ($row = $sorguu->fetch() ) {
                  $postid[] = $row["postid"];
                  $sayi = count($postid);
                }
                if (empty($sayi)) {
                  $sayi = 0;
                }
             ?>
            <h3><a href=<?php echo "/?cat=".$catid[$x];?> style="color:#000;"><?php echo $cattitle[$x]; ?></a> | <?php echo $sayi; ?> Post</h3>
            <p><?php echo $cattext[$x]; ?></p>
            <?php  
            unset($postid); 
         $sayi = 0;
            ?>
            <hr>
          <?php endfor; ?>
        </div>
      </div>
    </div>
    <br>
    
