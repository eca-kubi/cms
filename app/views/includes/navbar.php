<div class="navbar-fixed fixed-top blockable">
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom px-3">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <i class="fa fa-bars"></i>
                </a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown d-none">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-comments-o"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="" alt="User ..." class="img-size-50 mr-3 img-circle" />
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger">
                                        <i class="fa fa-star"></i>
                                    </span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted">
                                    <i class="fa fa-clock-o mr-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="" alt="User ..." class="img-size-50 img-circle mr-3" />
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted">
                                        <i class="fa fa-star"></i>
                                    </span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted">
                                    <i class="fa fa-clock-o mr-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="" alt="User ..." class="img-size-50 img-circle mr-3" />
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning">
                                        <i class="fa fa-star"></i>
                                    </span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted">
                                    <i class="fa fa-clock-o mr-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <li class="nav-item dropdown d-none">
                <a href="#" class="nav-link" data-toggle="dropdown">
                    <i class="fa fa-bed"></i>
                    <span class="badge badge-default navbar-badge">
                        <i class="fa fa-dot-circle text-warning"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <span class="dropdown-item fa pl-1 text-muted">
                        <a href="#">...</a>
                    </span>
                    <span class="dropdown-item dropdown-header fa pl-1">
                        <a href="#">...</a>
                    </span>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-item fa pl-1">
                        <a href="#">
                            ...
                        </a>
                    </span>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown mr-5 d-none" id="nofication">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-warning navbar-badge">1</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="font-family: 'Font Awesome 5 Free';left: -90px;">
                    <span class="dropdown-item dropdown-header" id="header">1 Notification</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users mr-2"></i>
                        <span id="message">...</span>
                        <span class="float-right text-muted text-sm" id="time">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                  <i class="fa fa-th-large"></i>
                </a> -->
            </li>
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php
                    $user = getUserSession();
                    $initials = $user->first_name[0] .$user->last_name[0];
                    if ($user->profile_pic == DEFAULT_PROFILE_PIC) {
                        $name = $user->first_name .  ' ' .$user->last_name;
                        $src = PROFILE_PIC_DIR.$user->profile_pic.'?='.rand();
                        echo "<img avatar=\"$name\" src=\"$src\" class=\"user-image img-size-32 img-fluid img-circle d-inline-block\" avatar=\"$initials\" >";
                    } else { ?>
                    <img src="<?php echo PROFILE_PIC_DIR.$user->profile_pic.'?='.rand(); ?>" class="user-image img-size-32 img-fluid img-circle d-inline-block"
                        alt="<?php echo $initials; ?>" /><?php } ?>
                    <span class="hidden-xs text-capitalize">
                        <?php echo ucwords($user->first_name . ' '. $user->last_name); ?>
                    </span>
                </a>
                <ul class="dropdown-menu m-0 p-1 dropdown-menu-right" style="min-width: 19rem">
                    <!-- User image -->
                    <li class="user-header"></li>
                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="col fa p-2">
                            <?php
                            if ($user->profile_pic == DEFAULT_PROFILE_PIC) {
                                $initials = $user->first_name[0] .$user->last_name[0];
                                $name = $user->first_name .  ' ' .$user->last_name;
                                echo "<img data-name=\"$name\" class=\"user-image img-size-32 img-fluid img-circle d-inline-block \" avatar=\"$name\" >";
                            } else { ?>
                            <img src="<?php echo PROFILE_PIC_DIR.$user->profile_pic.'?='.rand(); ?>" class="user-image img-size-32 img-fluid img-circle d-inline-block"
                                alt="<?php echo $initials; ?>" /><?php } ?>
                            <p class="text-bold mb-1">
                                <?php echo ucwords($user->first_name . ' '. $user->last_name, ' -'); ?>
                            </p>
                            <p class="text-bold mb-1">
                                <?php echo ucwords($user->job_title, '- '); ?>
                            </p>
                            <p class="text-nowrap text-muted d-none">
                                Member since ...
                            </p>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer glyphicon-arrow-downrow row px-2">
                        <div class="pull-left col">
                            <a href="<?php echo URL_ROOT;?>/users/profile" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo URL_ROOT;?>/users/logout" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <nav class="navbar navbar-expand-sm navbar-light main-header w3-amber" id="navbar2" style="z-index: 0">
        <a class="navbar-brand d-none" href="<?php echo URL_ROOT; ?>">CMS</a>
        <button class="navbar-toggler hidden-lg-up text-sm d-none" type="button" data-toggle="" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0" style="flex-flow: wrap!important">
                <li class="nav-item d-none">
                    <a href="#" class="btn btn-default btn-lg w3-hover-text-grey btn-sm">
                        <i class="fa fa-angle-double-left  mr-1"></i>Go Back
                    </a>
                </li>
                <li class="nav-item ml-0 ml-sm-4 text-left pr-1 border-right fa">
                    <a href="<?php echo URL_ROOT.'/cms-forms/dashboard' ?>"
                        class="ajax-link nav-link btn border-0 text-bold flat text-left font-raleway">
                        <i class="fa fa-home ml-4"></i> DASHBOARD
                    </a>
                </li>
                <li class="nav-item dropdown fa  mx-2">
                    <a class="nav-link dropdown-item dropdown-toggle btn border-0 text-bold flat" data-toggle="dropdown">
                        CMS Forms
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId" style="position:absolute">
                        <li>
                            <a class="dropdown-item" href="<?php echo URL_ROOT; ?>/CMS-Forms/Start-Change-Process">
                                New
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="<?php echo URL_ROOT; ?>/CMS-Forms/Dashboard/Active">
                                Active
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="<?php echo URL_ROOT; ?>/CMS-Forms/Dashboard/Closed">
                                Closed
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 d-none">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" />
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>
