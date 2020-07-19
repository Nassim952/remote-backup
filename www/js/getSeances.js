window.addEventListener("load", function () {
    function sendData() {
      var XHR = new XMLHttpRequest();
  
      // Liez l'objet FormData et l'élément form
      var dataform = document.getElementById("getseance");
      var FD = new FormData(dataform);

      FD.append('date', document.getElementById("date_seance").value);
  
      // Définissez ce qui se passe si la soumission s'est opérée avec succès
      XHR.addEventListener("load", function() {
        var divResult = document.querySelector('div#result');
        divResult.innerHTML = this.responseText;
      });
  
      // Definissez ce qui se passe en cas d'erreur
      XHR.addEventListener("error", function(event) {
        alert('Oups! Quelque chose s\'est mal passé.');
      });
  
      // Configurez la requête
      XHR.open("POST", "/getSeances");
  
      console.log(FD);
      // Les données envoyées sont ce que l'utilisateur a mis dans le formulaire
      XHR.send(FD);
    }
   
    // Accédez à l'élément form …
    var form = document.getElementById("getseance");
  
    // … et prenez en charge l'événement submit.
    form.addEventListener("submit", function (event) {
      event.preventDefault();
  
      sendData();
    });
  });

/* window.addEventListener("load", function () {
  var form = document.getElementById("getseance");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    var dataform = new FormData(document.getElementById("getseance"));
    $.ajax({
        url: '/getSeances',
        type: 'POST',
        data: dataform,
        success: function(data, status){
            alert(data);
        }
    })
  });
}); */