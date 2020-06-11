<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Custom Styles-->
    <link rel="stylesheet" type="text/css" href="css/sendPost.css">
    <!--Script-->
    <script src="js/sendPost.js"></script>
    <title>Hesap Sil</title>
</head>

<body>
<?php include 'dbconnect.php'; ?>
    <div class="card">
        <div class="card-header">
            <?php include 'post.php'; ?>
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
                <select name="cars" id="cars">
  <option value="volvo"><?php echo $response; ?></option>
</select>
                   
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Paylaş" class="btn  pylsBttn">
            </div>
        </form>
        </div>
    </div>
</body>

</html>