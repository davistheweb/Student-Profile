 //Because Script Wasn't working, So i had to put the SCript here

 document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.querySelector('.wrapper');
    const signUpLink = document.querySelector('.signUp-link');
    const signInLink = document.querySelector('.signIn-link');

    signUpLink.addEventListener('click', () => {
        console.log('Sign Up link clicked');
        wrapper.classList.add('animate-signIn');
        wrapper.classList.remove('animate-signUp');
    });

    signInLink.addEventListener('click', () => {
        console.log('Sign In link clicked');
        wrapper.classList.add('animate-signUp');
        wrapper.classList.remove('animate-signIn');
    });
});

const loginPassword = document.getElementById('login-password');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm-password');
const showLoginPasswordIcon = document.getElementById('show-login-password');
const showPasswordIcon = document.getElementById('show-password');
const showConfirmPasswordIcon = document.getElementById('show-confirm-password');

showLoginPasswordIcon.addEventListener('click', toggleLoginPasswordVisibility);
showPasswordIcon.addEventListener('click', togglePasswordVisibility);
showConfirmPasswordIcon.addEventListener('click', toggleConfirmPasswordVisibility);

let isLoginPasswordVisible = false;
let isPasswordVisible = false;
let isConfirmPasswordVisible = false;

function toggleLoginPasswordVisibility() {
    isLoginPasswordVisible = !isLoginPasswordVisible;
    loginPassword.type = isLoginPasswordVisible ? "text" : "password";
    showLoginPasswordIcon.className = isLoginPasswordVisible ? "ri-eye-off-line h-password" : "ri-eye-line h-password";
}
function togglePasswordVisibility() {
    isPasswordVisible = !isPasswordVisible;
    password.type = isPasswordVisible ? "text" : "password";
    showPasswordIcon.className = isPasswordVisible ? "ri-eye-off-line h-password" : "ri-eye-line h-password";
}

function toggleConfirmPasswordVisibility() {
    isConfirmPasswordVisible = !isConfirmPasswordVisible;
    confirmPassword.type = isConfirmPasswordVisible ? "text" : "password";
    showConfirmPasswordIcon.className = isConfirmPasswordVisible ? "ri-eye-off-line h-password" : "ri-eye-line h-password";
}


const validation = new JustValidate("#signup");

validation
    .addField("#name", [
        {
            rule: "required"
        }
    ])
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                       .then(function(response) {
                           return response.json();
                       })
                       .then(function(json) {
                           return json.available;
                       });
            },
            errorMessage: "email already taken"
        }
    ])
    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])
    .addField("#password_confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });


        