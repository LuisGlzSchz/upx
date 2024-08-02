document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('main-btn').addEventListener('click', function() {
        var extraButtons = document.getElementById('extra-buttons');
        if (extraButtons.classList.contains('show')) {
            extraButtons.classList.remove('show');
        } else {
            extraButtons.classList.add('show');
        }
    });


    var form = document.getElementById('contactForm');
    var submitButton = document.getElementById('submitButton');
    var spinner = document.getElementById('spinner');

    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

       
            spinner.style.display = 'inline-block';
            submitButton.disabled = true;

            var formData = new FormData(form);

            fetch('test_enviar_correo.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === 'success') {
                    window.location.href = './';
                } else {
                    window.location.href = './?error=true'; 
                }
            })
            .catch(error => {
                console.error('Error:', error);
                window.location.href = './?error=true'; 
            })
            .finally(() => {
              
                spinner.style.display = 'none';
                submitButton.disabled = false;
            });
        });
    }
});
