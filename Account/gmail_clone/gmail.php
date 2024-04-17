<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="gmail.css" />
    <title>Gmail</title>
  </head>
  <?php
  session_start();

  if (!isset($_GET['id'])){
    header("Location: ../login.html?error=3");
  }
  $user_id=$_GET['id'];

  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'talentcrafters'; 

  $conn = mysqli_connect($host, $user, $password, $database);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT first_name,last_name FROM user_resumes where user_id = '$user_id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Name=$row['first_name']." ".$row['last_name']." ";
  }

  ?>
  <body>
    <div class="header">
      <div class="header__left">
        <span class="material-icons"> menu </span>
        <img
          src="https://i.pinimg.com/originals/ae/47/fa/ae47fa9a8fd263aa364018517020552d.png"
          alt=""
        />
      </div>

      <div class="header__middle">
        <span class="material-icons"> search </span>
        <input type="text" placeholder="Search mail" />
        <span class="material-icons"> arrow_drop_down </span>
      </div>

      <div class="header__right">
        <span class="material-icons"> apps </span>
        <span class="material-icons"> notifications </span>
        <span class="material-icons"> account_circle </span>
      </div>
    </div>

    <div class="main__body">
      <div class="sidebar">
        <button class="sidebar__compose"><span class="material-icons"> add </span>Compose</button>
        <div class="sidebarOption sidebarOption__active">
          <span class="material-icons"> inbox </span>
          <h3>Inbox</h3>
        </div>

        <div class="sidebarOption">
          <span class="material-icons"> star </span>
          <h3>Starred</h3>
        </div>

        <div class="sidebarOption">
          <span class="material-icons"> access_time </span>
          <h3>Snoozed</h3>
        </div>

        <div class="sidebarOption">
          <span class="material-icons"> label_important </span>
          <h3>Important</h3>
        </div>

        <div class="sidebarOption">
          <span class="material-icons"> near_me </span>
          <h3>Sent</h3>
        </div>

        <div class="sidebarOption">
          <span class="material-icons"> note </span>
          <h3>Drafts</h3>
        </div>

        <div class="sidebarOption">
          <span class="material-icons"> expand_more </span>
          <h3>More</h3>
        </div>

        <div class="sidebar__footer">
          <div class="sidebar__footerIcons">
            <span class="material-icons"> person </span>
            <span class="material-icons"> duo </span>
            <span class="material-icons"> phone </span>
          </div>
        </div>
      </div>
      <!-- Sidebar Ends -->

      <!-- Email List Starts -->
      <div class="emailList">
        <!-- Settings Starts -->
        <div class="emailList__settings">
          <div class="emailList__settingsLeft">
            <input type="checkbox" />
            <span class="material-icons"> arrow_drop_down </span>
            <span class="material-icons"> redo </span>
            <span class="material-icons"> more_vert </span>
          </div>
          <div class="emailList__settingsRight">
            <span class="material-icons"> chevron_left </span>
            <span class="material-icons"> chevron_right </span>
            <span class="material-icons"> keyboard_hide </span>
            <span class="material-icons"> settings </span>
          </div>
        </div>
        <!-- Settings Ends -->

        <!-- Section Starts -->
        <div class="emailList__sections">
          <div class="section section__selected">
            <span class="material-icons"> inbox </span>
            <h4>Primary</h4>
          </div>

          <div class="section">
            <span class="material-icons"> people </span>
            <h4>Social</h4>
          </div>

          <div class="section">
            <span class="material-icons"> local_offer </span>
            <h4>Promotions</h4>
          </div>
        </div>
        <!-- Section Ends -->

        <!-- Email List rows starts -->
        <div class="emailList__list">
          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">TalentCrafters</h3>

            <div class="emailRow__message">
              <h4>
                TalentCrafters Password Recovery
                <span class="emailRow__description"> - Please use the OTP <?php echo $_SESSION['reset_otp'];?> provided to reset your TalentCrafters password. </span>
              </h4>
            </div>

            <p class="emailRow__time"><?php echo date("g:i a");?></p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Amazon Marketplace</h3>

            <div class="emailRow__message">
              <h4>
              <?php echo $Name;?>regarding your recent order at Amazon.in.
                <span class="emailRow__description"> - Hi Aayush Kukreja,will you please take a minute to share your experience? </span>
              </h4>
            </div>

            <p class="emailRow__time">8:36 pm</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">NPTEL</h3>

            <div class="emailRow__message">
              <h4>
              NPTEL Newsletter: IIT Madras CODE Certificate Program on Responsible AI – Tour starting on 1st May 2024 --- Register today to avail discount<span class="emailRow__description">
                  - on Your Channel Future Coders
                </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 11</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Your Indeed job feed</h3>

            <div class="emailRow__message">
              <h4>
              New jobs from your 11 April 2024 feed<span class="emailRow__description">
                  - see opportunities at BNY Mellon, yourDost
                </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 11</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Google Maps Timeline</h3>

            <div class="emailRow__message">
              <h4>
              <?php echo $Name;?>, your March update
                <span class="emailRow__description"> - <?php echo $Name;?>, here's your new Timeline update </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 11</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Rapido Bike Taxi</h3>

            <div class="emailRow__message">
              <h4>
              Winning by playing fantasy sports ❌ Winning by taking rides ✅
                <span class="emailRow__description"> - on Your Channel Future Coders </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 10</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Amazon.in</h3>

            <div class="emailRow__message">
              <h4>
              Delivered: Your Amazon package has been delivered.<span class="emailRow__description">
                  - Your package will be delivered between 7:00AM and 10:00PM
                </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 10</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Google</h3>

            <div class="emailRow__message">
              <h4>
                Login on New Device<span class="emailRow__description">
                  - is this your Device ?
                </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 10</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Zomato</h3>

            <div class="emailRow__message">
              <h4>
              Tap for love advice 😉❤️
                <span class="emailRow__description"> - Discover our unique take on love: sweet, savory </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 10</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Facebook</h3>

            <div class="emailRow__message">
              <h4>
              Update to your Facebook mobile number
                <span class="emailRow__description"> - We wanted to let you know that your mobile numbe </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 9</p>
          </div>
          <!-- Email Row Ends -->
          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">NPTEL</h3>

            <div class="emailRow__message">
              <h4>
              NPTEL Newsletter: IIT Madras CODE Certificate Program on Responsible AI – Tour starting on 1st May 2024 --- Register today to avail discount<span class="emailRow__description">
                  - on Your Channel Future Coders
                </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 9</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Your Indeed job feed</h3>

            <div class="emailRow__message">
              <h4>
              New jobs from your 11 April 2024 feed<span class="emailRow__description">
                  - see opportunities at BNY Mellon, yourDost
                </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 8</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Google Maps Timeline</h3>

            <div class="emailRow__message">
              <h4>
              <?php echo $Name;?>, your March update
                <span class="emailRow__description"> - <?php echo $Name;?>, here's your new Timeline update </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 7</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Rapido Bike Taxi</h3>

            <div class="emailRow__message">
              <h4>
              Winning by playing fantasy sports ❌ Winning by taking rides ✅
                <span class="emailRow__description"> - on Your Channel Future Coders </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 7</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Amazon.in</h3>

            <div class="emailRow__message">
              <h4>
              Delivered: Your Amazon package has been delivered.<span class="emailRow__description">
                  - Your package will be delivered between 7:00AM and 10:00PM
                </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 7</p>
          </div>
          <!-- Email Row Ends -->

          <!-- Email Row Starts -->
          <div class="emailRow">
            <div class="emailRow__options">
              <input type="checkbox" name="" id="" />
              <span class="material-icons"> star_border </span>
              <span class="material-icons"> label_important </span>
            </div>

            <h3 class="emailRow__title">Google</h3>

            <div class="emailRow__message">
              <h4>
                Login on New Device<span class="emailRow__description">
                  - is this your Device ?
                </span>
              </h4>
            </div>

            <p class="emailRow__time">Apr 6</p>
          </div>
          <!-- Email Row Ends -->

          
        </div>
        <!-- Email List rows Ends -->
      </div>
      <!-- Email List Ends -->
    </div>
    <!-- Main Body Ends -->
  </body>
</html>