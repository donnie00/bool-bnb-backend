import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import axios from 'axios';
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

/* search text */
const SearchImput_Element = document.getElementById('search_input');
console.log(SearchImput_Element);
/* options li to chose*/
const suggestions_List = document.querySelectorAll('.suggestion-list-items');
console.log(suggestions_List)

const latitude_Element= document.getElementById('lat');
const longitude_Element= document.getElementById('lon');

//resp.data.result di getSuggestion
let suggestionAddressList = [];


SearchImput_Element.addEventListener("input", getSuggestions);
suggestions_List.forEach(suggestion_Element => {
    suggestion_Element.addEventListener("click", selectSuggestion);
});

function getSuggestions(e) {
    console.log('IMPUT- getSuggestions')
    /* valore */

    let querySearchText = e.target.value
    console.log(querySearchText);

    if (e.target.value.length > 0) {
        console.log("parte chiamata axios");


        let queryURL = 'https://api.tomtom.com/search/2/geocode/' + querySearchText + '.json?storeResult=false&limit=5&countrySet=IT&view=Unified&key=OwsqVQlIWGAZAkomcYI0rDYG2tDpmRPE'

        console.log(queryURL)
        // problema di cors qua vado a fantasia 
        axios.get(queryURL)
            .then((resp) => {
                console.log(resp)
                suggestionAddressList = resp.data.results
                console.log("AXIOS OK resp=", suggestionAddressList)

            }).then(function (resp) {
                console.log(resp)
            }).catch((error) => {
                console.log(error);
                suggestionAddressList = [

                    {
                        "address": {
                            "country": "it",
                            "freeformAddress": "Roma"
                        },
                        "position": {
                            "lat": 41.89056,
                            "lon": 12.49427
                        },
                    },
                    {
                        "address": {
                            "country": "it",
                            "freeformAddress": "Campagnano di Roma"
                        },
                        "position": {
                            "lat": 42.14051,
                            "lon": 12.38003
                        },
                    },
                    {
                        "address": {
                            "country": "it",
                            "freeformAddress": "Fabrica di Roma"
                        },
                        "position": {
                            "lat": 42.33378,
                            "lon": 12.29986
                        },
                    },
                    {
                        "address": {
                            "country": "it",
                            "freeformAddress": "Giuliano di Roma"
                        },
                        "position": {
                            "lat": 41.5408,
                            "lon": 13.28048
                        },
                    }
                ];
                console.log("PATACCATA=", suggestionAddressList)

                /*  suggestionAddressList.forEach(suggestion_Element=> {
                   console.log(suggestion_Element); */

                /*    }); */
                suggestions_List.forEach(function callback(listItem_Element, index) {
               //per ogni li in ul "suggestions_list innero i dati se esistenti e rendo visibile" 
                    if (suggestionAddressList[index]) {
                        listItem_Element.classList.remove('d-none')
                        listItem_Element.innerHTML = suggestionAddressList[index].address.freeformAddress + ', ' + suggestionAddressList[index].address.country
                    } else{
                        listItem_Element.classList.add('d-none')
                    }
                });
            });
    }
}




function selectSuggestion(e) {
    console.log('CLICK- selectSuggestions')
console.log(e.target)
console.log(e.target.innerText)
SearchImput_Element.value = e.target.innerText;
suggestionAddressList.forEach(suggestion => {
    if(suggestion.address.freeformAddress + ', ' + suggestion.address.country===SearchImput_Element.value){
console.log("scelta=",suggestion);
latitude_Element.value=suggestion.position.lat;
longitude_Element.value=suggestion.position.lon;
console.log(latitude_Element, longitude_Element)
    }
    suggestionAddressList = [];

    suggestions_List.forEach(listItem_Element => {
        listItem_Element.innerText="";
        listItem_Element.classList.add('d-none')

    });
});
  /*   selectded_Element.value = e.target.innerText; */
}
function createElementFromObject(tagEl, classes) {

    const created_El = document.createElement(tagEl);
    created_El.classList.add(...classes);
    return created_El
}
/* 
getSuggestions() {
    if (this.querySearchText.length > 0) {
        axios.get(`https://api.tomtom.com/search/2/geocode/${this.querySearchText}.json?storeResult=false&limit=5&countrySet=IT&view=Unified&key=OwsqVQlIWGAZAkomcYI0rDYG2tDpmRPE`)
            .then((resp) => {
   
                this.suggestions = resp.data.results;
                console.log(this.suggestions);
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        this.suggestions = [];
    }
},

selectSuggestion(suggestion) {
  
    this.querySearchText = (suggestion.address.freeformAddress + ', ' + suggestion.address.country);
  
    this.dataToRedirect = { ...suggestion.position, homeSearchAddress: this.querySearchText };
    console.log('QUELLO CHE PASSO IN ADVANCED SEARCH E SU CUI FACCIO LA CALL TOMTOM', this.dataToRedirect);
    //reset list sparisce dropdown!

    this.suggestions = [];

    //REDIRECT
    this.$router.push({ name: "AdvancedSearch", query: { ...this.dataToRedirect } });
}, */