var win = window;
function newindow(){
  win.open("https://www.google.com/", "_blank" , "width=600,height=400");
}
var i=0;
function startAlerts(){
  setTimeout(function(){alert("trial :"+ i++ +" The page is still loading")}, 2000);
}


// location object concerned with the webpage location
// navigator object concerned with the browser being used
// document object concerned with the whole HTML code



const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("toggle-btn");
const login_header_link = document.getElementById("login_header_link");
const contact_header_link = document.getElementById("contact_header_link");
const signup_link = document.getElementById("signup_link");
const open_login_sidebarBtn = document.getElementById("open_login_sidebar");
popuplogin = document.getElementById("popuplogin");
overlay = document.getElementById("overlay");

let isOpen = false;


// Sidebar Open/Close
{
  toggleBtn.addEventListener("click", (event) => {
      event.stopPropagation(); // Prevent closing when clicking the button
      if (isOpen) {
          closeSidebar();
      } else {
          openSidebar();
      }
  });
  login_header_link.addEventListener("click", (event) => {
      event.stopPropagation(); // Prevent closing when clicking the button
      if (isOpen) {
          closeSidebar();
      } else {
          openSidebar();
      }
  });
  contact_header_link.addEventListener("click", (event) => {
      event.stopPropagation(); // Prevent closing when clicking the button
      if (isOpen) {
          closeSidebar();
      } else {
          openSidebar();
      }
  });
}
function openSidebar() {
    sidebar.style.right = "0";
    toggleBtn.innerHTML = "➤"; // Change the button text
    toggleBtn.style.transform = "rotate(0deg)";
    isOpen = true;
}

function closeSidebar() {
    sidebar.style.right = "-500px";
    toggleBtn.innerHTML = "◄";
    toggleBtn.style.transform = "rotate(180deg)";
    isOpen = false;
}

{
  document.addEventListener("click", (event) => {
    if (isOpen && !sidebar.contains(event.target) && !login_header_link.contains(event.target)) {
        closeSidebar();
    }
  });
  document.addEventListener("click", (event) => {
    if (isOpen && !sidebar.contains(event.target) && !contact_header_link.contains(event.target)) {
        closeSidebar();
    }
  });
}


document.addEventListener('DOMContentLoaded', () => {
  // Get all flip links
  const flipLinks = document.querySelectorAll('.flip-link');

  // Add click event listeners to each link
  flipLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault(); // Prevent the default link behavior

      // Get the target div ID from the data-target attribute
      const targetDivId = this.getAttribute('data-target');

      // Hide all divs
      document.querySelectorAll('.card-login, .card-signup , .card-contact').forEach(div => {
        div.style.display = 'none';
      });

      // Show the target div
      const targetDiv = document.getElementById(targetDivId);
      if (targetDiv) {
        targetDiv.style.display = 'block';
      } else {
        console.error(`Element with id "${targetDivId}" not found.`);
      }
    });
  });
});

document.getElementById("avatar").addEventListener("change", function() {
  let messageBox = document.getElementById("message_contact");
  if (this.files.length > 0) {
      messageBox.style.display = "none"; // Hide the message box
      messageBox.removeAttribute("required"); // Remove required attribute
  } else {
      messageBox.style.display = "block"; // Show the message box again
      messageBox.setAttribute("required", "true"); // Make it required again
  }
});


function viewDetails(key) {
  popuplogin.classList.add("active");
  if (key != 0) {
  popuplogin.querySelector("p").innerText = "Please Login first so that you can view the product details";
  }else{
    popuplogin.querySelector("p").innerText = "Invalid Username or Password";
  }
  overlay.classList.add("active");
}

function closePopup() {
  popuplogin.classList.remove("active");
  overlay.classList.remove("active");
}

open_login_sidebarBtn.addEventListener("click", (event) => {
  event.stopPropagation(); // Prevent closing when clicking the button
  closePopup();
  login_header_link.click();
});


var i=1; 
var timer;
var timer2;
{
  function backgroundChange(){
    timer = setTimeout(backgroundChange, 2000);
    document.images[1].src = "data/backgrounds/Capture"+i+".PNG";
    i++;
    if(i>7)  i=1;
  }
  var j =8;
  function backgroundChange2(){
    timer2 = setTimeout(backgroundChange2, 2000);
    document.images[0].src = "data/backgrounds/Capture"+j+".PNG";
    j++;
    if(j>11)  j=8;
  }

  function backgroundreset2(){
    clearTimeout(timer2);
    document.images[0].src = "data/backgrounds/Capture8.PNG";
  }
  function backgroundreset(){
    clearTimeout(timer);
    document.images[1].src = "data/backgrounds/Capture1.PNG";
  }
}

if (window.location.href.indexOf('error=password') !== -1){
  toggleBtn.click();
  document.querySelectorAll('.card-login, .card-signup , .card-contact').forEach(div => {
    div.style.display = 'none';
  });
  const targetDiv = document.querySelector('.card-signup');
  targetDiv.style.display = 'block';
}
else if(window.location.href.indexOf('error=null') !== -1){
  alert("You have successfully signed up! Now LOGiN and enjoy ^_-");
  toggleBtn.click();
  document.querySelectorAll('.card-login, .card-signup , .card-contact').forEach(div => {
    div.style.display = 'none';
  });
  const targetDiv = document.querySelector('.card-login');
  targetDiv.style.display = 'block';
}
else if(window.location.href.indexOf('fileuploaded') !== -1){
  alert("your message has been sent! we will contact you as soon as possible");
}
else if(window.location.href.indexOf('error=invalidlogin') !== -1){
  viewDetails(0);
}

