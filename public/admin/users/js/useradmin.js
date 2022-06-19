// document.querySelector('#updateModal').addEventListener('show.bs.modal', function (event) {
//     var button = $(event.relatedTarget) // Button that triggered the modal
//     var user = button.data('user');       // Extract the info from the attribute data-pun
//     var id = button.data('id');        // Extract the info from the attribute data-id
//     console.log(user);
//     console.log(id);
    
    
//     var modal = $(this)
//     modal.find('.modal-body input[name="user"]').val(user);
//     modal.find('.modal-body input[name="id"]').val(id);
// })

//addeventlistener
document.querySelector('#add-user-form').addEventListener('submit', addUserEvent);

async function addUserEvent(e){
    e.preventDefault();

    const formData = new FormData(e.target);
    formData.set('addUserBtn', true);
    
    // console.log(formData.get('first_name'));
    // console.log(formData.get('addUserBtn'));

    try{
        const response = await fetch('add-user.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        console.log(data);
        console.log(data ['message']);
        console.log(data ['first_name']);


        html = "";
        for(user of data['users']) {
            html += `

			<li class="users-list">

				<p>
					${user['first_name']}
					${user['last_name']} - 
					${user['email']}
				</p>

				<form action="update-user.php" method="GET" class="update">
					<input name="userId" type="hidden" value="${user['id']}">
					<input class="update-btn" type="submit" value="Update">
				</form>

				<form action="" method="POST">
					<input name="userId" type="hidden" value="${user['id']}">
					<input name="deleteUserBtn" type="submit" value="Delete" class="delete-btn">
				</form>
				
			</li>
            `
        }
        document.querySelector('#user-list').innerHTML = (html);
        document.querySelector('#form-message').innerHTML = (data['message']);
    } catch(error){
        console.log(error);
    }
}