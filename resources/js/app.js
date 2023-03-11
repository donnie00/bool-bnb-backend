import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


/* DELETE FORM CONFIRMATION */
const deleteForms_list = document.querySelectorAll(".delete-form");

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

/* AUTOCOMPLETE */

const SearchImput_Element = document.getElementById('search_input');
console.log(SearchImput_Element);
const suggestions_List = document.querySelectorAll('.suggestion-list-items');
console.log(suggestions_List)
SearchImput_Element.addEventListener("input", getSuggestions);

suggestions_List.forEach(suggestion_Element => {
    suggestion_Element.addEventListener("click", selectSuggestion);
    
});

function getSuggestions() {
    console.log('IMPUT- getSuggestions')
}
function selectSuggestion() {
    console.log('CLICK- selectSuggestions')
}
