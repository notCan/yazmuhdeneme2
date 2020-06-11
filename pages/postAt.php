
<?php include 'dbconnect.php'; ?>
    <div class="card">
        <div class="card-header">
            <?php include 'postAtAPI.php'; ?>
            <p>
                Bizimle bir şeyler paylaşmaya ne dersin ?<br>
                Mesleğin hakkındaki düşüncelerini, eğer üniversite öğrencisi isen önerilerini insanlarla paylaşarak, gelecekteki meslektaşlarına yardım etmek istemez misin ? 
            </p>
        </div>
        <div class="card-body">
            <form method="POST" action="phpLogin.php">
            <div class="input-group form-group">
                <textarea id="story" placeholder="Bir şeyler yaz..." name="story" rows="5" cols="33" maxlength="425"></textarea>
            </div>
            <div class="input-group form-group" id = "secim">
                <label for="cars">Lütfen bir kategori seçiniz: &ensp;</label>
                 <select id="cars" name="kategori">
                     <?php
                    $sorgu = $conn->prepare("SELECT * FROM categories");
                    $sorgu->execute();
                    while ($row = $sorgu->fetch() ) 
                    {
                      $selectBoxID[] = $row["catid"];
                      $selectBoxVal[] = $row["cattitle"];  
                      $length = count($selectBoxID);
                    }
                    
                    ?>
                    <?php 
                    for($i = 0; $i < $length; $i++):
                    ?>
                    
                    <option value="" . <?php echo $selectBoxID[$i]; ?>>
                        <?php echo $selectBoxVal[$i]; ?>
                    </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Paylaş" class="btn  pylsBttn">
            </div>
        </form>
        </div>
    </div>