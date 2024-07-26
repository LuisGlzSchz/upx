document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('main-btn').addEventListener('click', function() {
      var extraButtons = document.getElementById('extra-buttons');
      if (extraButtons.classList.contains('show')) {
          extraButtons.classList.remove('show');
      } else {
          extraButtons.classList.add('show');
      }
  });
});
