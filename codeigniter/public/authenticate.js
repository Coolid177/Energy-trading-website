const form = document.getElementById('form');
const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const password = document.getElementById('password');
const cpassword = document.getElementById('cpassword');
const email = document.getElementById('email');

form.addEventListener('submit', e => {
    if (!validateInputs()){
        //account creation failed
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

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const validateInputs = () => {
    const fnameValue = fname.value.trim();
    const lnameValue = lname.value.trim();
    const passwordValue = password.value.trim();
    const cpasswordValue = cpassword.value.trim();
    const emailValue = email.value.trim();

    flag = true;
    if (fnameValue === ''){
        setError('First name is required', 'fname-error');
        flag = false;
    } else if (fnameValue.length < 3 || fnameValue.length > 32){
        setError('first name must be more than 2 characters and less than 32', 'fname-error');
        flag = false;
    } else if (fnameValue.match(/[|\\/~^:,;?!&%$'"@*+]/)) {
        setError('You cannot use symbols', 'fname-error');
        flag = false;
    } else {
        setSucces(fname);
    }
    
    if (lnameValue === ''){
        setError('Last name is required', 'lname-error');
        flag = false;    
    } else if (lnameValue.length < 3 || lnameValue.length > 32){
        setError('first name must be more than 2 characters and less than 32', 'fname-error');
        flag = false;
    } else if (lnameValue.match(/[|\\/~^:,;?!&%$'"@*+]/)) {
        setError('You cannot use symbols', 'lname-error');
        flag = false;
    } else {
        setSucces(lname);
    }

    if (emailValue === ''){
        setError('Email is required', 'email-error');
        flag = false;   
    } else if (!isValidEmail(emailValue)){
        setError('provide a valid email address', 'email-error');
        flag = false;
    } else {
        setSucces(email);
    }

    if (passwordValue === ''){
        setError('Password is required', 'password-error');
        flag = false;
    } else {
        setSucces(password);
    }

    if(cpasswordValue === ''){
        setError('Please confirm your password', 'cpassword-error');
        flag = false;
    } else if (passwordValue !== cpasswordValue){
        setError("Passwords don't match", 'cpassword-error');
        flag = false;
    } else {
        setSucces(cpassword);
    }
    return flag;
}

