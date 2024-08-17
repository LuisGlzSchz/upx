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
    var submitButtons = document.querySelectorAll(".submitButton");
    var spinners = document.querySelectorAll(".spinner");
    var forms = document.querySelectorAll(".contactForm");
  
    terminosCheckboxes.forEach(function (checkbox) {
      checkbox.addEventListener("change", function () {
        var associatedButton = document.querySelector(
          `#${checkbox.dataset.buttonId}`
        );
        if (checkbox.checked) {
          associatedButton.disabled = false;
        } else {
          associatedButton.disabled = true;
        }
      });
    });
  
    forms.forEach(function (form) {
      form.addEventListener("submit", function (event) {
        event.preventDefault();
  
        var associatedButton = form.querySelector(".submitButton");
        var spinner = form.querySelector(".spinner");
  
        spinner.style.display = "inline-block";
        associatedButton.disabled = true;
  
        var formData = new FormData(form);
  
        fetch("enviar_correo.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((result) => {
            if (result.status === "success") {
              window.location.href = "./";
            } else {
              window.location.href = "./?error=true";
            }
          })
          .catch((error) => {
            console.error("Error:", error);
            window.location.href = "./?error=true";
          })
          .finally(() => {
            spinner.style.display = "none";
            associatedButton.disabled = false;
          });
      });
    });
  });
  