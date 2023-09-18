const courseform = document.querySelector('.add-course-modal');
const addQuestionbtn = document.querySelector('.add-course-btn');
const errorText = document.querySelector('.error-txtmodal');


courseform.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting;
}

addQuestionbtn.onclick = () =>{

    // ajax start's here 
    let url = "../php/add-course-logic.php";
    let method = "POST";

    let XHR = new XMLHttpRequest();
    XHR.open(method, url, true);
    XHR.onload = () =>{

        if(XHR.readyState === XMLHttpRequest.DONE){
            if(XHR.status === 200){
                let data = XHR.response;
                if(data === "success"){
                    errorText.classList.add("matched");
                    errorText.textContent = "Question successully Added";
                    errorText.style.display = "block";
                    location.href = "manage-courses.php";
                    console.log(data);
                } else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                  
                    console.log(data);

                }

            }
        }

    }
    // send the form data through ajax to php 
    let formData = new FormData(courseform);
    XHR.send(formData);
}