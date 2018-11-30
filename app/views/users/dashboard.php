<?php require_once APP_ROOT .'\views\includes\header.php';?>
<?php require_once APP_ROOT .'\views\includes\navbar.php';?>
<?php require_once APP_ROOT .'\views\includes\sidebar.php';?>
<!-- .content-wrapper -->
<div class="content-wrapper animated fadeInRight" style="margin-top: <?php echo NAVBAR_MT; ?>">
    <!-- .content-header-->
    <section class="content-header d-none">
        <!-- .container-fluid -->
        <div class="container-fluid">
            <!-- .row -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <?php echo APP_NAME; ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <a href="#">Dashboard</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header-->
    <!-- content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h5>
                    <?php flash('flash'); ?>
                </h5>
                <h3 class="box-title text-bold d-none"></h3>
                <div class="box-tools pull-right d-none">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Current CMS Forms <span class="text-muted">(Active Now)</span></h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool d-none" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                                <ul class="products-list product-list-in-box">
                                    <li class="item">
                                            <a href="#">
                                                <div class="product-img">
                                                        <img class="d-none" src="../public/assets/images/adamus.jpg" alt="Product Image" />
                                                </div>
                                                <div class="product-info">
                                                        <span class="product-title text-dark w3-hover-text-dark-blue">
                                                            Orginator: Eric Akoto (IT Admin) @ IT
                                                            <br />
                                                            Date : 12/12/2018
                                                            <br />
                                                            Ref: NGM/MW/2.01F1
                                                        </span>
                                                        <span class="product-description">
                                                            Description: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </span>
                                                </div>
                                            </a>
                                    </li>
                                    <!-- /.item -->
                                    <li class="item">
                                            <a href="#">
                                                <div class="product-img">
                                                        <img class="d-none" src="../public/assets/images/adamus.jpg" alt="Product Image" />
                                                </div>
                                                <div class="product-info">
                                                        <span class="product-title text-dark w3-hover-text-dark-blue">
                                                            Orginator: Eric Akoto (IT Admin) @ IT
                                                            <br />
                                                            Date : 12/12/2018
                                                            <br />
                                                            Ref: NGM/MW/2.01F1
                                                        </span>
                                                        <span class="product-description">
                                                            Description: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </span>
                                                </div>
                                            </a>
                                    </li>
                                    <!-- /.item -->
                                </ul>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center" style="">
                                <a href="javascript:void(0)" class="uppercase">View All</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">All Previous CMS Forms <span class="text-muted">(Closed)</span></h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool d-none" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                                <ul class="products-list product-list-in-box">
                                    <li class="item">
                                            <a href="#">
                                                <div class="product-img">
                                                        <img class="d-none" src="../public/assets/images/adamus.jpg" alt="Product Image" />
                                                </div>
                                                <div class="product-info">
                                                        <span class="product-title text-dark w3-hover-text-dark-blue">
                                                            Orginator: Eric Akoto (IT Admin) @ IT
                                                            <br />
                                                            Date : 12/12/2018
                                                            <br />
                                                            Ref: NGM/MW/2.01F1
                                                        </span>
                                                        <span class="product-description">
                                                            Description: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </span>
                                                </div>
                                            </a>
                                    </li>
                                    <!-- /.item -->
                                    <li class="item">
                                            <a href="#">
                                                <div class="product-img">
                                                        <img class="d-none" src="../public/assets/images/adamus.jpg" alt="Product Image" />
                                                </div>
                                                <div class="product-info">
                                                        <span class="product-title text-dark w3-hover-text-dark-blue">
                                                            Orginator: Eric Akoto (IT Admin) @ IT
                                                            <br />
                                                            Date : 12/12/2018
                                                            <br />
                                                            Ref: NGM/MW/2.01F1
                                                        </span>
                                                        <span class="product-description">
                                                            Description: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                                        </span>
                                                </div>
                                            </a>
                                    </li>
                                    <!-- /.item -->
                                </ul>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center" style="">
                                <a href="javascript:void(0)" class="uppercase">View All</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>
                    <div class="col-12"></div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"></div>
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once APP_ROOT.'\views\includes\footer.php';?>