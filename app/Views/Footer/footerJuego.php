<footer class="footer text-center py-3 mt-4">
    <div class="container">
        <p>© <?= date('Y'); ?> Gestión de Personajes. Todos los derechos reservados.</p>
        <p>Desarrollado por <strong>Cristian Osorio</strong></p>
        <div>
            <a href="#" class="footer-link mx-2">Términos y Condiciones</a> |
            <a href="#" class="footer-link mx-2">Política de Privacidad</a> |
            <a href="#" class="footer-link mx-2">Contacto</a>
        </div>
    </div>
</footer>

<style>
/* Estilos para el footer */
.footer {
    background-color: #1F2326; /* Fondo principal de la paleta */
    border-top: 2px solid #734002; /* Borde superior */
    box-shadow: 0 -2px 5px #734002; /* Sombra superior */
    color: #8C5C03; /* Texto principal */
}

.footer .container {
   background-color: #1F2326; /* Fondo ligeramente más claro */
   
    border-radius: 8px;
    padding: 15px;
}

.footer p {
    margin: 0.5rem 0;
    color: #8C5C03; /* Texto principal */
}

.footer p strong {
    color: #F2BF27; /* Acento para nombres de desarrolladores */
}

.footer .footer-link {
    color: #BF8415; /* Color de enlaces */
    text-decoration: none;
    transition: color 0.3s, text-decoration 0.3s;
}

.footer .footer-link:hover {
    color: #F2BF27; /* Acento para hover */
    text-decoration: underline;
}

.footer .container div {
    margin-top: 10px;
}

.footer .container div::before,
.footer .container div::after {
    color: #734002; /* Color de separadores */
}

/* Responsividad para pantallas pequeñas */
@media (max-width: 576px) {
    .footer .container div {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .footer .footer-link {
        margin: 5px 0;
    }

    .footer .container div::before,
    .footer .container div::after {
        content: none; /* Oculta separadores en pantallas pequeñas */
    }
}
</style>