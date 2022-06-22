$('#update-user-form').on('submit', updateUser);

async function updateUser(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    formData.set('updateBtn', true);
    
    try {
        const response = await fetch('update-user.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        $('#success').html(data['successMessage']);
        $('#error').html(data['errorMessages']);

    } catch(error) {
        console.log(error);
    }
}