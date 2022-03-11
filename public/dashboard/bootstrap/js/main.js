function copyLink() {
  /* Get the text field */
  var copyText = document.getElementById("link");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    Toast.fire({
    icon: 'success',
    title: 'Link copied'
    })
}

const password = document.querySelector('#password');
const message = document.querySelector('.message');

password.addEventListener('keyup', function (e) {
  if (e.getModifierState('CapsLock')) {
    message.textContent = 'Caps lock is on';
  } else {
    message.textContent = '';
  }
});


