const form = document.querySelector(".signin-form"),
signinBtn = document.querySelector(".signin-btn");
let errorText = document.querySelector(".error-txt");


form.onsubmit = (e) =>{
    e.preventDefault(); //preventing from from submitting
}



function matched(){
    errorText.textContent = "Valid details provided"; 
    errorText.classList.add("matched");
    errorText.style.display = "block";
}

signinBtn.onclick = () =>{
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "./php/signin-logic.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if (data === "adminsuccess") {
                    errorText.textContent = "Valid details provided"; 
                    errorText.classList.add("matched");
                    errorText.style.display = "block";
                    location.href = "backend/index.php";

                } else if(data === "usersuccess") {
                    errorText.textContent = "Valid details provided"; 
                    errorText.classList.add("matched");
                    errorText.style.display = "block";
                    location.href = "backend/index.php";
                }
                else{
                    errorText.textContent = data; 
                    errorText.classList.remove("matched");
                    errorText.style.display = "block";
                    console.log(data);
                }
            }
        }
    }
    let formData =  new FormData(form); //creating new formData object
    xhr.send(formData); //sending the form data to php
}