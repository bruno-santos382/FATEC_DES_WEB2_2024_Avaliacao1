const form = document.getElementById('cadastro');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const response = await fetch('controller.php?action=cadastrar', {
        method: 'POST',
        body: new FormData(form)
    });

    if (response.ok) {
        const data = await response.json()
        alert(data.message);

        if (data.success) {
            form.reset()
        }
    } else {
        alert('Erro ao efetuar cadastro.');
    }
});