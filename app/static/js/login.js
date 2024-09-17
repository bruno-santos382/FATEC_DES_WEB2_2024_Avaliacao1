const form = document.getElementById('login');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const response = await fetch('controller.php?action=login', {
        method: 'POST',
        body: new FormData(form)
    });

    if (response.ok) {
        const data = await response.json()

        if (data.success) {
            window.location.href = 'dashboard.php';
        } else {
            alert(data.message);
        }
    } else {
        alert('Erro ao efetuar login no sistema.');
    }
});