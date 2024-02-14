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
