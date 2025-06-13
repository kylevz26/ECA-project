// for opening login and register pages (index)
document.addEventListener('DOMContentLoaded', () => {
  const goToLoginBtn = document.querySelector('.btnGoToLogin');
   const goToRegisterBtn = document.querySelector('.btnGoToRegister');

   if(goToLoginBtn){
      goToLoginBtn.addEventListener('click', () => {  //if login button is clicked - takes them to login form
        window.location.href = 'login.php';
      });
   }

   if(goToRegisterBtn){
      goToRegisterBtn.addEventListener('click', () => { //if register button is clicked - takes them to register form
        window.location.href = 'register.php';  
      });
   }
});