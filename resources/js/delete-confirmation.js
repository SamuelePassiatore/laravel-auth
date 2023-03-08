const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = form.getAttribute('data-name') || 'elemento';
        const confirm = window.confirm(`Sei sicuro di voler eliminare questo ${name}?`);
        if (confirm) form.submit();
    });
});
