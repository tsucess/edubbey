
const userEditForm = document.querySelector(".edit-user-modal");
const userEditBtn = document.querySelectorAll('.edit-user-btn');
const userUpdateBtn = document.querySelector(".update-user-btn");
let errorText = document.querySelector(".error-txtmodal");


// form Id's
let userId  = document.querySelector('#prev_user_id');
let prev_password  = document.querySelector('#prev_user_password');
let prev_avatar  = document.querySelector('#prev_avatar');

let firstname  = document.querySelector('#firstname');
let lastname  = document.querySelector('#lastname');
let school  = document.querySelector('#school');
let country  = document.querySelector('#country');
let email  = document.querySelector('#email');




// let password  = document.querySelector('#password');




userEditForm.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}



userEditBtn.forEach(btn => {
    btn.onclick = () => {
        let user_id = btn.getAttribute('id');

        // console.log(user_id);
        let xhr = new XMLHttpRequest();
        let url = "../php/fetch-edit-user.php?id="+user_id;

        xhr.open('GET', url, true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    
                        try {
                            let datas = JSON.parse(data);

                            userId.value = datas.id;
                            prev_avatar.value = datas.avatar;
                            prev_password.value = datas.userpassword;

                            firstname.value = datas.firstname;
                            lastname.value = datas.lastname;
                            school.value = datas.school;
                            country.value = datas.country;
                            email.value = datas.email;
                            console.log(data);
                            
                        } catch (error) {
                            console.log(error);
                        }
                      
                        
                }
            }
        }
        xhr.send();

    }
});



userUpdateBtn.onclick = () => {
    
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-user-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    errorText.textContent = "Profile Editted Sucessfully"; 
                    errorText.classList.add("matched");
                    errorText.style.display = "block";
                    location.href = "../backend/manage-users.php";
                } else {
                    errorText.textContent = data; 
                    errorText.classList.remove("matched");
                    errorText.style.display = "block";
                    console.log(data);

                }
                
            }
        }
    }
    let formData = new FormData(userEditForm); //creating new formData object
    xhr.send(formData);
}


