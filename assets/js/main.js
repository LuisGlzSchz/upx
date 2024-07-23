document.getElementById('main-btn').addEventListener('click', function() {
    var extraButtons = document.getElementById('extra-buttons');
    if (extraButtons.classList.contains('d-none')) {
      extraButtons.classList.remove('d-none');
      extraButtons.style.display = 'flex';
    } else {
      extraButtons.classList.add('d-none');
      extraButtons.style.display = 'none';
    }
  });
