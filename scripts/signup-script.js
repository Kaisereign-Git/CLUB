document.querySelectorAll(".dropdown-header").forEach((header) => {
  header.addEventListener("click", function () {
    const dropdownList = this.nextElementSibling;
    const isVisible = dropdownList.style.display === "block";

    document.querySelectorAll(".dropdown-list").forEach((list) => {
      list.style.display = "none";
    });

    dropdownList.style.display = isVisible ? "none" : "block";
  });
});

document.querySelectorAll(".dropdown-item").forEach((item) => {
  item.addEventListener("click", function () {
    const header = this.closest(".custom-dropdown").querySelector(
      ".dropdown-header .select-text"
    );
    header.innerText = this.innerText;
    const value = this.dataset.value;
    const hiddenInput = this.closest(".custom-dropdown").querySelector(
      'input[type="hidden"]'
    );
    hiddenInput.value = value;

    const dropdownList = this.closest(".dropdown-list");
    dropdownList.style.display = "none";
  });
});

document.addEventListener("click", function (event) {
  const isDropdown = event.target.closest(".custom-dropdown");
  if (!isDropdown) {
    document.querySelectorAll(".dropdown-list").forEach((list) => {
      list.style.display = "none";
    });
  }
});

const sectionDropdownList = document.getElementById("section-dropdown-list");

window.addEventListener("DOMContentLoaded", () => {
  const leftInner = document.querySelector(".left .inner");
  const rightInner = document.querySelector(".right .inner");
  const boxShadow = document.querySelector(".box-container");

  leftInner.classList.add("fade-in");
  rightInner.classList.add("fade-in");
  boxShadow.classList.add("yes-shadow");
});

function handleTransition(link) {
  const leftInner = document.querySelector(".left .inner");
  const rightInner = document.querySelector(".right .inner");
  const boxShadow = document.querySelector(".box-container");
  const leftSide = document.querySelector(".left");
  const rightSide = document.querySelector(".right");

  // Start fade-out for inner contents and box shadow
  leftInner.classList.add("fade-out");
  rightInner.classList.add("fade-out");
  boxShadow.classList.remove("yes-shadow"); // Start the transition
  boxShadow.classList.add("no-shadow"); // Fades to no-shadow

  // Trigger movement animations for the sides
  leftSide.classList.add("left-after");
  rightSide.classList.add("right-after");
}

const links = document.querySelectorAll(".links a");

links.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    handleTransition(link);

    setTimeout(() => {
      window.location.href = link.getAttribute("href");
    }, 600);
  });
});
