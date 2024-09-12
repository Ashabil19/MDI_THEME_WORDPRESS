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


document.addEventListener('DOMContentLoaded', function() {
  const filterItems = document.querySelectorAll('.parent-category');

  filterItems.forEach(item => {
    item.addEventListener('click', function() {
      const childCategories = this.querySelector('.child-categories');
      const isExpanded = this.classList.contains('expanded');

      // Toggle collapse/expand
      if (isExpanded) {
        childCategories.style.display = 'none';
        this.classList.remove('expanded');
      } else {
        childCategories.style.display = 'block';
        this.classList.add('expanded');
      }
    });
  });
});


// end navbar
