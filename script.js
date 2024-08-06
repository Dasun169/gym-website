window.addEventListener('load', function() {
  setTimeout(function() {
      var image = document.getElementById('delayedImage');
      image.classList.add('show');
  }, 500); 
});

document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    document.querySelectorAll('.hidden').forEach(function(element) {
      element.classList.remove('hidden');
      element.classList.add('fade-in');
    });
  }, 1000);
});

document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
    document.querySelectorAll('.hidden').forEach(function(element) {
      element.classList.remove('hidden');
      element.classList.add('fade-in');
    });
  }, 1000);
});