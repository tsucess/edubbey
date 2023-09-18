 // Confrim users delete actions 
 function validate(){
    let result = confirm('Are you sure you want to delete?');
    if (result == false){
        event.preventDefault();
    }
}

