(function () {
  "use strict";

  window.addEventListener(
    "load",
    function () {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName("needs-validation");

      // Loop over them and prevent submission
      Array.prototype.filter.call(forms, function (form) {
        form.addEventListener(
          "submit",
          function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }

            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );
})();

function checkValue(str, max) {
  if (str.charAt(0) !== "0" || str == "00") {
    var num = parseInt(str);
    if (isNaN(num) || num <= 0 || num > max) num = 1;
    str =
      num > parseInt(max.toString().charAt(0)) && num.toString().length == 1
        ? "0" + num
        : num.toString();
  }
  return str;
}

//auto-format birthday
var date = document.getElementById("birthday");
if (date) {
  date.addEventListener("input", function (e) {
    this.type = "text";
    var input = this.value;
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    var values = input.split("/").map(function (v) {
      return v.replace(/\D/g, "");
    });
    if (values[0]) values[0] = checkValue(values[0], 31);
    if (values[1]) values[1] = checkValue(values[1], 12);
    var output = values.map(function (v, i) {
      return v.length == 2 && i < 2 ? v + " / " : v;
    });
    this.value = output.join("").substr(0, 14);
  });
}

const isNumericInput = (event) => {
  const key = event.keyCode;
  return (
    (key >= 48 && key <= 57) || // Allow number line
    (key >= 96 && key <= 105) // Allow number pad
  );
};

const isModifierKey = (event) => {
  const key = event.keyCode;
  return (
    event.shiftKey === true ||
    key === 35 ||
    key === 36 || // Allow Shift, Home, End
    key === 8 ||
    key === 9 ||
    key === 13 ||
    key === 46 || // Allow Backspace, Tab, Enter, Delete
    (key > 36 && key < 41) || // Allow left, up, right, down
    // Allow Ctrl/Command + A,C,V,X,Z
    ((event.ctrlKey === true || event.metaKey === true) &&
      (key === 65 || key === 67 || key === 86 || key === 88 || key === 90))
  );
};

const enforceFormat = (event) => {
  // Input must be of a valid number format or a modifier key, and not longer than ten digits
  if (!isNumericInput(event) && !isModifierKey(event)) {
    event.preventDefault();
  }
};


//auto-format phone number
const formatToPhone = (event) => {
  if (isModifierKey(event)) {
    return;
  }

  const input = event.target.value.replace(/\D/g, "").substring(0, 11); // First ten digits of input only
  const areaCode = input.substring(0, 2);
  const middle = input.substring(2, 7);
  const last = input.substring(7, 11);

  if (input.length > 7) {
    event.target.value = `(${areaCode}) ${middle} - ${last}`;
  } else if (input.length > 2) {
    event.target.value = `(${areaCode}) ${middle}`;
  } else if (input.length > 0) {
    event.target.value = `(${areaCode}`;
  }
};

const inputElement = document.getElementById("phone");
if (inputElement) {
  inputElement.addEventListener("keydown", enforceFormat);
  inputElement.addEventListener("keyup", formatToPhone);
}

document.addEventListener("load", () => {
  document.getElementsByTagName("form")[0].reset();
});

function backHistory() {
  window.history.back();
}