function init(e) {
    var req = new Object();
    req.email = document.getElementById("email").value;
    req.password = document.getElementById("password").value;
    e.preventDefault();
    var csrft = $('meta[name="csrf-token"]').attr('content');
    axios.post('/api/user/login',
            req, {
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': csrft

                }
            }
        )
        .then(function (response) {
            localStorage.setItem('api', response.data.data.token);
            console.log('Login Successful!');
            var form = document.getElementById('signinform')
            form.submit();
        })
        .catch(function (error) {
            console.log(error);
            console.log('Login failed!');

        });
}

function logout() {
    event.preventDefault();
    localStorage.setItem('api','');
    document.getElementById('logout-form').submit();
}