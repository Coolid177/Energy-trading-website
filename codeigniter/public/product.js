//Star system
function setValue(value){ 
    var stars = document.getElementsByClassName('star-select');
    for (let i = 0; i < value; i++){
        stars[i].style.color = 'yellow'; 
    }
    for (let j = value; j < 5; j++){
        stars[j].style.color = 'black';
    }
    document.getElementById('starsInput').setAttribute('value',value);
}

//review validation
const form = document.getElementById('postReview');
if(form != null){
    const stars = document.getElementById('starsInput');
    const title = document.getElementById('titleInput');
    const description = document.getElementById('descriptionInput');

    const setError = (message, id) => {
        const errorDisplay = document.getElementById(id)
        errorDisplay.innerText = message;
        errorDisplay.classList.add('error');
        errorDisplay.classList.remove('succes');
    }

    function isInt(value) {
        if (isNaN(value)) {
        return false;
        }
        var x = parseFloat(value);
        return (x | 0) === x;
    }

    const setSucces = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error'); 
        errorDisplay.innerText = '';
        inputControl.classList.remove('error');
    }

    form.addEventListener('submit', e => {
        if (!validateInputs()){
            e.preventDefault();
        }
    })

    function isAlphaSpace(value){
        const re = /^[a-zA-Z ]+$/;
        return re.test(String(value).toLowerCase());
    }

    const validateInputs = () => {
        const starsValue = stars.value.trim();
        const titleValue = title.value.trim();
        const descriptionValue = description.value.trim();
        
        flag = true;
        if (starsValue === ''){
            setError('please select a rating out of 5', 'rating-error');
            flag=false;
        } else if (!isInt(starsValue)){
            setError('please select a valid rating out of 5', 'rating-error');
            flag=false;
        } else if (!(starsValue <= 5 && starsValue >= 0)){
            setError('please select a rating between 0 and 5', 'rating-error');
            flag=false;
        } 

        if (titleValue === ''){
            setError('please provide a title', 'title-error');
            flag = false;
        } else if (titleValue.length > 128){
            setError('the maximum length is 128 characters', 'title-error');
            flag = false;
        } else if (titleValue.length < 10){
            setError('the minimum length is 10 characters', 'title-error');
            flag = false;
        } else if (!(isAlphaSpace(titleValue))){
            setError('title can only contain alphanumeric characters and spaces', 'title-error');
            flag = false;
        }

        if (descriptionValue === ''){
            setError('please provide a description', 'description-error');
            flag = false;
        } else if (descriptionValue.length > 300){
            setError('the maximum length is 300 characters', 'description-error');
            flag = false;
        } else if (descriptionValue.length < 50){
            setError('the minimum length is 50 characters', 'description-error');
            flag = false;
        } 

        return flag;
    }
}
//video controls
var items= document.getElementsByClassName("play-button");
for (i = 0; i < items.length; i++){
    items[i].onclick = function(env){
        if (env.composedPath()[1].children[1].paused) {
            env.composedPath()[1].children[1].play(); 
        }
        else {
            env.composedPath()[1].children[1].pause(); 
        }
    }
}