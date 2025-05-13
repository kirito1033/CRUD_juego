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
        <?php require_once('../app/Views/warrior/table.php'); ?>
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
                    <?php require_once('../app/Views/warrior/form.php') ?>
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
    <div class="modal fade" id="modalImagenGuerrero" tabindex="-1" aria-labelledby="imagenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formImagenGuerrero" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Actualizar Imagen del Guerrero</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="id" id="guerreroIdImagen">
            <div class="mb-3">
                <label for="imagen" class="form-label">Selecciona una imagen</label>
                <input class="form-control" type="file" name="imagen" id="imagenGuerreroInput" accept="image/*" required>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Subir Imagen</button>
            </div>
        </div>
        </form>
    </div>
    </div>
    <!-- Footer -->
    <?php require_once('../app/Views/footer/footer.php'); ?>
    <!-- End Footer -->

    <!-- Scripts -->
    <?php require_once('../app/Views/assets/js/js.php') ?>


    <!-- JS Controller -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="http://localhost/CRUD/crud/public/controllers/warrior/warrior.js"></script>
   <script>
    function showImageModal(id) {
    // Este ID viene del botón: showImageModal(<?php echo $obj['warrior_id']; ?>)
    document.getElementById('guerreroIdImagen').value = id;
    document.getElementById('imagenGuerreroInput').value = "";
    const modal = new bootstrap.Modal(document.getElementById('modalImagenGuerrero'));
    modal.show();
    }

    document.getElementById("formImagenGuerrero").addEventListener("submit", function(e) {
    e.preventDefault();
    const form = document.getElementById("formImagenGuerrero");
    const formData = new FormData(form);

    fetch("<?= base_url('warrior/updateImage') ?>", {
        method: "POST",
        body: formData,
        headers: {
        "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.message === "success") {
        alert("Imagen actualizada correctamente.");
        location.reload();
        } else {
        alert(data.message);
        }
    })
    .catch(err => {
        console.error("Error al subir imagen:", err);
    });
    });
    </script>
</script>

</body>

</html>
