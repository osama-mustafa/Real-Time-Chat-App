
const passwordInput = document.querySelector('#passwordInput');
const eyeIcon      = document.querySelector('#passwordIcon');
eyeIcon.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') == 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('active');
});


