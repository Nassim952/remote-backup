window.addEventListener("load", function () {
    function sendData(element, url) {
      var XHR = new XMLHttpRequest();
  
      // Liez l'objet FormData et l'élément form
      var dataform = document.getElementById(element);
      var FD = new FormData(dataform);

      if(element == "getseance") {
        FD.append('date', document.getElementById("date_seance").value);
      } else if(element == "getreservation") {
        FD.append('date', document.getElementById("date_resa").value);
        FD.append('email', document.getElementById("email_input").value);
      }
  
      // Définissez ce qui se passe si la soumission s'est opérée avec succès
      XHR.addEventListener("load", function() {
        var divResult = document.querySelector('div#result' + element);
        divResult.innerHTML = this.responseText;
      });
  
      // Definissez ce qui se passe en cas d'erreur
      XHR.addEventListener("error", function(event) {
        alert('Oups! Quelque chose s\'est mal passé.');
      });
  
      // Configurez la requête
      XHR.open("POST", url);
  
      // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
      XHR.send(FD);
    }
   
    // Accédez à l'élément form …
    var form = document.getElementById("getseance");
  
    // … et prenez en charge l'événement submit.
    form.addEventListener("submit", function (event) {
      event.preventDefault();   
      
      element = "getseance";
      url = "/getSeances";

      sendData(element, url);
    });

    var form2 = document.getElementById("getreservation");

    form2.addEventListener("submit", function (event) {
      event.preventDefault(); 

      element = "getreservation";
      url = "/getReservations";

      sendData(element, url);
    });


    // Gestion des onglets
    $(function() {
			$('#onglets').css('display', 'block');
			$('#onglets').click(function(event) {
				var actuel = event.target;
				if (!/li/i.test(actuel.nodeName) || actuel.className.indexOf('actif') > -1) {
					return;
				}
				$(actuel).addClass('actif').siblings().removeClass('actif');
				setDisplay();
			});
			function setDisplay() {
				var modeAffichage;
				$('#onglets li').each(function(rang) {
					modeAffichage = $(this).hasClass('actif') ? '' : 'none';
					$('.item').eq(rang).css('display', modeAffichage);
				});
			}
			setDisplay();
		});

  });
