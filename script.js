function showAlert() {
    document.getElementById("alert").style.display = "block";

setTimeout(function() {
    document.getElementById("alert").style.display = "none";
}, 10000);

}
function addComp() {
    document.getElementById("addNew").style.display = "block";
}

function showBackup() {
    document.getElementById("showBackup").style.display = "block";
}
function hideBackup() {
    document.getElementById("showBackup").style.display = "none";
}

function showAdd() {
    document.getElementById("showAdd").style.display = "block";
}
function hideAdd() {
    document.getElementById("showAdd").style.display = "none";
}


function showEdit() {
    document.getElementById("showEdit").style.display = "block";
}
function hideEdit() {
    document.getElementById("showEdit").style.display = "none";
}


function showDell() {
    document.getElementById("showDell").style.display = "block";
}
function hideDell() {
    document.getElementById("showDell").style.display = "none";
}


// darkmore

// function togglemode() {
// const container = document.getElementById("container");
// const darkModeSwitch = document.getElementById("dark-mode-switch");

// darkModeSwitch.addEventListener("change", function() {
//   if (this.checked) {
//     container.style.backgroundColor = "#f2f2f2";
//     // container.style.text = "#000000";
//   } else {
//     container.style.backgroundColor = "#23242a";
//     // container.style.color = "white";
//   }
// });
// }




// nowy sposob darkmode

const toggleSwitch = document.querySelector('#dark-mode-switch input[type="checkbox"]');
// pobieramy z localStorage theme rodzaj dark/light
const currentTheme = localStorage.getItem('theme');

// jeżeli theme istnieje 
if (currentTheme) {
  // ustawiamy data-theme klasę w elemencie html data-theme="light"
  document.documentElement.setAttribute('data-theme', currentTheme);

  // jeżeli theme jest dark zmieniamy przełącznik a dokładnie checkbox na true
  if (currentTheme === 'dark') {
    toggleSwitch.checked = true;
  }
}

// funkcja ustawiająca data-theme w zależności od przełącznika
function switchTheme(event) {
  if (event.target.checked) {
    document.documentElement.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
  }
  else {
    document.documentElement.setAttribute('data-theme', 'light');
    localStorage.setItem('theme', 'light');
  }
}

// obserwujemy zdarzenie w naszym przypadku na change uruchamiamy funkcję switchTheme
toggleSwitch.addEventListener('change', switchTheme, false);