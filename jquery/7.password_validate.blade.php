const checkPassword = () => {
  let password = document.getElementById("password");
  let point = 1;
  let value = password.value;
  let availableChar = [];

  // for warning
  const regexValidator = [
    { regex: /[0-9]/ },
    { regex: /[a-z]/ },
    { regex: /[A-Z]/ },
    { regex: /[^0-9a-zA-Z]/ },
  ];
  if (value.length < 8) {
    document.getElementById("passStatus").innerHTML = "Need 8 characters";
    document.querySelector("#node-box").style.display = "none";
  } else {
    document.getElementById("passStatus").innerHTML = "";
    regexValidator.forEach((ritem, index) => {
      let valid = ritem.regex.test(value);

      if (valid) {
        document.getElementById(`w-${index}`).style.display = "none";
      } else {
        document.getElementById(`w-${index}`).style.display = "block";
      }
    });
  }

  // for box

  if (value.length !== 0) {
    let arrayTest = [/[0-9]/, /[a-z]/, /[A-Z]/, /[^0-9a-zA-Z]/];
    arrayTest.forEach((item) => {
      if (item.test(value)) {
        availableChar.push(item);
        point += 1;
      } else {
        document.querySelector(`.pass-step-2`).style.backgroundColor =
          "#c4c4c4";
        document.querySelector(`.pass-step-3`).style.backgroundColor =
          "#c4c4c4";
        document.querySelector(`.pass-step-4`).style.backgroundColor =
          "#c4c4c4";
      }
    });
    for (let i = 1; i < point; i++) {
      let errorText = "";
      if(point<5){
          document.querySelector(`.pass-step-${i}`).style.backgroundColor = "red";
      }else{
          if(value.length <= 7){
              document.querySelector(`.pass-step-${i}`).style.backgroundColor = "red";
          }else{
              document.querySelector(`.pass-step-${i}`).style.backgroundColor = "#4fb845";
          }
      }
    }
  } else {
    document.querySelector(`.pass-step-1`).style.backgroundColor = "#c4c4c4";
    document.querySelector(`.pass-step-2`).style.backgroundColor = "#c4c4c4";
    document.querySelector(`.pass-step-3`).style.backgroundColor = "#c4c4c4";
    document.querySelector(`.pass-step-4`).style.backgroundColor = "#c4c4c4";
  }
};

// confirm password
const matchPassword = () => {
  const password = document.getElementById("password").value;
  const rePassword = document.getElementById("re-password").value;

  if (password === rePassword) {
    document.getElementById("notMatchAlert").innerHTML = "";
    document.getElementById("set-pass-submit").disabled = false;
  } else {
    document.getElementById("notMatchAlert").innerHTML =
      "Confirm password not matching";
    document.getElementById("set-pass-submit").disabled = true;
  }
};

// show hide password
const showPass = () => {
  const passwordType = document.getElementById("password");

  passwordType.type === "password"
    ? (passwordType.type = "text")
    : (passwordType.type = "password");
};

const showRePass = () => {
  const passwordType = document.getElementById("re-password");

  passwordType.type === "password"
    ? (passwordType.type = "text")
    : (passwordType.type = "password");
};

const showPasswordIcon = () => {
  const show = document.getElementById("password-show");
  const hide = document.getElementById("password-hide");
  show.style.display = "none";
  hide.style.display = "inline-block";
};

const hidePasswordIcon = () => {
  const show = document.getElementById("password-show");
  const hide = document.getElementById("password-hide");
  show.style.display = "inline-block";
  hide.style.display = "none";
};

const showRePasswordIcon = () => {
  const reshow = document.getElementById("repassword-show");
  const rehide = document.getElementById("repassword-hide");
  reshow.style.display = "none";
  rehide.style.display = "inline-block";
};

const hideRePasswordIcon = () => {
  const reshow = document.getElementById("repassword-show");
  const rehide = document.getElementById("repassword-hide");
  reshow.style.display = "inline-block";
  rehide.style.display = "none";
};
