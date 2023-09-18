
const categoryEditForm = document.querySelector(".edit-category-modal");
const categoryEditBtn = document.querySelectorAll('.edit-category-btn');
const categoryUpdateBtn = document.querySelector(".update-category-btn");
const errorText = document.querySelector('.error-txtmodal');


// form Id's
let categoryId  = document.querySelector('#prev_category_id');
let category  = document.querySelector('#category');




categoryEditForm.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}



categoryEditBtn.forEach(btn => {
    btn.onclick = () => {
        let cate_id = btn.getAttribute('id');

        // console.log(user_id);
        let xhr = new XMLHttpRequest();
        let url = "../php/fetch-edit-category.php?id="+cate_id;

        xhr.open('GET', url, true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    
                        try {
                            let datas = JSON.parse(data);

                            categoryId.value = datas.id;
                            category.value = datas.category_title;
                            
                            
                        } catch (error) {
                            console.log(error);
                        }
                      
                        
                }
            }
        }
        xhr.send();

    }
});



categoryUpdateBtn.onclick = () => {
    
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-category-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    errorText.textContent = "Category successully Added";
                    errorText.style.display = "block";
                    location.href = "../backend/manage-categories.php";
                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                    console.log(data);
                }
                
            }
        }
    }
    let formData = new FormData(categoryEditForm); //creating new formData object
    xhr.send(formData);
}


