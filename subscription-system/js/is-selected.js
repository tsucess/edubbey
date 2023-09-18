
let courseBtn = document.querySelectorAll('.selected');

let selectedQuestion; 
let btnId;

setInterval(() =>{
    // let's start Ajax 
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("GET", "../php/fetch-selected-course.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                
                try {
                    let datas = JSON.parse(data);
                    
                    datas.forEach( item => {

                        let selectedValue = item.is_selected;
                        let selectedrowId = item.id; 
 
                        courseBtn.forEach(btn => {
                            btnId = btn.getAttribute('id');
                            
                                if( (selectedrowId ===  btnId) && (selectedValue === "1")){
                                        selectedQuestion = btn.textContent;
                                        btn.classList.add("disable_no");
                                        // console.log(selectedQuestion); 
                                        // console.log(selectedValue); 
                                    }
                            });
                    });
                        
                    
                } catch (error) {
                    console.log(error);
                }
                
            }
        }
    }

     xhr.send(); //sending the form data to php

      }, 300); // this function will run after every 500ms