// signup

function signup() {

    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var response = document.getElementById("response");

    // alert("FirstName:"+fname+ "\nLastname:"+lname+ "\nEmail:"+email+ "\nPassword:"+password);

    var form = new FormData();

    form.append("fname", fname);
    form.append("lname", lname);
    form.append("email", email);
    form.append("password", password);

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            var resText = xhr.responseText;

            if(resText == 'success'){
                response.classList = 'text-success text-center'
                response.innerHTML = "Registration Successful!";

                setTimeout(function(){
                    window.location.href = "index.php";
                }, 3000);
            }else{
                response.classList = "text-danger text-center"
                response.innerHTML = resText;
            }

        }
    }

    xhr.open("POST", "signupProcess.php", true);
    xhr.send(form);
}

// signIn

function signin(){

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var response = document.getElementById("response");

    // alert("Email:"+email+ "\nPassword:"+password);

    var form = new FormData();

    form.append("email", email);
    form.append("password", password);

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            var resText = xhr.responseText;
            
            if(resText == 'success'){
                response.classList = 'text-success text-center'
                response.innerHTML = "login Succesful!";

                setTimeout(function(){
                    window.location.href = "users.php";
                }, 3000);
            }else{
                response.classList = 'text-danger text-center'
                response.innerHTML = resText;
            }

        }
    }

    xhr.open("POST", "signinProcess.php", true);
    xhr.send(form);

}

// Logout

function logout(){

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            
            var resText = xhr.responseText;

            if(resText == 'success'){
                window.location.href = "index.php";
            }else{
                alert(resText);
            }
        }
    }

    xhr.open("GET", "logout.php", true);
    xhr.send();

}

// chat

function chat(id){

    window.location = "chat.php?id="+ id;

}

// send msg

function sendmsg(id){
    var reciver_id = id;
    var msg = document.getElementById("msg");
    var response = document.getElementById("response");

    if(msg.value == "" || reciver_id == ""){
        return;
    }

    var form = new FormData();

    form.append("msg", msg.value);
    form.append("reciver_id", reciver_id);

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            var responseText = xhr.responseText;
            if(responseText == "success"){
                msg.value = "";
            
            }else {
                response.classList = 'text-danger text-center';
                response.innerHTML = resText;
            }
    }
}

xhr.open("POST", "insertChat.php", true);
xhr.send(form);

}

setInterval(()=>{
    var reciverId = document.getElementById("reciver-id").value;
    if(reciverId){
        loadChat(reciverId);
    }
}, 500);

function loadChat(reciverId){
    var msgbox = document.getElementById("msgbox");

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            msgbox.innerHTML = xhr.responseText;
    }else{
        // msgbox.innerHTML = xhr.responseText;
    }
}

    xhr.open("GET", "loadChat.php?id=" + reciverId, true);
    xhr.send();

}