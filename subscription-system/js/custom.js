
let courseBtn = document.querySelectorAll('.course_no');


courseBtn.forEach(btn => {
    btn.onclick = () => {
      let  Is_selectedValue = 1;
      let  courseId = btn.getAttribute('id');

        // Ajax to Update is_selected column

            let xhr = new XMLHttpRequest(); //creating XML object
            xhr.open("POST", "php/update-is_selected-logic.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;

                        if (data === "success") {
                            let selectedQuestion = btn.textContent;
                            btn.disabled = true;
                            btn.classList.remove("course_no");
                            btn.classList.add("disable_no");
                            // console.log(selectedQuestion);
                            
                        } else {
                            console.log(data);
                        }
                        
                    }
                }
            }
            
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('selectedValue=' + Is_selectedValue + '&courseId=' + courseId);
           

    }
});


