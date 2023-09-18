
const courseEditForm = document.querySelector(".edit-course-modal");
const courseEditBtn = document.querySelectorAll('.edit-course-btn');
const courseUpdateBtn = document.querySelector(".update-course-btn");


// form Id's
let courseId  = document.querySelector('#prev_course_id');
let course  = document.querySelector('#course2');
let amount  = document.querySelector('#amount2');
let category  = document.querySelector('#category2');




courseEditForm.onsubmit = (e) => {
    e.preventDefault(); //preventing from from submitting
}



courseEditBtn.forEach(btn => {
    btn.onclick = () => {
        let cate_id = btn.getAttribute('id');

        let xhr = new XMLHttpRequest();
        let url = "../php/fetch-edit-course.php?id="+cate_id;

        xhr.open('GET', url, true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    
                        try {
                            let datas = JSON.parse(data);

                            courseId.value = datas.id;
                            category.value = datas.category_id;
                            course.value = datas.course_title;
                            amount.value = datas.amount;
                            course.innerHTML = course.value;
                            
                        } catch (error) {
                            console.log(error);
                        }
                      
                        
                }
            }
        }
        xhr.send();

    }
});



courseUpdateBtn.onclick = () => {
    
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "../php/edit-course-logic.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                
                if (data === "success") {
                    
                    location.href = "../backend/manage-courses.php";
                } else {
                    console.log(data);

                }
                
            }
        }
    }
    let formData = new FormData(courseEditForm); //creating new formData object
    xhr.send(formData);
}


