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
            var form = document.getElementById('signinform')
            var err_msg = document.getElementById('logfail')
            err_msg.textContent = ''
            form.submit();
        })
        .catch(function (error) {
            var err_msg = document.getElementById('logfail')
            err_msg.textContent = "Authentication Failed"
        });
}

function logout() {
    event.preventDefault();
    localStorage.setItem('api','');
    document.getElementById('logout-form').submit();
}
