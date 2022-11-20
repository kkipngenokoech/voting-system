const form = document.getElementById("register");
const fname = document.getElementById("fname");
const fnameError = document.getElementById("fname-error");
const surname = document.getElementById("surname");
const surnameError = document.getElementById("surname-error");
const phonenumber = document.getElementById("phonenumber");
const phonenumberError = document.getElementById("phonenumber-error");
const email = document.getElementById("email");
const emailError = document.getElementById("email-error");
const password = document.getElementById("password");
const passwordError = document.getElementById("password-error");

const submitHandler = (event) => {
  event.preventDefault();
  if (fname.value === "" || fname.value == null) {
    fnameError.innerText = "Enter your first name!";
  }
  if (surname.value === "" || surname.value == null) {
    surnameError.innerText = "Enter your surname!";
  }
  if (
    phonenumber.value.length < 10 ||
    phonenumber.value.length > 10 ||
    phonenumber.value == null
  ) {
    phonenumberError.innerText = "Enter 10 digit phone number";
  }
  if (email.value === "" || email.value == null) {
    emailError.innerText = "Enter your email";
  }
  if (password.value === "" || password.value == null) {
    passwordError.innerText = "Enter your password";
  }
};

form.addEventListener("submit", submitHandler);
