<?php
  session_start();
  $mode = 'input';
  $errmessage = array();
  if( isset($_POST['back']) && $_POST['back'] ){
    // 何もしない
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
	  // 確認画面
    if( !$_POST['fullname'] ) {
	    $errmessage[] = "名前を入力してください";
    } else if( mb_strlen($_POST['fullname']) > 100 ){
	    $errmessage[] = "名前は100文字以内にしてください";
    }
	  $_SESSION['fullname']	= htmlspecialchars($_POST['fullname'], ENT_QUOTES);

	  if( !$_POST['email'] ) {
		  $errmessage[] = "Eメールを入力してください";
	  } else if( mb_strlen($_POST['email']) > 200 ){
		  $errmessage[] = "Eメールは200文字以内にしてください";
    } else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
	    $errmessage[] = "メールアドレスが不正です";
	  }
	  $_SESSION['email']	= htmlspecialchars($_POST['email'], ENT_QUOTES);

	  if( !$_POST['message'] ){
		  $errmessage[] = "お問い合わせ内容を入力してください";
	  } else if( mb_strlen($_POST['message']) > 500 ){
		  $errmessage[] = "お問い合わせ内容は500文字以内にしてください";
	  }
	  $_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

	  if( $errmessage ){
	    $mode = 'input';
    } else {
      $token = bin2hex(random_bytes(32));
      $_SESSION['token'] = $token;
	    $mode = 'confirm';
    }
  } else if( isset($_POST['send']) && $_POST['send'] ){
    // 送信ボタンを押したとき
    if( !$_POST['token'] || !$_SESSION['token'] || !$_SESSION['email'] ) {
      $errmessage[] = '不正な処理が行われました';
      $_SESSION     = array();
      $mode         = 'input';
    } else if( $_POST['token'] != $_SESSION['token'] ) {
      $errmessage[] = '不正な処理が行われました';
      $_SESSION     = array();
      $mode         = 'input';
    } else {
      $message  = "お問い合わせを受け付けました \r\n"
                . "名前: " . $_SESSION['fullname'] . "\r\n"
                . "email: " . $_SESSION['email'] . "\r\n"
                . "お問い合わせ内容:\r\n"
                . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
      mail($_SESSION['email'],'お問い合わせありがとうございます',$message);
      mail('takashi.takeda@rebake.co.jp','お問い合わせありがとうございます',$message);
      $_SESSION = array();
      $mode = 'send';
    }

  } else {
    $_SESSION['fullname'] = "";
    $_SESSION['email']    = "";
    $_SESSION['message']  = "";
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Takashi Takedaポートフォリオサイト | お問い合わせフォーム</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="responsive/responsive.css">
   <!-- bootstrap-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   <style>
     body{
       background-color:#EEEEEE;
       margin: 0 auto;
       font-family: "Noto Serif Japanese", serif;
     }

     .header-contents a {
       color: #fff;
       background-color: #3f72af;
       text-decoration: none;
       padding: 5px 10px;
       border-radius: 20px;
       font-size: 20px;
     }

     div.contact-button {
      text-align: center;
     }

     .form-item {
       padding: 10px 0;
     }

     .btn-item {
       padding: 50px 0;
     }

     .btn {
       background-color: #3f72af;
       padding: 10px 50px;
     }

     .contact-form {
       padding-top: 60px;
       margin: 0 auto;
       max-width: 800px;
       width: 90%;
     }

     .contactform-coment {
       padding: 30px 0;
     }

     .button {
       text-align: center;
       padding: 50px 0 20px 0;
     }

     .button a {
       font-size: 30px;
       padding: 10px 20px;
     }

   </style>
</head>
<body>
<header>
<header>
    <div class="header-contents">
      <a href="index.html">Topへ戻る</a>
    </div>
  </header>


  <div class="contact-form">
    <div class="contactform-title">
      <h1>お問合わせフォーム</h1>
      <div class="contactform-coment">
        <p>お問合せやご依頼はお気軽に下記メールアドレスまでご連絡ください。<br>翌営業日以内にご返信させて頂きます。</p>
      </div>
    </div>

    <?php if( $mode == 'input' ){ ?>
      <!-- 入力画面 -->
      <?php
        if( $errmessage ){
          echo '<div class="alert alert-danger" role="alert">';
          echo implode('<br>', $errmessage );
          echo '</div>';
        }
      ?>
      <form action="./contactform.php" method="post">
        名前    <input type="text"    name="fullname" value="<?php echo $_SESSION['fullname'] ?>" class="form-control"><br>
        Eメール <input type="email"   name="email"    value="<?php echo $_SESSION['email'] ?>" class="form-control"><br>
        お問い合わせ内容<br>
        <textarea cols="40" rows="8" name="message" class="form-control"><?php echo $_SESSION['message'] ?></textarea><br>
        <div class="contact-button">
          <input type="submit" name="confirm" value="確認" class="btn btn-primary" />
  
        </div>
      </form>
    <?php } else if( $mode == 'confirm' ){ ?>
      <!-- 確認画面 -->
      <form action="./contactform.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <div class="form-item">
          ■ 名前<br>    <?php echo $_SESSION['fullname'] ?>
        </div>
        <div class="form-item">
          ■ Eメール<br> <?php echo $_SESSION['email'] ?>
        </div>
        <div class="form-item">
          ■ お問い合わせ内容<br>
          <?php echo nl2br($_SESSION['message']) ?>
        </div>
        <div class="btn-item">
          <input type="submit" name="back" value="戻る" class="btn btn-primary" />
          <input type="submit" name="send" value="送信" class="btn btn-primary" />
        </div>
      </form>
    <?php } else { ?>
      <!-- 完了画面 -->
      送信しました。お問い合わせありがとうございました。<br>
    <?php } ?>
  </div>
  
</body>
</html>
