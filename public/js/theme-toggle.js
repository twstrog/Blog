document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || 'light';

    if (currentTheme === 'dark') {
        themeToggle.innerHTML = '<i class="fa-solid fa-moon text-white"></i>';
        document.body.classList.add('dark-mode');
    } else {
        themeToggle.innerHTML = '<i class="fa-regular fa-sun"></i>';
    }

    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        const newTheme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
        themeToggle.innerHTML = newTheme === 'dark' ? '<i class="fa-solid fa-moon text-white"></i>' : '<i class="fa-regular fa-sun"></i>';
        localStorage.setItem('theme', newTheme);
    });
});
