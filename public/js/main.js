document.getElementById('btn').addEventListener('click', function () {
    this.classList.toggle('click');
    document.getElementById('sb').classList.toggle('show'); // Updated to match your sidebar id
});

document.getElementById('admin-btn').addEventListener('click', function () {
    document.querySelector('.admin-show').classList.toggle('show'); // Updated for consistency
    document.getElementById('first').classList.toggle('rotate');
});
