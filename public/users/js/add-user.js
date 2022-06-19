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

        $('#successMessage').html(data['successMessage']);
        $('#first-name-error').html(data['first_name-error']);
        $('#last-name-error').html(data['last_name-error']);
        $('#street-error').html(data['street-error']);
        $('#postal_code-error').html(data['postal_code-error']);
        $('#email-error').html(data['email-error']);
        $('#email-error2').html(data['email-error2']);
        $('#password-error').html(data['password-error']);
        $('#confirmPassword-error').html(data['confirmPassword-error']);
        $('#phone-error').html(data['phone-error']);
        $('#city-error').html(data['city-error']);
        $('#country-error').html(data['country-error']);

        if (!$('#successMessage').is(':empty')) {
            $('#add-user-form')[0].reset();
        }
    } catch(error) {
        console.log(error);
    }
}


