const phoneNumber = document.getElementById("phoneNumberInput");
const company = document.getElementById("companyInput");
const description = document.getElementById("documentInput");
const form = document.getElementById("updateProfileForm");

const setError = (message, id) => {
    const errorDisplay = document.getElementById(id)
    errorDisplay.innerText = message;
}

const setSucces = element => {
    const inputControl = document.getElementById(element);
    inputControl.innerText = '';
}

function isAlphaSpace(value){
    const re = /^[a-zA-Z ]+$/;
    return re.test(String(value).toLowerCase());
}

form.addEventListener('submit', e => {
    if (!validateInputs()){
        e.preventDefault();
    }
})

const validateInputs = () => {
    const phoneNumberValue = phoneNumber.value.trim();
    const companyValue = company.value.trim();
    const descriptionValue = description.value.trim();
    
    flag = true;
    if(phoneNumberValue === ''){
        setError("Please enter a phone number","phone_number-error");
        flag=false;
    } else if (phoneNumberValue.length > 15){
        setError("maximum length for a phone number is 15","phone_number-error");
        flag=false;
    } else if (phoneNumberValue.length < 10){
        setError("phone number needs to be at least 10 numbers","phone_number-error");
        flag=false;
    } else {
        setSucces("phone_number-error");
    }

    if (companyValue === ''){
        setError("Please provide a company name", "company-error");
        flag=false;
    } else if (companyValue.length > 128){
        setError("Company name should not be longer than 128 characters", 'company-error');
        flag=false;
    } else if (companyValue.length < 3){
        setError("Company name should be at least 3 characters long", 'company-error');
        flag=false;
    } else if (!(isAlphaSpace(companyValue))){
        setError("please use only spaces and alphanumeric characters", 'company-error');
        flag=false;
    } else {
        setSucces("company-error");
    }

    if (descriptionValue === ''){
        setError("Please provide a profile description", "description-error");
        flag=false;
    } else if (descriptionValue.length > 1000){
        setError("Description can not be longer than 1000 characters", "description-error");
        flag=false;
    } else if (descriptionValue.length < 50){
        setError("Description should be at least 50 characters long", "description-error");
        flag=false;
    } else {
        setSucces("description-error");
    }

    return flag;
}