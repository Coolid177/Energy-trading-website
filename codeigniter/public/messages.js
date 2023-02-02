const form = document.getElementById('sendMessage');
const message = document.getElementById('messageInput');

form.addEventListener('submit', e => {
    if (!validateInputs()){
        e.preventDefault();
    }
})

function containsOnlySpaces(str){
    return /^\s*$/.test(str);
}

const validateInputs = () => {
    const messageValue = message.value.trim();
    flag = true;
    if(containsOnlySpaces(messageValue)){
        flag=false;
    }
    return flag;
} 

(function () {
    'use strict'
  
    document.querySelector('#navbarSideCollapse').addEventListener('click', function () {
      document.querySelector('.offcanvas-collapse').classList.toggle('open')
    })
  })()
  