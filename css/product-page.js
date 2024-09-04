// navbar
function toggleMenu() {
  const navLinks = document.getElementById("nav-links");
  const overlay = document.getElementById("overlay");

  if (navLinks.style.right === "0px") {
    navLinks.style.right = "-100%";
    overlay.style.display = "none";
  } else {
    navLinks.style.right = "0";
    overlay.style.display = "block";
  }
}

function closeMenu() {
  const navLinks = document.getElementById("nav-links");
  const overlay = document.getElementById("overlay");

  navLinks.style.right = "-100%";
  overlay.style.display = "none";
}

// end navbar
