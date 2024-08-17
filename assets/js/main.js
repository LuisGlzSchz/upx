document.addEventListener("DOMContentLoaded", function () {
  function setCookie(name, value, days, sameSite = "Lax", secure = false) {
      let cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}`;

      if (days) {
          const expires = new Date();
          expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
          cookie += `; expires=${expires.toUTCString()}`;
      }

      if (secure) {
          cookie += `; Secure`;
      }

      if (sameSite) {
          cookie += `; SameSite=${sameSite}`;
      }

      document.cookie = cookie;
  }

  setCookie("miCookieLax", "valorLax", 7, "Lax", true);
  setCookie("miCookieStrict", "valorStrict", 7, "Strict", true);
  setCookie("miCookieNone", "valorNone", 7, "None", true);
  setCookie("miCookieThirdParty", "valorThirdParty", 7, "None", true);

  var terminosCheckboxes = document.querySelectorAll(".terminosCheckbox");
  var forms = document.querySelectorAll(".contactForm");

  terminosCheckboxes.forEach(function (checkbox) {
      checkbox.addEventListener("change", function () {
          var associatedButton = document.querySelector(`#${checkbox.dataset.buttonId}`);
          if (checkbox.checked) {
              associatedButton.disabled = false;
          } else {
              associatedButton.disabled = true;
          }
      });
  });

 var telefonoInput = document.getElementById("telefono");

    telefonoInput.addEventListener("input", function (event) {
        this.value = this.value.replace(/\D/g, '');

        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });



  forms.forEach(function (form) {
      form.addEventListener("submit", function (event) {
          event.preventDefault(); 

          var associatedButton = form.querySelector(".submitButton");
          var spinner = form.querySelector(".spinner");

          if (spinner) {
              spinner.classList.remove("d-none");
              spinner.classList.add("d-inline-block");
          }
          if (associatedButton) {
              associatedButton.disabled = true;
          }

          var formData = new FormData(form);

          fetch(form.action, {
              method: form.method,
              body: formData,
          })
          .then(response => {
              if (response.ok) {
                  window.location.href = "success.html"; 
              } else {
                  window.location.href = "./?error=true"; 
              }
          })
          .catch(error => {
              console.error("Error:", error);
              window.location.href = "./?error=true"; 
          })
          .finally(() => {
              if (spinner) {
                  spinner.classList.remove("d-inline-block");
                  spinner.classList.add("d-none");
              }
              if (associatedButton) {
                  associatedButton.disabled = false;
              }
          });
      });
  });
});