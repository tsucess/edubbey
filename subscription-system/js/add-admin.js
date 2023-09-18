const adminform = document.querySelector('.admin-form');
const adminBtn = document.querySelector('.add-admin-btn');
const errorText = document.querySelector('.error-txt');


adminform.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting;
}

adminBtn.onclick = () =>{

    // ajax start's here 
    let url = "../php/add-admin-logic.php";
    let method = "POST";
 
    let XHR = new XMLHttpRequest();
    XHR.open(method, url, true);
    XHR.onload = () =>{

        if(XHR.readyState === XMLHttpRequest.DONE){
            if(XHR.status === 200){
                let data = XHR.response;
                if(data === "success"){
                    location.href = "manage-admin.php";
                    errorText.classList.add("matched");
                    errorText.textContent = "You have successully registered";
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
    let formData = new FormData(adminform);
    XHR.send(formData);
}