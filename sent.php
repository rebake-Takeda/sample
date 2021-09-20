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
    .form-title {
      text-align: center;
      margin-bottom: 30px;
      font-size: 30px;
    }

    .form-item {
      padding: 20px 0 10px 0;
      font-weight: bold;
    }

    .thanks-message {
      margin-top: 50px;
      text-align: center;
      font-size: 24px;
    }

    .display-contact {
      width: 70%;
      margin: 30px auto;
      padding: 50px;
      background-color: #F5F5F5;
      color: #333;
    }
  </style>
</head>

<body>
  <header>
    <div class="header-contents">
      <ul class="header-list">
        <li class="header-item">
          <a href="index.html">Top</a>
        </li>
        <li class="header-item">
          <a href="#about-wrapper">About</a>
        </li>
        <li class="header-item">
          <a href="#service-wrapper">Service</a>
        </li>
        <li class="header-item">
          <a href="works.html">Works</a>
        </li>
        <li class="header-item">
          <a href="contactform.php">Contact</a>
        </li>
      </ul>
    </div>
  </header>

<div class="main">
    <div class="thanks-message">お問い合わせいただきありがとうございます。</div>
    <div class="display-contact">
      <div class="form-title">入力内容</div>

      <div class="form-item">■ 名前</div>
      <?php echo $_POST['name']; ?>

      <div class="form-item">■ 会社名</div>
      <?php echo $_POST['company']; ?>

      <div class="form-item">■ メールアドレス</div>
      <?php echo $_POST['email']; ?>

      <div class="form-item">■ お問合わせ内容</div>
      <?php echo $_POST['textarea']; ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/4-1-4/js/4-1-4.js"></script>
  <!-- TOＰ背景 -->
  <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

</body>
</html>