const registerButton = document.getElementById("register");
const loginButton = document.getElementById("login");
const container = document.getElementById("container");

registerButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});

loginButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

document.addEventListener('DOMContentLoaded', function () {
  var messageContainer = document.querySelector('.message-container');
  var loginButton = document.querySelector('#login');
  var registerButton = document.querySelector('#register');

  var showMessageContainer = messageContainer && messageContainer.innerHTML.trim() !== '';

  // biar keliatan
  if (showMessageContainer) {
      messageContainer.classList.add('show');
      setTimeout(function () {
        messageContainer.classList.remove('show');
    }, 3000);
  }

  if (loginButton && registerButton) {
      loginButton.addEventListener('click', function () {
          // switching to the login 
          messageContainer.classList.remove('show');
      });

      registerButton.addEventListener('click', function () {
          // switching to the regis
          messageContainer.classList.remove('show');
      });
  }
});
