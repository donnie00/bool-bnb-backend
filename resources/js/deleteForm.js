import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import axios from 'axios';
import.meta.glob([
    '../img/**'
])



/* DELETE FORM CONFIRMATION ************************************************/
const deleteForms_list = document.querySelectorAll(".delete-form");
console.log("DELETE FORM ",deleteForms_list)
/* DELETE INDEX BUTTONS */
deleteForms_list.forEach((deleteForm) => {
    deleteForm.addEventListener("submit", function (event) {

        event.preventDefault();
        const conf = confirm("do you really want to delete this item?");

        if (conf === true) {
            deleteForm.submit();
        }
    })
});