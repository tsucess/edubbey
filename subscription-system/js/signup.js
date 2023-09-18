const form = document.querySelector('.signup-form');
const btnSignup = document.querySelector('.signup-btn');
const errorText = document.querySelector('.error-txt');


form.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting;
}

btnSignup.onclick = () =>{

    // ajax start's here 
    let url = "./subscription-system/php/signup-logic.php";
    let method = "POST";

    let XHR = new XMLHttpRequest();
    XHR.open(method, url, true);
    XHR.onload = () =>{

        if(XHR.readyState === XMLHttpRequest.DONE){
            if(XHR.status === 200){
                let data = XHR.response;
                if(data === "success"){
                    errorText.classList.add("matched");
                    errorText.textContent = "You have successully registered";
                    errorText.style.display = "block";
                    location.href = "subscription-system/";
                } else{
                    errorText.textContent = data;
                    errorText.style.display = "block";

                    console.log(data);

                }

            }
        }

    }
    // send the form data through ajax to php 
    let formData = new FormData(form);
    XHR.send(formData);
}