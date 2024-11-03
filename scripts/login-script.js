window.addEventListener("DOMContentLoaded", () => {
  document.body.style.opacity = "1";

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
