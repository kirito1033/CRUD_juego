<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="navbar-toggler-icon"></span> 
        </button> 
        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/jugador">Jugador</a></li>
                <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="/jugadorRol">Roles</a></li>
                <li class="nav-item"><a class="nav-link" href="/jugadorStatus">Jugador Status</a></li>
                <li class="nav-item"><a class="nav-link" href="/warrior">Guerrero</a></li>
                <li class="nav-item"><a class="nav-link" href="/warriortype">Guerrero Tipo</a></li>
                <li class="nav-item"><a class="nav-link" href="/race">Raza</a></li>
                <li class="nav-item"><a class="nav-link" href="/warriorpower">Guerrero Poder</a></li>
                <li class="nav-item"><a class="nav-link" href="/warriorspells">Guerrero Hechizo</a></li>
                <li class="nav-item"><a class="nav-link" href="/power">Poder</a></li>
                <li class="nav-item"><a class="nav-link" href="/spells">Hechizo</a></li>
            </ul>

            <form class="d-flex me-3">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <!-- Botón de Cerrar Sesión -->
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">Salir</a>

        </div> 
    </div> 
</nav>
