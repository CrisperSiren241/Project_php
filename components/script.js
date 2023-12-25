function validateForm() {
    var fullname = document.getElementById('fullname');
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var confirmPassword = document.getElementById('confirmPassword');
    var phone = document.getElementById('phone');

    var fullnameError = document.getElementById('fullnameError');
    var usernameError = document.getElementById('usernameError');
    var emailError = document.getElementById('emailError');
    var passwordError = document.getElementById('passwordError');
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    var phoneError = document.getElementById('phoneError');

    var loginRegex = /^(?!.*(_)\1{3})[a-zA-Zа-яА-Я0-9_]{4,}$/;


    if (fullname.value.trim() === '') {
        fullnameError.textContent = 'Поле ФИО не может быть пустым';
        return false;
    } 
    else {
        fullnameError.textContent = '';
    }

    if (!loginRegex.test(username.value)) {
        usernameError.textContent = 'Логин должен содержать не менее 4 символов, русские или английские символы, цифры, знак подчеркивания, не допускаются 4 подряд идущих одинаковых символа.';
        return false;
    } else {
        usernameError.textContent = '';
    }

    var forbiddenWords = ["fuck", "cunt", "bitch"];

    function containsForbiddenWords(email) {
        for (var i = 0; i < forbiddenWords.length; i++) {
            if (email.includes(forbiddenWords[i])) {
                return true;
            }
        }
        return false;
    }
    
    if (containsForbiddenWords(email.value)) {
        emailError.textContent = 'Имя почтового адреса не может содержать нецензурные слова или выражения.';
        return false;
    } else {
        emailError.textContent = '';
    }

    var passwordRegex = /^[a-zA-Zа-яА-Я]{8,}$/;

    if(password == '' || confirmPassword == '')
    {
        passwordError.textContent = 'Поле не должно быть пустым';
        return false;
    }
    else{
        passwordError.textContent = '';
    }

    if (!passwordRegex.test(password.value)) {
        passwordError.textContent = 'Пароль должен состоять из букв латинского и русского алфавита, не содержать символы #$%^&_=+-. Длина пароля должна быть не меньше 8 символов.';
        return false;
    } else {
    passwordError.textContent = '';
    }


    if (password.value !== confirmPassword.value) {
        passwordError.textContent = 'Пароли не совпадают';
        confirmPasswordError.textContent = 'Пароли не совпадают';
        return false;
    } else {
        passwordError.textContent = '';
        confirmPasswordError.textContent = '';
    }

    return true;
}