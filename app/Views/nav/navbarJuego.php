<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url('img/logo.jpeg'); ?>" alt="Logo" height="90"> Warriors
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
/* Estilos para el navbar */
.navbar {
    background-color: #1F2326; /* Fondo principal de la paleta */
    border-bottom: 2px solid #734002; /* Borde inferior */
    box-shadow: 0 2px 5px #734002; /* Sombra con color de la paleta */
    padding: 10px 20px;
}

.navbar-brand {
    display: flex;
    align-items: center;
}

.navbar-brand img {
    margin-right: 10px;
}

.navbar-brand-text {
    color: #F2BF27; /* Acento para el texto del logo */
    font-size: 1.5rem;
    font-weight: bold;
}

.navbar-toggler {
    border: 1px solid #734002; /* Borde con color de la paleta */
    background-color: #BF8415; /* Fondo del toggler */
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='%23F2BF27' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

.nav-link {
    color: #8C5C03; /* Texto principal */
    font-weight: 500;
    padding: 10px 15px;
    transition: color 0.3s, background-color 0.3s;
}

.nav-link:hover,
.nav-link.active {
    color: #F2BF27; /* Acento para hover */
    background-color: #2A2F33; /* Fondo ligeramente más claro */
    border-radius: 5px;
}

.dropdown-toggle {
    color: #8C5C03; /* Texto principal */
}

.dropdown-toggle:hover {
    color: #F2BF27; /* Acento para hover */
}

.dropdown-menu {
    background-color: #2A2F33; /* Fondo ligeramente más claro */
    border: 1px solid #734002; /* Borde con color de la paleta */
    box-shadow: 0 4px 8px #734002; /* Sombra */
}

.dropdown-item {
    color: #8C5C03; /* Texto principal */
    transition: background-color 0.3s, color 0.3s;
}

.dropdown-item:hover {
    background-color: #F2BF27; /* Acento para hover */
    color: #1F2326; /* Contraste para texto */
}

/* Estilos para el contenedor de perfil */
.profile-container {
    width: 40px;
    height: 40px;
    overflow: hidden;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #734002; /* Borde con color de la paleta */
    transition: border-color 0.3s;
}

.profile-container:hover {
    border-color: #F2BF27; /* Acento para hover */
}

.profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>