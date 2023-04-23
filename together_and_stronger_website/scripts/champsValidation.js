function validateForm() {
    let isValid = true;

    const passwordInput = document.getElementById('password');
    const passwordError = document.getElementById('passwordError');
    const password = passwordInput.value;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{7,}$/;

    if (!passwordRegex.test(password)) {
        passwordError.innerHTML = "Le mot de passe doit contenir au moins 7 caractères, un chiffre et une lettre majuscule.";
        passwordError.style.display = "block";
        isValid = false;
    } else {
        passwordError.style.display = "none";
    }

    const phoneInput = document.getElementById('telephone');
    const phoneError = document.getElementById('phoneError');
    const phoneNumber = phoneInput.value;
    const phoneRegex = /^\d{10}$/;

    if (!phoneRegex.test(phoneNumber)) {
        phoneError.innerHTML = "Le numéro de téléphone doit posseder 10 chiffres.";
        phoneError.style.display = "block";
        isValid = false;
    } else {
        phoneError.style.display = "none";
    } 

    return isValid;
}

const form = document.querySelector('form');
form.addEventListener('submit', function (event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});
