  function getConfirmation(){
               var retVal = confirm("Do you want to delete this complaint?");
               if( retVal == true ){
                  return true;
               }
               else{
                  return false;
               }
            }
             function getUpdateConfirmation(){
               var retVal = confirm("Do you want to Update this complaint?");
               if( retVal == true ){
                  return true;
               }
               else{
                  return false;
               }
            }

function marksolved(){
               var retVal = confirm("Do you want to marked solve?");
               if( retVal == true ){
                  return true;
               }
               else{
                  return false;
               }
            }
// sidenav
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
});

// Collapsible
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems,{
    accordion:false
    });
});

// selectors
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});


  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, {autoClose:true});
  });




    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.timepicker');
    var instances = M.Timepicker.init(elems, {autoClose:true});
  });

  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
  });

   document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems);
  });