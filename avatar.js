function renderAvatar() {
    const AVATAR = document.querySelector('#user-avatar');
    const INPUT = document.querySelector('#upload');
    const DATA = document.querySelector('.dataup-label');
    const BTN = document.querySelector('span[role="button"]');

    const handleUpload = (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onloadend = () => {
            const imageBuffer = reader.result;
            AVATAR.style.background = `url(${imageBuffer}) center center/cover`;
            const datac = DATA.textContent = imageBuffer;
            DATA.value = datac;
        };
    };
    INPUT.addEventListener('change', handleUpload);
    BTN.addEventListener('keypress', (event) => {
        if (event.key === ' ' || event.key === 'Enter') BTN.click();
    });
};