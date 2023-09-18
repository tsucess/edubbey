const categoryform = document.querySelector('.add-category-modal');
const addCategorybtn = document.querySelector('.add-category-btn');
const errorText = document.querySelector('.error-txtmodal');


categoryform.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting;
}

addCategorybtn.onclick = () =>{

    // ajax start's here 
    let url = "../php/add-category-logic.php";
    let method = "POST";

    let XHR = new XMLHttpRequest();
    XHR.open(method, url, true);
    XHR.onload = () =>{

        if(XHR.readyState === XMLHttpRequest.DONE){
            if(XHR.status === 200){
                let data = XHR.response;
                if(data === "success"){
                    errorText.classList.add("matched");
                    errorText.textContent = "Category successully Added";
                    errorText.style.display = "block";
                    location.href = "manage-categories.php";
                } else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                  
                    console.log(data);

                }

            }
        }

    }
    // send the form data through ajax to php 
    let formData = new FormData(categoryform);
    XHR.send(formData);
}