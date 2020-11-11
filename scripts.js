    //Getting value from "ajax.php".
    function fill(Value) {
       //Assigning value to "search" div in "search.php" file.
	   var oldValue = Value;
	   var splitString = oldValue.split("#");
	   var newValue = splitString[0];
       $('#search').val(splitString[1]);
	   $('#id_pacijenta').val(newValue);
	   document.getElementById('ispis_napomene_pacijenta').innerHTML = $('#ispis_napomene_pacijenta').val(splitString[2]);
	   
       //Hiding "display" div in "search.php" file.
       $('#display').hide();
    }
    $(document).ready(function() {
       //On pressing a key on "Search box" in "search.php" file. This function will be called.
       $("#search").keyup(function() {
           //Assigning search box value to javascript variable named as "name".
           var name = $('#search').val();
           //Validating, if "name" is empty.
           if (name == "") {
               //Assigning empty value to "display" div in "search.php" file.
               $("#display").html("");
           }
           //If name is not empty.
           else {
               //AJAX is called.
               $.ajax({
                   //AJAX type is "Post".
                   type: "POST",
                   //Data will be sent to "ajax.php".
                   url: "ajax.php",
                   //Data, that will be sent to "ajax.php".
                   data: {
                       //Assigning value of "name" into "search" variable.
                       search: name
                   },
                   //If result found, this funtion will be called.
                   success: function(html) {
                       //Assigning result to "display" div in "search.php" file.
                       $("#display").html(html).show();
                   }
               });
           }
       });
    });