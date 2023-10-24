<?php

if(isset($_POST["submit"]))
{

    $country = $_POST["country"];

    mysqli_query($mysqli, "INSERT INTO travel_overseas
    (
    country
    )

    VALUES
    (
      '".$country."'
      )
");
}

?>
          
          <form id="travelling-form" name="borang" action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
              <!-- <div class="form-group"> -->
                
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" required />
                </div>

                <br>
                
                <br>

                <div id="form-buttons-container">
              <div class="form-buttons">
                <button type="submit"  name="submit">Submit</button>
              </div>
            </div>
             
          </form>
    </div>  
  </body>
</html>