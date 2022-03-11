<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?= $appName ?> | <?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url(); ?>/dashboard/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?= base_url(); ?>/dashboard/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/dashboard/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/dashboard/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/dashboard/bootstrap/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/dashboard/bootstrap/css/trix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?= $this->include('dashboard/layout/sidebar'); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
               <?= $this->include('dashboard/layout/header'); ?>
               <?= $this->renderSection('content'); ?>
            </div>
            <?= $this->include('dashboard/layout/footer'); ?>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/b632dc8495.js" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>/dashboard/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/dashboard/bootstrap/js/main.js"></script>
    <script src="<?= base_url(); ?>/dashboard/bootstrap/js/trix.js"></script>
    <script src="<?= base_url(); ?>/dashboard/js/chart.min.js"></script>
    <script src="<?= base_url(); ?>/dashboard/js/bs-init.js"></script>
    <script src="<?= base_url(); ?>/dashboard/js/theme.js"></script>
    <script src="<?= base_url(); ?>/js/liveProfile.js"></script>
</body>
</html>