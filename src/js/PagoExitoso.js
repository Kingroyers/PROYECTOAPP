setTimeout(() => {
  let alert = document.querySelector(".alert");
  if (alert) {
    alert.style.transition = "opacity 0.5s";
    alert.style.opacity = "0";
    setTimeout(() => alert.remove(), 500);
  }
}, 3000);
