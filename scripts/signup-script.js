/*document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const leftSide = document.querySelector('.left');
    const rightSide = document.querySelector('.right');

    leftSide.classList.add('left-after');
    rightSide.classList.add('right-after');

    setTimeout(() => {
        leftSide.innerHTML = '';
        rightSide.innerHTML = '';   
    }, 700);
}); */
// Show and hide dropdown options
// Toggle dropdown visibility for all headers

// Toggle dropdown visibility for all headers
document.querySelectorAll(".dropdown-header").forEach((header) => {
  header.addEventListener("click", function () {
    const dropdownList = this.nextElementSibling; // Get the dropdown list
    const isVisible = dropdownList.style.display === "block";

    // Hide all dropdowns
    document.querySelectorAll(".dropdown-list").forEach((list) => {
      list.style.display = "none";
    });

    // Toggle the current dropdown
    dropdownList.style.display = isVisible ? "none" : "block";
  });
});

// Set selected option and hide dropdown for all items
document.querySelectorAll(".dropdown-item").forEach((item) => {
  item.addEventListener("click", function () {
    const header = this.closest(".custom-dropdown").querySelector(
      ".dropdown-header .select-text"
    );
    header.innerText = this.innerText; // Update the header text with selected option
    const value = this.dataset.value; // Get the selected value
    const hiddenInput = this.closest(".custom-dropdown").querySelector(
      'input[type="hidden"]'
    );
    hiddenInput.value = value; // Set the hidden input's value

    // Hide the dropdown options
    const dropdownList = this.closest(".dropdown-list");
    dropdownList.style.display = "none";
  });
});

// Optional: Close dropdown when clicking outside
document.addEventListener("click", function (event) {
  const isDropdown = event.target.closest(".custom-dropdown");
  if (!isDropdown) {
    document.querySelectorAll(".dropdown-list").forEach((list) => {
      list.style.display = "none"; // Hide all dropdowns
    });
  }
});

// Add scrollbar specifically to the section dropdown if needed
const sectionDropdownList = document.getElementById("section-dropdown-list");
sectionDropdownList.style.maxHeight = "150px"; // Set a max height for scrolling
sectionDropdownList.style.overflowY = "auto"; // Enable vertical scrollbar

const loginLink = document.querySelector(".links a");

loginLink.addEventListener("click", function (event) {
  event.preventDefault();

  const boxShadow = document.querySelector(".box-container");
  const leftSide = document.querySelector(".left");
  const rightSide = document.querySelector(".right");

  boxShadow.classList.add("no-shadow");
  leftSide.classList.add("left-after");
  rightSide.classList.add("right-after");

  setTimeout(() => {
    window.location.href = "login.php";
  }, 700);

  setTimeout(() => {
    boxShadow.classList.remove("no-shadow");
  }, 1400);
});
