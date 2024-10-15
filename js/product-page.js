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




var coll = document.getElementsByClassName("collapsible");
for (var i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        
        // Mengatur logika max-height agar mengontrol ketinggian elemen collapsible
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}


// end navbar
