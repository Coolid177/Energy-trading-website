const quantity = document.getElementById("quantityInput");
const origin = document.getElementById("originInput");
const description = document.getElementById("descriptionInput");
const type = document.getElementById("typeInput");
const price = document.getElementById("priceInput");
const title = document.getElementById("titleInput");
const form = document.getElementById("ProductForm");

const setError = (message, id) => {
    const errorDisplay = document.getElementById(id)
    errorDisplay.innerText = message;
}

const setSucces = element => {
    const inputControl = document.getElementById(element);
    inputControl.innerText = '';
}

form.addEventListener('submit', e => {
    if (!validateInputs()){
        e.preventDefault();
    }
})

function isInt(value) {
    if (isNaN(value)) {
      return false;
    }
    var x = parseFloat(value);
    return (x | 0) === x;
}
console.log(document.getElementById("type-error"));
const validateInputs = () => {
    const quantityValue = quantity.value.trim();
    const originValue = origin.value.trim();
    const descriptionValue = description.value.trim();
    const typeValue = type.value.trim();
    const priceValue = price.value.trim();
    const titleValue = title.value.trim();

    flag = true
    if(quantityValue === ''){
        setError("please set the quantity that you have in stock", "quantity-error");
        flag=false;
    } else if (!(isInt(quantityValue))){
        setError("please set a valid quantity", "quantity-error");
        flag=false;
    } else {
        setSucces("quantity-error");
    }

    if(originValue===''){
        setError("please select the origin","origin-error");
        flag = false;
    } else if (originValue.length > 128){
        setError("this origin is too long. max is 128 characters","origin-error");
        flag = false;
    } else if(originValue.length < 3){
        setError("this origin is too shor. minimum length is three characters","origin-error");
        flag = false;
    } else {
        setSucces("origin-error");
    }

    if(descriptionValue===''){
        setError("please write a description","description-error");
        flag=false;
    } else if (descriptionValue.length > 4000){
        setError("you can't use more than 4000 characters","description-error");
        flag=false;
    } else if (descriptionValue.length < 50){
        setError("please describe your product a bit more","description-error");
        flag=false;
    } else {
        setSucces("description-error");
    }

    if(priceValue === ''){
        setError("please enter a price for your product", "price-error");
        flag=false;
    } else if(!(isInt(priceValue))){
        setError("please use a valid price","price-error");
        flag=false;
    } else {
        setSucces("price-error");
    }

    if(titleValue === ''){
        setError("please enter a name for your product", "title-error");
        flag=false;
    } else if (titleValue.length > 128){
        setError("please choose a shorter title", "title-error");
        flag = false;
    } else {
        setSucces("title-error");
    }

    if (typeValue === ''){
        setError("please select an energy type","type-error");
        flag=false;
    } else if (!(typeValue == "Aardgas" ||typeValue == "Biogas"||typeValue == "Propaan"||typeValue == "Butaan"||typeValue == "Aardolie"||typeValue == "Synthetische olie"||typeValue == "Pellets"||typeValue == "Briketten"||typeValue == "Brandhout" || typeValue == "Deelbare energie")){
        setError("please select a valid energy type", "type-error");
        flag=false;
    } else {
        setSucces("type-error")
    }

    return flag;
}
