// let lastClickedRow = '';
// $('.main-nav .navbar-nav .hvrcenter ').on('click', function () {
// 	let current = $('.main-nav .navbar-nav .hvrcenter.active').attr('data-toggle');
// 	let clicked = $(this).attr('data-toggle');
// 	$('.main-nav .navbar-nav .hvrcenter.active').removeClass('active');
// 	$(this).addClass('active');
// 	if (current != clicked) {
// 		$('.main-tab-pane .main-tabs.active.show').removeClass(['show', 'active']);
// 		$(`#${clicked}`).addClass(['active', 'show']);
// 	}
// });
function loadData() {
	$.ajax({
		url: 'fetch.php',
		method: 'POST',
		data: {
			view: view,
		},
		dataType: 'json',
		success: function (data) {},
	});
}

//   setInterval(function() {
//       console.log("every 5s");

//       load_unseen_notification();;
//   }, 5000);
// });


//Show the success or error alert after ajax query
function showAlert(type, message) {
	document.getElementById('alert-message').innerHTML = message.substring(0, message.length - 1);
	document.getElementById('alertdiv').classList.add('alert-'.concat(type.substring(1)));
	document.getElementById('alert-ajax').style.display = 'block';
	setTimeout(() => {
		document.getElementById('alert-ajax').style.display = 'none';
	}, 3000);
}

function checkMyPassword(password) {
	if (password != '') {
		$.ajax({
			url: '../func/changePassword.php',
			type: 'POST',
			data: {
				empID: empID,
				password: password,
			},
			cache: false,
			success: function (validity) {
				if (validity == true) {
					parent = document.getElementById('password-input');
					child = `<input type="password" name="new-password" class="form-control" id="new-password-input" placeholder="Enter new password..." required autocomplete="off">
                      <input type="password" name="new-password-again" class="form-control" id="password-again-input" placeholder="Enter password again..." required autocomplete="off">
                      `;
					parent.innerHTML = child;
					document.getElementById('change-password-header').innerHTML = 'Enter new password';
				} else {
					document.getElementById('password-error').innerHTML = 'Password incorrect';
				}
			},
		});
	} else {
		document.getElementById('password-error').innerHTML = 'Please enter your password!';
	}
}
