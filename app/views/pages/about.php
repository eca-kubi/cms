<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        <?php echo $data['title']; ?>
    </title>
    <link rel="icon" href="<?php echo URL_ROOT; ?>/public/favicon.ico" type="image/x-icon" />
    <?php require_once APP_ROOT. '\includes\styles.php'; ?>
</head>
<body class="hold-transition sidebar-mini pattern-2">
    <div class="container w3-padding-large">
        <div class="section">
            <div class="container">
                <div class="container">
                    <div class="font-raleway">
                        <div class="container">
                            <h1 class="display-3 animated flipInY w3-hide-small">
                                <a href="<?php echo URL_ROOT; ?>">
                                    <?php echo SITE_NAME ?>
                                </a>
                            </h1>
                            <h5 class="display-4 w3-hide-large w3-hide-medium animated flipInY">
                                <small>
                                    <a href="<?php echo URL_ROOT; ?>">
                                        <?php echo SITE_NAME ?>
                                    </a>
                                </small>
                            </h5>
                            <p class="lead">
                                Version:
                                <strong>
                                    <?php echo APP_VERSION; ?>
                                </strong>
                            </p>
                            <!-- <hr class="my-2"> -->
                            <p class="lead">
                                Description:
                                <?php echo $data['description']; ?>
                            </p>
                            <p>

                                <ul class="list-inline text-bold w3-hide-small">
                                    <li class="list-inline-item animated pulse infinite">
                                        <a href="/users/dashboard">
                                            <i class="fas fa-home fa-2x"></i> Home
                                        </a>
                                    </li>
                                    <li class="list-inline-item animated pulse infinite">
                                        <a href="<?php echo URL_ROOT;?>/users/login">
                                            <i class="fas fa-lock  fa-2x  "></i> Login
                                        </a>
                                    </li>
                                    <li class="list-inline-item animated pulse infinite">
                                        <a href="<?php echo URL_ROOT;?>/CMS-Forms/Active">
                                            <i class="fas fa-book  fa-2x  "></i> View Active CMS Forms
                                        </a>
                                    </li>
                                    <li class="list-inline-item animated pulse infinite">
                                        <a href="<?php echo URL_ROOT;?>/CMS-Forms/Closed">
                                            <i class="fas fa-book  fa-2x  "></i> View Closed CMS Forms
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list-inline text-bold w3-hide-large w3-hide-medium">
                                    <li class="list-inline-item animated pulse infinite">
                                        <a href="/users/dashboard">
                                            <i class="fas fa-home fa-2x"></i> Home
                                        </a>
                                    </li>
                                    <li class="list-inline-item animated pulse infinite">
                                        <a href="<?php echo URL_ROOT;?>/users/login">
                                            <i class="fas fa-lock  fa-2x  "></i> Login
                                        </a>
                                    </li>
                                    <li class="list-inline-item animated pulse infinite">
                                        <a href="<?php echo URL_ROOT;?>/CMS-Forms/Active">
                                            <i class="fas fa-book  fa-2x  "></i> View Active CMS Forms
                                        </a>
                                    </li>
                                    <li class="list-inline-item animated pulse infinite">
                                        <a href="<?php echo URL_ROOT;?>/CMS-Forms/Closed">
                                            <i class="fas fa-book  fa-2x  "></i> View Closed CMS Forms
                                        </a>
                                    </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require APP_ROOT . '\views\inc\footer.php'; ?>