(function() {
  'use strict'
 document.addEventListener('DOMContentLoaded', function() {
   var btnDiv = document.querySelector('.btn')
  var btn = btnDiv.querySelectorAll('button')
  var form = document.querySelector('form');
  var formBtn = form.querySelector('button');
  var formInput = form.querySelectorAll('input')
  var hidden = form.querySelector('#hidden')
  
  btn[0].onclick = () => {
    btnDiv.style.display = 'none'
    form.style.display = 'block'
    formBtn.textContent = 'Create chat room' 
    hidden.value = 'false'
  }
  
  btn[1].onclick = () => {
    btnDiv.style.display = 'none'
    form.style.display = 'block'
    formBtn.textContent = 'Join chat room'
    hidden.value = 'true'
  }
  function closeForm() {
    form.style.display = 'none'
    btnDiv.style.display = 'block'
    formInput.forEach(e => e.value = '')
  }
  document.querySelector('span').addEventListener('click', closeForm)
 
   
 })
})();
