// alert('hey there');
(function() {
      let suc = document.getElementById("successInfo"), success;
      let err = document.getElementById("errorInfo"), error;
      if(suc) {
          suc.className = "show";
          success = function(){
                suc.className = suc.className.replace("show", "");
            }
          setTimeout(success, 3000);
      } else  if (err) {
           err.className = "show";
           error = function(){
                 err.className = err.className.replace("show", "");
             }
           setTimeout(error, 3000);
       }
})();
