<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php /** @var array $payload */
        echo $payload['title']; ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo URL_ROOT; ?>/public/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/adminlte.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/adminlte-miscellaneous.css"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/box-widget.css"/>
    <link rel="stylesheet"
          href="<?php echo URL_ROOT; ?>/public/custom-assets/css/custom.css?<?php echo microtime(); ?>"/>
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/public/assets/css/shards.min.css">
</head>
<body>
<?php
modal('new_password');
?>

<input type="hidden" value="<?php echo URL_ROOT ?>" id="url_root"/>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/jquery-toast.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/bootstrap.bundle.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/validator.js"></script>
<script src="<?php echo URL_ROOT ?>/public/assets/js/shards.min.js"></script>
<script src="<?php echo URL_ROOT; ?>/public/assets/js/password-strength.js"></script>


<script>
    $(function () {
        $('#new_password_form').validator().on('submit', function () {
        });
        $('#new_password_modal').modal('show')
            .on('shown.bs.modal', () => {
                $('#password').focus();
            });
        /*$('[type=password]').showPassword('focus', {
          toggle: { className: 'my-toggle' }
        });*/
        /* $('[type=password]').password({
          shortPass: 'The password is too short',
          badPass: 'Weak; try combining letters & numbers',
          goodPass: 'Medium; try using special characters',
          strongPass: 'Strong password',
          containsUsername: 'The password contains the username',
          enterPass: '',
          showPercent: false,
          showText: true, // shows the text tips
          animate: true, // whether or not to animate the progress bar on input blur/focus
          animateSpeed: 'fast', // the above animation speed
          username: false, // select the username field (selector or jQuery instance) for better password checks
          usernamePartialMatch: true, // whether to check for username partials
          minimumLength: 8 // minimum password length (below this threshold, the score is 0)
        }); */
    });
</script>
</body>

</html>