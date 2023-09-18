let filter = document.getElementById("filter");
let year = document.getElementById("years");
let category = document.getElementById("categorys");




let tBody = document.getElementById("table_body");

filter.addEventListener('change', () => {

    if (filter.value == 'default') {
        category.style.display = "none";
        year.style.display = "none";
        // All();
        location.href = "../backend/results.php";
        
    } else if (filter.value == 'year') {
        year.style.display = "flex";
        category.style.display = "none";
        year.addEventListener('change', yearOnly);


    } else if (filter.value == 'yearcategory') {
        year.style.display = "flex";
        category.style.display = "flex";
        category.addEventListener('change', yearcategory);

    } else {
        category.style.display = "none";
        year.style.display = "none";
    }

});


   



// function All() {
//     let filters = 'all';
//     let filterValue = filter.value;
//     let xhr = new XMLHttpRequest();
//     xhr.onload = function () {
//         if (this.readyState == 4 & this.status == 200) {
//             if (xhr.status == 200) {
//                 let datas = JSON.parse(xhr.response);
//                 let data = datas;
//                 let output = "";
//                 console.log(datas);

//                 if (datas != "success") {
//                     console.log(data);
                    
//                     for (let item of data) {
//                         output += `
//                         <tr id="${item.id}">
//                             <th>${item.firstname} ${item.lastname}</th>
//                             <td id="score" >${item.score}</td>
//                             <td id="comment">${item.comments}</td>
//                         </tr>
//                         `;
//                     }
                
                    
//                 } else {
//                     output += `
//                     <tr>
//                         <td colspan= "3">No Result Found</td>
//                     </tr>
//                     `;
//                     }

//                 tBody.innerHTML = output;
//             }
//         }
//     }


//     xhr.open('POST', "../php/all-filter-func.php", true);
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//     xhr.send('filtervalue=' + filterValue + '&filters=' + filters);
// }








function yearOnly() {
    let filters = 'year';
    let filterValue = year.value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../php/all-filter-func.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);

                if (datas != "success") {
                    console.log(data);
                    for (let item of data) {

                        output += `
                        <tr id="${item.id}">
                            <th>${item.firstname} ${item.lastname}</th>
                            <td id="score" >${item.score}</td>
                            <td id="comment">${item.comments}</td>
                        </tr>
                        `;
                    }
                } else {
                    output += `
                    <tr>
                        <td colspan= "3">No Result Found</td>
                    </tr>
                    `;
                    }
                tBody.innerHTML = output;


            }

        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue + '&filters=' + filters);
}


function yearcategory() {
    let filters = 'yearcategory';
    let filterYearValue = year.value;
    let filterValue = category.value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../php/all-filter-func.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);

                if (datas != "success") {
                    console.log(data);
                    for (let item of data) {

                        output += `
                        <tr id="${item.id}">
                            <th>${item.firstname} ${item.lastname}</th>
                            <td id="score" >${item.score}</td>
                            <td id="comment">${item.comments}</td>
                        </tr>
                        `;
                    }
                } else {
                    output += `
                    <tr>
                        <td colspan= "3">No Result Found</td>
                    </tr>
                    `;
                    }
                tBody.innerHTML = output;


            }


        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue + '&filteryearvalue=' + filterYearValue + '&filters=' + filters);
}


