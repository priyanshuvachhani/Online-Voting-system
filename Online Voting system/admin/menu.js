document.getElementById('menub').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent form submission
    const menu = document.getElementById('menu');
    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'flex'; // Show the menu as a flex container
        menu.style.flexWrap = 'wrap';
        menu.style.overflowY = 'auto';
        menu.style.justifyContent = 'left';
    } else {
        menu.style.display = 'none'; // Hide the menu
    }
});

// Initially hide the menu
document.getElementById('menu').style.display = 'none';