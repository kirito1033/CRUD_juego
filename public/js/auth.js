document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('errorMessage');

            fetch('/auth/login', { // Verifica que la URL sea correcta
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    localStorage.setItem('token', data.token); // Guardar token en localStorage
                    window.location.href = '/jugador'; // Redirigir a jugador
                } else {
                    errorMessage.textContent = data.error || 'Credenciales incorrectas';
                    errorMessage.classList.remove('d-none');
                }
            })
            .catch(error => {
                console.error('Error en login:', error);
                errorMessage.textContent = 'Ocurrió un error al iniciar sesión';
                errorMessage.classList.remove('d-none');
            });
        });
    }
});
