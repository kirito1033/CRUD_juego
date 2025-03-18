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
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200 && body.token) {
                    localStorage.setItem('token', body.token); // Guardar token en localStorage
                    window.location.href = '/jugador'; // Redirigir a la pestaña de jugador
                } else {
                    errorMessage.textContent = body.error || 'Credenciales incorrectas';
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

