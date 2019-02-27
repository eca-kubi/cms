<?php 
$user = getUserSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        <?php /** @var array $payload */
        echo $payload['title']; ?>
    </title>
    <script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.min.js"></script>
    <link rel="icon" href="<?php echo URL_ROOT; ?>/public/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/AdminLTE.min.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/fonts.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/animate.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/custom-assets/css/custom.css" />
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
    -webkit-box-shadow: 0 0 0 30px rgba(255, 255, 255, 0.7) inset;
    box-shadow: 0 0 0 30px rgba(255, 255, 255, 0.7) inset;
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
    margin: 0;
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

    /*
    .notfound-search {
      position: relative;
      padding-right: 120px;
      max-width: 420px;
      width: 100%;
      margin: 30px auto 20px;
    }
    */

 input {
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
    right: 0;
    top: 0;
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
 /* color: #222225;*/
  text-transform: uppercase;
  font-size: 14px;
}

    /*.notfound-social {
      margin-bottom: 15px;
    }*/
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

    /*.nav-link.active {
        border-color: #343a40 !important;
    }*/

    /*.border-danger-4 {
      border: 4px solid red;
    }*/

#forgot_password:hover {
   color: #0056b3!important;
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
    <div id="notfound">
        <div class="notfound-bg"></div>
        <div class="notfound">
            <div class="notfound-404">
                <div>
                    <h1 class="d-md-block d-none" style="font-size: 50px">CMS Login</h1>
                    <h4 class="pt-2">Change Management System</h4>
                </div>
                <h5 class="font-passion-one d-md-none text-uppercase text-center">CMS Login</h5>
            </div>
            <?php flash('flash_login') ?>
            <!-- .col-10 -->
            <div class="col-10 mx-auto">
                <!-- .row -->
                <div class="row">
                    <div class="col mb-2">
                        <div id="user_login">
                            <form action="<?php echo site_url('users/login/' . $payload['cms_form_id']) ?>"
                                  enctype="multipart/form-data"
                                  method="post" role="form"
                                  data-toggle="validator">
                                <fieldset class="py-0 text-left fa font-weight-normal col-sm-12 p-2">
                                    <small class="font-weight-bold text-purple text-center d-block mb-2">
                                        Password is case sensitive.
                                    </small>
                                    <div class="form-group form-row">
                                        <div class="col-sm-12">
                                            <input type="text" id="staff_id" name="staff_id"
                                                   class="<?php //echo !empty($payload['post']->staff_id_err)? 'border-danger-4': '' ?>"
                                                   placeholder="STAFF ID" aria-describedby="helpId"
                                                   value="<?php echo !empty($payload['post']->staff_id)? $payload['post']->staff_id: '' ?>" required />
                                            <small class="with-errors help-block d-block">
                                                <?php //echo isset($payload['post']->staff_id_err)? $payload['post']->staff_id_err: '' ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group form-row">
                                        <div class="col-sm-12">
                                            <input type="password" placeholder="PASSWORD" name="password" class="<?php //echo !empty($payload['post']->password_err)? 'border-danger-4': '' ?>" aria-describedby="helpId"
                                                required />
                                            <small class="with-errors help-block d-block">
                                                <?php //echo !empty($payload['post']->password_err)? $payload['post']->password_err: '' ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn bg-dark text-white w3-btn text-uppercase">Submit</button>
                                        <a class="float-right mt-2" id="forgot_password" href="#" data-target="#forgot_password_modal" data-toggle="modal" style="color: #222225;">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-10 -->

            <div class="text-capitalize mt-5 pb-md-2">
                <a class="mr-5" href="<?php echo HOST; ?>">
                    <i class="fa fa-windows"></i>  Adamus Apps 
                </a>
                <a class="" href="<?php echo INTRANET; ?>" target="_blank">
                    <i class="fa fa-cloud"></i>  Intranet
                </a>
             <!--  <a href="#">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="#">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fa fa-pinterest"></i>
                </a>
                <a href="#">
                    <i class="fa fa-google-plus"></i>
                </a>--> 
            </div>
        </div>
    </div>
    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgot_password_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content fa font-weight-normal">
                <div class="modal-header">
                    <h6 class="modal-title" id="modelTitleId">Forgot Password?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" id="forgot_password_user_login">
                        <form method="post" action="<?php echo site_url('users/forgot-password'); ?>"
                              id="forgot_password_form" role="form">
                            <p>Send us your email and we'll reset it for you!</p>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required />
                                <small class="with-errors help-block m-1"></small>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="forgot_password_form" class="btn btn-secondary float-left">Submit</button>
                    <a href="#user_login" data-dismiss="modal">Wait, I remember it now!</a>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo URL_ROOT; ?>/public/assets/js/bootstrap.bundle.js"></script>
    <script>
        $('#staff_id').focus();
    </script>
</body>
</html>