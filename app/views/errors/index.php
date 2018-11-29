<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $data['title']; ?></title>
  <link rel="icon" href="<?php echo URL_ROOT; ?>/public/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/fonts.css">
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/animate.css">
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/custom-assets/css/custom.css">
</head>
<body class="bg-nzema-mine">
<style>
* {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

body {
  padding: 0;
  margin: 0;
}

#notfound {
  position: relative;
  height: 100vh;
}

#notfound .notfound-bg {
  position: absolute;
  width: 100%;
  height: 100%;
  /* background-image: url('<?php echo APP_ROOT; ?>/../public/assets/images/bg.jpg'); */
  background-size: cover;
}

#notfound .notfound-bg:after {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.25);
}

#notfound .notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

#notfound .notfound:after {
  content: '';
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50% , -50%);
      -ms-transform: translate(-50% , -50%);
          transform: translate(-50% , -50%);
  width: 100%;
  height: 600px;
  background-color: rgba(255, 255, 255, 0.7);
  -webkit-box-shadow: 0px 0px 0px 30px rgba(255, 255, 255, 0.7) inset;
          box-shadow: 0px 0px 0px 30px rgba(255, 255, 255, 0.7) inset;
  z-index: -1;
}

.notfound {
  max-width: 600px;
  width: 100%;
  text-align: center;
  padding: 30px;
  line-height: 1.4;
}

.notfound .notfound-404 {
  position: relative;
  height: 200px;
}

.notfound .notfound-404 h1 {
  font-family: 'Passion One', cursive;
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  font-size: 220px;
  margin: 0px;
  color: #222225;
  text-transform: uppercase;
}

.notfound h2 {
  font-family: 'Muli', sans-serif;
  font-size: 26px;
  font-weight: 400;
  text-transform: uppercase;
  color: #222225;
  margin-top: 26px;
  margin-bottom: 20px;
}

.notfound-search {
  position: relative;
  padding-right: 120px;
  max-width: 420px;
  width: 100%;
  margin: 30px auto 20px;
}

.notfound-search input {
  font-family: 'Muli', sans-serif;
  width: 100%;
  height: 40px;
  padding: 3px 15px;
  color: #fff;
  font-weight: 400;
  font-size: 18px;
  background: #222225;
  border: none;
}

.notfound-search button {
  font-family: 'Muli', sans-serif;
  position: absolute;
  right: 0px;
  top: 0px;
  width: 120px;
  height: 40px;
  text-align: center;
  border: none;
  background: #ff00b4;
  cursor: pointer;
  padding: 0;
  color: #fff;
  font-weight: 400;
  font-size: 16px;
  text-transform: uppercase;
}

.notfound a {
  font-family: 'Muli', sans-serif;
  display: inline-block;
  font-weight: 400;
  text-decoration: none;
  background-color: transparent;
  color: #222225;
  text-transform: uppercase;
  font-size: 14px;
}

.notfound-social {
  margin-bottom: 15px;
}
.notfound-social>a {
  display: inline-block;
  height: 40px;
  line-height: 40px;
  width: 40px;
  font-size: 14px;
  color: #fff;
  background-color: #222225;
  margin: 3px;
  -webkit-transition: 0.2s all;
  transition: 0.2s all;
}
.notfound-social>a:hover {
  color: #fff;
  background-color: #ff00b4;
}

@media only screen and (max-width: 480px) {
  .notfound .notfound-404 {
    height: 146px;
  }

  .notfound .notfound-404 h1 {
    font-size: 146px;
  }

  .notfound h2 {
    font-size: 22px;
  }
}

</style>
<!-- <div class="container">
  <section class="content">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-3">Error <?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['message']; ?></p>
        <hr class="my-2">
        <p></p>
        <p class="lead">
          <a class="btn btn-primary btn-lg" href="javascript:history.go(-1)" role="button">Go back to previous page</a>
        </p>
      </div>
    </div>
  </section>
</div> -->

<div id="notfound">
		<div class="notfound-bg"></div>
		<div class="notfound">
			<div class="notfound-404">
				<h1><?php echo $data['title']; ?></h1>
			</div>
			<h2>Oops! <?php echo $data['message']; ?></h2>
			<form class="notfound-search">
				<input type="text" placeholder="Search...">
				<button type="button">Search</button>
			</form>
			<div class="notfound-social" style="display: none">
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-pinterest"></i></a>
				<a href="#"><i class="fa fa-google-plus"></i></a>
      </div>
      <a href="#" onclick="window.history.back(); return false;">Go Back</a>
			<a href="<?php echo URL_ROOT ?>/users/dashboard" class="d-none">Back To Homepage</a>
		</div>
	</div>
    <script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.min.js"></script>
    <script src="<?php echo URL_ROOT; ?>/public/assets/js/bootstrap.bundle.js"></script>
</body>
</html>