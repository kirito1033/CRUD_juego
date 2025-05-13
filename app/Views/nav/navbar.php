<nav class="sidebar">
    <div class="sidebar-header">
      <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url('img/logo.jpeg'); ?>" alt="Logo" height="150">
        </a>
    </div>
    <ul class="sidebar-nav">
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
         <li class="nav-item"><a class="nav-link" href="/partida">Partidas</a></li>
    </ul>
    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger sidebar-logout">Salir</a>
</nav>
<style>
    
    
body {
    margin-top: 50px;
    margin-left: 250px;
    background-color: #1F2326;
    color: #F2BF27;
    font-family: Arial, sans-serif;
}

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    background-color: #1F2326;
    display: flex;
    flex-direction: column;
    padding: 20px;
    overflow-y: auto;
    box-shadow: 2px 0 5px #734002;

    scrollbar-color: #F2BF27 #1F2326;
    scrollbar-width: thin;
}

.sidebar::-webkit-scrollbar {
    width: 10px;
}

.sidebar::-webkit-scrollbar-track {
    background: #1F2326;
    border-radius: 5px;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #F2BF27;
    border-radius: 5px;
    border: 2px solid #1F2326;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #e0a81e;
}

.sidebar-header {
    text-align: center;
    margin-bottom: 20px;
}

.navbar-brand {
    font-size: 1.5rem;
    color: #F2BF27;
    text-decoration: none;
}

.sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
}

.nav-item {
    margin-bottom: 10px;
}

.nav-link {
    display: block;
    padding: 10px;
    color: rgb(239, 208, 4);
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.nav-link:hover,
.nav-link.active {
    background-color: #F2BF27;
    color: #1F2326;
     
}

.sidebar-form {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

.sidebar-form .form-control {
    margin-bottom: 10px;
    background-color: #BF8415;
    border: 1px solid #734002;
    color: #1F2326;
}

.sidebar-form .form-control::placeholder {
    color: #734002;
}

.sidebar-form .btn {
    background-color: #BF8415;
    border: 1px solid #734002;
    color: #1F2326;
}

.sidebar-form .btn:hover {
    background-color: #F2BF27;
    color: #1F2326;
}

.sidebar-logout {
    width: 100%;
    text-align: center;
    background-color: rgb(239, 208, 4) !important;
    border: 1px solid rgb(239, 208, 4) !important;
    color: #1F2326 !important;
}

.sidebar-logout:hover {
    background-color: rgb(255, 221, 0) !important;
    color: #1F2326 !important;
}

/* Estilos tabla personalizada */
#table-index {
    background-color: #1F2326 !important;
    color: #F2BF27;
    border: 1px solid #734002;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(115, 64, 2, 0.4);
}

#table-index thead,
#table-index tfoot {
    background-color: #BF8415;
    color: #1F2326;
}

#table-index th,
#table-index td {
    vertical-align: middle;
    border: 1px solid #734002;
}

#table-index tbody tr:hover {
    background-color: #2e3438;
    color: #F2BF27;
}

#table-index .btn {
    border: none;
    padding: 4px 8px;
    margin: 0 2px;
}

#table-index .btn-success {
    background-color: #048d94;
    color: #ffffff;
}

#table-index .btn-warning {
    background-color: #F2BF27;
    color: #1F2326;
}

#table-index .btn-danger {
    background-color: #8C5C03;
    color: #ffffff;
}

#table-index .btn:hover {
    opacity: 0.9;
    transform: scale(1.05);
    transition: all 0.2s ease;
}

/* Botones globales */
.btn-success {
    background-color: #8C5C03;
    border-color: #8C5C03;
}

.btn-success:hover {
    background-color: rgb(187, 123, 4);
    border-color: rgb(187, 123, 4);
}

.btn-warning {
    background-color: #BF8415;
    border-color: #BF8415;
}

.btn-warning:hover {
    background-color: rgb(226, 155, 24);
    border-color: rgb(226, 155, 24);
}

.btn-danger {
    background-color: #734002;
    border-color: #734002;
}

.btn-danger:hover {
    background-color: rgb(180, 100, 3);
    border-color: rgb(180, 100, 3);
}

.btn-primary {
    background-color: rgb(74, 41, 1);
    border-color: rgb(74, 41, 1);
}

.btn-primary:hover {
    background-color: rgb(158, 88, 2);
    border-color: rgb(158, 88, 2);
}
.text-center {
    background-color: #1F2326 !important;
    color: #F2BF27;
    border: 1px solid #734002;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(115, 64, 2, 0.4);
}
#table-index_length{
    color: #F2BF27;
    margin-bottom: 10px;
     margin-top: 10px;
     
}
[name="table-index_length"] {
   color: #F2BF27;
    background-color: #1F2326 !important;
}
#table-index_filter label {
  color: #F2BF27;
}

/* Cambiar el color del texto y el fondo del input */
#table-index_filter input {
  background-color: #1F2326;  /* fondo oscuro */
  color: #F2BF27;             /* texto amarillo */
  border: 1px solid #734002;  /* borde en tono de la paleta */
  border-radius: 5px;
  padding: 4px 8px;
}

/* Estilo al enfocar el input */
#table-index_filter input:focus {
  outline: none;
  border-color: #F2BF27;
  box-shadow: 0 0 5px rgba(242, 191, 39, 0.5);
}
.paginate_button{
      background-color: #1F2326; 
}
#table-index_paginate .paginate_button.current {
  background-color: #F2BF27;     /* Color de fondo activo */
  color: #1F2326 !important;     /* Color de texto (contraste) */
  border: 1px solid #734002;     /* Borde con tono de la paleta */
  border-radius: 5px;
  padding: 6px 12px;
  font-weight: bold;
  box-shadow: 0 0 4px rgba(115, 64, 2, 0.4);
}

/* Estilo general para los botones de paginación */
#table-index_paginate .paginate_button {
  background-color: #1F2326;
  color: #F2BF27 !important;
  border: 1px solid #734002;
  border-radius: 5px;
  padding: 6px 12px;
  margin: 0 2px;
  transition: background-color 0.2s, transform 0.2s;
}

/* Hover en botones de paginación */
#table-index_paginate .paginate_button:hover {
  background-color: #2e3438;
  transform: scale(1.05);
  cursor: pointer;
}
.dataTables_info{
     color: #F2BF27 !important;
}
</style>