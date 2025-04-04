<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url('img/logo.jpeg'); ?>" alt="Logo" height="50"> Warriors
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('juego/guerreros'); ?>">Guerreros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('partidas'); ?>">Partidas</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="modosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Modos de Juego
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="modosDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('modo/poder'); ?>">Por Poder</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('modo/magia'); ?>">Por Magia</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('modo/suma'); ?>">Suma de Poder y Magia</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .profile-container {
    width: 50px;
    height: 50px;
    overflow: hidden; /* Recorta la imagen si es necesario */
    border-radius: 50%; /* Hace que el contenedor sea redondo */
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white; /* Borde opcional */
}

.profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ajusta la imagen sin deformarla */
}
</style>