const userform = document.querySelector('.user-form');
const btnCreate = document.querySelector('.create-btn');
const errorText = document.querySelector('.error-txt');


userform.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting;
}

btnCreate.onclick = () =>{

    // ajax start's here 
    let url = "../php/add-user-logic.php";
    let method = "POST";

    let XHR = new XMLHttpRequest();
    XHR.open(method, url, true);
    XHR.onload = () =>{

        if(XHR.readyState === XMLHttpRequest.DONE){
            if(XHR.status === 200){
                let data = XHR.response;
                if(data === "success"){
                    location.href = "manage-users.php";
                    errorText.classList.add("matched");
                    errorText.textContent = "Account registered successully";
                    errorText.style.display = "block";
                } else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                  
                    console.log(data);

                }

            }
        }

    }
    // send the form data through ajax to php 
    let formData = new FormData(userform);
    XHR.send(formData);
}