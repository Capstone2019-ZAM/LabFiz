
function init(){
    var req = new Object();
    req.email = document.getElementById("email").value;;
    req.password = document.getElementById("password").value;;
    axios.post('/api/user/login', 
        req, {
          headers: {
            "Content-Type": "application/json"
          }
        }
      )
      .then(function (response) {
        localStorage.setItem('api',response.data.data.token);
        console.log('Fetch done!');
        var form = document.getElementById('signinform')
        window.location.href ='/dashboard';
      })
      .catch(function (error) {
        console.log(error);
        console.log('Fetch failed!');
      });
}