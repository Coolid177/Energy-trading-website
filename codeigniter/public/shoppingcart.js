//shoppingcart ajax
const quantities = document.getElementsByName("quantity");
const products = document.getElementsByName("productId");
const productPrices = document.getElementsByClassName('totalProductPrice');
const totalPrice = document.getElementById('totalPrice');
totalPrice.innerText = 0;

//shopping cart display properties
function displayAddressLine(){
    document.getElementById('Address').click();
}

function displayPaymentLine(){
    document.getElementById('Payment').click();
}

//accordion items are default open, this closes them. 
//better accessible for people who don't use javascript
document.getElementById('Address').click();
document.getElementById('Payment').click();


document.getElementById('selectDeliveryOption').onchange = function(){
    if (document.getElementById('deliveryOption').value == 'Delivery'){
        document.getElementById('deliveryOptionHide').setAttribute('style', "display: block");
    } else {
        document.getElementById('deliveryOptionHide').setAttribute('style', "display: none"); 
    } 
};


for ($item = 0; $item < quantities.length; $item++){
    productPrices[$item].innerHTML = parseInt(productPrices[$item].parentElement.childNodes[3].innerText) * parseInt(productPrices[$item].parentElement.childNodes[5].children[1].value);
    productPrices[$item].innerHTML += "€";
    quantities[$item].onchange = function(ev){
        //ajax request
        httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange  = () => {
            if (httpRequest.readyState === 4) {
              if (httpRequest.status === 200) {
                if(this.value == 0){
                    window.location.reload();
                }
              } else {
                alert('There was a problem with the request.');
              }
            }
          };
        httpRequest.open("POST", "/incrementShoppingCart", true);
        var data = ''
        + 'productId=' + window.encodeURIComponent(ev.path[2].childNodes[9].childNodes[1][0].value)
        + '&quantity=' + window.encodeURIComponent(this.value);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(data);

        //update view
        totalPrice.innerText = parseInt(totalPrice.innerText) - parseInt(ev.path[2].childNodes[7].innerText);
        ev.path[2].childNodes[7].innerHTML = parseInt(ev.path[2].childNodes[3].innerHTML) * parseInt(ev.path[0].value); //total product price
        ev.path[2].childNodes[7].innerHTML += "€";
        totalPrice.innerText = parseInt(totalPrice.innerText) + parseInt(ev.path[2].childNodes[7].innerText); 
        totalPrice.innerText+="€";
    }
    totalPrice.innerText = parseInt(totalPrice.innerText) + parseInt(productPrices[$item].innerText); 
    totalPrice.innerText+="€";
}


//form validation
const form = document.getElementById('placeOrder');
const deliveryType = document.getElementById('selectDeliveryOption');
const street = document.getElementById('streetInput');
const number = document.getElementById('numberInput');
const city = document.getElementById('cityInput');
const postalCode = document.getElementById('postCodeInput');
const country = document.getElementById('countryInput');
const deliveryDate = document.getElementById('deliveryDateInput');
const deliveryTime = document.getElementById('timeDeliveryOption');

form.addEventListener('submit', e => {
    if (!validateInputs()){
        document.getElementById('Address').click();
        e.preventDefault();
    }
})

const setError = (message, id) => {
    const errorDisplay = document.getElementById(id)
    errorDisplay.innerText = message;
    errorDisplay.classList.add('error');
    errorDisplay.classList.remove('succes');
}

const setSucces = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error'); 
    errorDisplay.innerText = '';
    inputControl.classList.remove('error');
}

function isInt(value) {
    if (isNaN(value)) {
      return false;
    }
    var x = parseFloat(value);
    return (x | 0) === x;
}

const validateInputs = () => {
    const deliveryTypeValue = deliveryTime.value.trim();
    const streetValue = street.value.trim();
    const numberValue = number.value.trim();
    const cityValue = city.value.trim();
    const postalCodeValue = postalCode.value.trim();
    const countryValue = country.value.trim();
    const deliveryDateValue = deliveryDate.value.trim();
    const deliveryTimeValue = deliveryTime.value.trim();

    flag = true;
    if(deliveryTypeValue == 'Delivery'){
        if (streetValue === ''){
            setError('Please provide the street', 'street-error');
            flag= false;
        } else if(streetValue.length > 128){
            setError('Your street can not be longer than 128 characters', 'street-error');
            flag = false;
        } else if(streetValue.length < 3){
            setError('Your street name needs to be longer than 3 characters', 'street-error');
            flag=false;
        }

        if (numberValue === ''){
            setError('Please provide your address number', 'number-error');
            flag = false;
        } else if (!isInt(numberValue)){
            setError('Please provide a valid address', 'number-error');
            flag = false;
        }

        if (cityValue === ''){
            setError('Please provide a city', 'city-error');
            flag = false;
        } else if(cityValue.length > 128){
            setError('City name needs to be less than 128 characters', 'city-error');
            flag = false;
        } else if(cityValue.length < 3){
            setError('City name needs to be at least 3 characters long', 'city-error');
            flag = false;
        }

        if (postalCodeValue === ''){
            setError('Please provide your postal code', 'postal_code-error');
            flag = false;
        } else if (!isInt(postalCodeValue)){
            setError('Your postal code needs to be an integer', 'postal_code-error');
            flag = false;
        }

        if (countryValue === ''){
            setError('Please provide the country', 'country-error');
            flag = false;
        } else if(countryValue.length > 64){
            setError('Country needs to be less than 64 characters', 'country-error');
            flag = false;
        } else if(countryValue.length < 3){
            setError('Country name needs to be more than 3 characters', 'country-error');
            flag = false;
        }
    }
    if (deliveryDateValue === ''){
        setError('please select a date of delivery', 'date_of_delivery-error');
        flag = false;    
    } else if ((new Date(deliveryDateValue)) >= (new Date(Date(deliveryDateValue).getDate() + 3)) && (new Date(deliveryDateValue)) <= (new Date(Date(deliveryDateValue).getDate() + 100))) {
        setError('Please select a valid delivery date', 'date_of_delivery-error');
        flag = false;
    }
    if(deliveryTimeValue === ''){
        setError('please select a time of delivery', 'delivery_time-error');
        flag = false;
    } else if (deliveryTimeValue != "Morning" || deliveryTimeValue != "Afternoon"){
        setError('please pick a valid option', 'delivery_time-error');
        flag = false;
    }
    return flag;
}


