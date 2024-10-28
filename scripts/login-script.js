/*Change this to go to homepage
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const leftSide = document.querySelector('.left');
    const rightSide = document.querySelector('.right');

    leftSide.classList.add('left-after');
    rightSide.classList.add('right-after');

    setTimeout(() => {
        leftSide.querySelector('.inner').classList.add('fade-out');
        rightSide.querySelector('.inner').classList.add('fade-out');

        setTimeout(() =>{
            leftSide.innerHTML = '';
            rightSide.innerHTML = '';
        }, 500);
    }, 700);
});*/

const signUpLink = document.querySelector(".links a");

signUpLink.addEventListener("click", function (event) {
  event.preventDefault();

  const boxShadow = document.querySelector(".box-container");
  const leftSide = document.querySelector(".left");
  const rightSide = document.querySelector(".right");

  boxShadow.classList.add("no-shadow");
  leftSide.classList.add("left-after");
  rightSide.classList.add("right-after");

  setTimeout(() => {
    window.location.href = "signup.php";
  }, 700);

  setTimeout(() => {
    boxShadow.classList.remove("no-shadow");
  }, 1400);
});
