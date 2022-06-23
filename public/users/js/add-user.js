$('#add-user-form').on('submit', addUser);

async function addUser(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    formData.set('createBtn', true);
    

    try {
        const response = await fetch('add-user.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        $('#success').html(data['successMessage']);
        $('#error').html(data['errorMessages']);

        if (!$('#success').is(':empty')) {
            $('#add-user-form')[0].reset();
        }
    } catch(error) {
        console.log(error);
    }
}

