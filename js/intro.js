function displayIntro() {
            
    const showIntro = document.querySelector('#show-intro');
    const closeIntro = document.querySelector('#close-intro');

    showIntro.style.display = 'flex';

    setTimeout(() => {
        showIntro.style.display = 'none';
    }, 5500);

    closeIntro.addEventListener('click', () => {
        showIntro.style.display = 'none';
    });
}

    window.onload = displayIntro;
