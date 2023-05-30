/*
0-Overlay
1-Push Content
2-Push Content w/ opacity
3-Full-width
4-Without Animation
*/
function openNav(num) {
  console.log("openNav: " + num);
  switch (num) {
    case 0:
      /* Set the width of the side navigation to 250px */
      document.getElementById("mySidenav").style.left = "0";
      break;
    case 1:
      /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
      document.getElementById("mySidenav").style.left = "0";
      document.getElementById("main").style.marginLeft = "20vw";
      break;
    case 2:
      /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
      document.getElementById("mySidenav").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
      document.body.style.backgroundColor = "rgb(177,147,108)";
      break;
    case 3:
      document.getElementById("mySidenav").style.width = "100%";
      break;
    case 4:
      document.getElementById("mySidenav").style.transition = "0";
      document.getElementById("mySidenav").style.display = "block";
      document.getElementById("mySidenav").style.width = "250px";
      break;
    default:
      /* Set the width of the side navigation to 250px as case 0*/
      document.getElementById("mySidenav").style.width = "250px";
      break;
  }

  document.getElementById("bg-gray").style.display = "block";
}

function closeNav(num) {
    console.log("closeNav: " + num);
  switch (num) {
    case 0:
      /* Set the width of the side navigation to 0 */
      document.getElementById("mySidenav").style.left = "-20vw";
      break;
    case 1:
      /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
      document.getElementById("mySidenav").style.left = "-20vw";
      document.getElementById("main").style.marginLeft = "0";
      break;
    case 2:
      /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
      document.getElementById("mySidenav").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      document.body.style.backgroundColor = "rgb(222,184,135)";
      break;
    case 3:
      document.getElementById("mySidenav").style.width = "0";
      break;
    case 4:
      document.getElementById("mySidenav").style.transition = "0";
      document.getElementById("mySidenav").style.display = "none";
      break;
    default:
      /* Set the width of the side navigation to 0 as case 0*/
      document.getElementById("mySidenav").style.width = "0";
      break;
  }

  document.getElementById("bg-gray").style.display = "none";
}

function changeValue() {
  var x = document.querySelectorAll(".form-check-input");
  var y = "";
  x.forEach((element) => {
    if (element.checked) {
      y = element.getAttribute("value");
    }
  });
  document.getElementById("showValue").innerHTML = "value: " + y;
}

function setDefaultCheck(num) {
  var x = document.querySelectorAll(".form-check-input");
  x.forEach((element) => {
    if (element.getAttribute("value") == num) {
      element.checked = true;
      document.getElementById("showValue").innerHTML = "value: " + num;
    }
  });
}
