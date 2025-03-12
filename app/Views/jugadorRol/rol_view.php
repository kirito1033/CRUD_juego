<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../app/Views/assets/css/css.php') ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title><?= $title ?></title>
</head>

<body>

    <?php require_once('../app/Views/preload/preload.php'); ?>

    <!-- Navbar -->
    <?php require_once('../app/Views/nav/navbar.php'); ?>
    <!-- End Navbar -->

    <!-- Container -->
    <div class="container">
        <h3><?= $title ?></h3>
        <button type="button" class="btn btn-primary" onclick="add()" style="font-size: 0.5em;">ADD</button>

        <!-- Container Table -->
        <?php require_once('../app/Views/jugadorRol/table.php'); ?>
        <!-- End Container Table -->
    </div>
    <!-- End Container -->
    
    <!-- Modal -->
    <div class="modal fade" id="my-modal" tabindex="-1" aria-labelledby="my-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modalLabel"><?= $title ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <?php require_once('../app/Views/jugadorRol/form.php') ?>
                    <!-- End Form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id = "btnSubmit" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="my-form" class="btn btn-primary">Send Data</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Footer -->
    <?php require_once('../app/Views/footer/footer.php'); ?>
    <!-- End Footer -->

    <!-- Scripts -->
    <?php require_once('../app/Views/assets/js/js.php') ?>
    <?php require_once('../app/Views/assets/js/dataTable.php') ?>

    <!-- JS Controller -->
    <script src="http://localhost/CRUD/crud/public/controllers/jugadorRol/jugadorRol.js"></script>

</body>

</html>
