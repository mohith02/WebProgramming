<?php   
   session_start();
   
   $prev_value=0;
   $_SESSION['dice']= '0' ;
   function throw_dice()
   { $dice=rand(1, 6);
   $_SESSION['dice']= $dice ;
   return $dice;
   
   }

   $player_turn=isset($_POST["player_turn"])?$_POST["player_turn"]:1;
   
       $is_initial_load = true;
   	  if ( isset( $_POST[ "user_guess" ] ) ) {
   
   	   if ($player_turn==1){
   		   $player_turn=2;
   
   	$players  = [
               [ "name" => $_POST[ "player_1_name" ], "score" => throw_dice()+$_SESSION['players'][ 0 ][ "score" ],"image" => $_SESSION['players'][ 0 ][ "image" ]],
               [ "name" => $_POST[ "player_2_name" ], "score" => $_SESSION['players'][ 1 ][ "score" ], "image" =>  $_SESSION['players'][ 1 ][ "image" ]]
           ];
    if( $players[ 0 ][ "score" ]>100)
    {$players  = [
               [ "name" => $_POST[ "player_1_name" ], "score" => +$_SESSION['players'][ 0 ][ "score" ], "image" => $_SESSION['players'][ 0 ][ "image" ]],
               [ "name" => $_POST[ "player_2_name" ], "score" => $_SESSION['players'][ 1 ][ "score" ],  "image" =>  $_SESSION['players'][ 1 ][ "image" ]]
			   
           ];
    }
	  
     
   
   $_SESSION['players']= $players ;
   
   
   	   }
   	   else{
   		   $player_turn=1;
   
   		   $players  = [
               [ "name" => $_POST[ "player_1_name" ], "score" => $_SESSION['players'][ 0 ][ "score" ] , "image" =>  $_SESSION['players'][ 0 ][ "image" ]],
               [ "name" => $_POST[ "player_2_name" ], "score" => throw_dice()+$_SESSION['players'][ 1 ][ "score" ],"image" =>  $_SESSION['players'][ 1 ][ "image" ]]
           ];
   		if( $players[ 1 ][ "score" ]>100)
    {$players  = [
               [ "name" => $_POST[ "player_1_name" ], "score" => +$_SESSION['players'][ 0 ][ "score" ],"image" =>  $_SESSION['players'][ 0 ][ "image" ]],
               [ "name" => $_POST[ "player_2_name" ], "score" => $_SESSION['players'][ 1 ][ "score" ], "image" => $_SESSION['players'][ 1 ][ "image" ]]
           ];
    }
   		$_SESSION['players']= $players ;
   	   }
   
   
           $is_initial_load = false;
       }
   
   	else  if ( isset( $players ) )
   	{
   
   		$players[ $player_turn - 1 ][ "score" ] += $players[ $player_turn - 1 ][ "score" ];
   
   	}
   		else
        if ( isset( $_GET[ "start" ] ) ) {
			
			
           $players           = [
               [ "name" => $_GET[ "player_1_name" ], "score" => 0 ,"image" => $_GET[ "test" ]],
               [ "name" => $_GET[ "player_2_name" ], "score" => 0 ,"image" => $_GET[ "test1" ]]
           ];
          
          //print_r( $_SESSION['players']);  
		$is_initial_load   = false;
   		$_SESSION['players']= $players ;		  
       }
	   
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Roll Your Dice With Us</title>
      <link href='project2.css' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a class = "active"href="game.php">Game</a></li>
        <li><a  href="about.php">About</a></li>
         <li><a href="contact.html">Contact</a></li>
         <li><a href="summary.html">Summary</a></li>
      </ul>
      <?php if ( ! $is_initial_load ) : ?>
      <form id="main" action="game.php" method="post">
         <div id="conatiner">
            <div id="game">
               <?php
                  $rows = 10;
                  $cols = 10;
                  $count=100;
                  echo "<table border='1' align='center'>";
                  
                  for($tr=1;$tr<=$rows;$tr++){
                  
                  echo "<tr >";
                  for($td=1;$td<=$cols;$td++){
                  
                  
                  if($count%7==0)
                  {
                  echo "<td  id='danger'>".$count."</td>";
                  if($count==$_SESSION['players'][ 0 ][ "score" ])
                  {
                  
                  $players  = [
                  [ "name" => $_POST[ "player_1_name" ], "score" => $_SESSION['players'][ 0 ][ "score" ]-5,"image" => $_SESSION['players'][ 0 ][ "image" ]],
                  [ "name" => $_POST[ "player_2_name" ], "score" => $_SESSION['players'][ 1 ][ "score" ], "image" => $_SESSION['players'][ 1 ][ "image" ]]
                  ];
                  $_SESSION['players']= $players ;
                  $_SESSION['dice']= $_SESSION['dice'].". Danger!! ".$players[ 0][ "name" ]."'s score was reduced by 5 positions ";
                  }
                  if($count==$_SESSION['players'][ 1 ][ "score" ])
                  {
                  $players  = [
                  [ "name" => $_POST[ "player_1_name" ], "score" => $_SESSION['players'][ 0 ][ "score" ],"image" => $_SESSION['players'][ 0 ][ "image" ]],
                  [ "name" => $_POST[ "player_2_name" ], "score" => $_SESSION['players'][ 1 ][ "score" ]-5,"image" => $_SESSION['players'][ 1 ][ "image" ]]
                  ];
                  $_SESSION['players']= $players ;
                  $_SESSION['dice']=$_SESSION['dice'].". Danger!! ".$players[1][ "name" ]."'s score was reduced by 5 positions";
                  }
                  }
                  else
                  {
                  
                  if($count==$_SESSION['players'][ 0 ][ "score" ] && $count==$_SESSION['players'][ 1 ][ "score" ] )
                  
                  echo "<td width='80px' height='40px' align='center' bgcolor='yellow'>".$_SESSION['players'][ 0 ][ "name" ]."\n".$_SESSION['players'][ 1 ][ "name" ] ."</td>";
                  else  if($count==$_SESSION['players'][ 0 ][ "score" ])
                  {
                  if($count==100)
                  { $_SESSION['dice']=$_SESSION['dice'].", ".$_SESSION['players'][ 0 ][ "name" ]."  Wins!";}
                  echo "<td width='80px' height='40px' align='center'  bgcolor='green'><img src= '".$_SESSION['players'][ 0 ][ "image" ].".png' width='80px' height='55px' /></td>";
                  }
                  else if($count==$_SESSION['players'][ 1 ][ "score" ])
                  {
                  
                  if($count==100)
                  { $_SESSION['dice']=$_SESSION['dice'].", ".$_SESSION['players'][ 1 ][ "name" ]."  Wins!";}
                  
                  
                  echo "<td width='80px' height='40px' align='center' bgcolor='cyan'><img src= '".$_SESSION['players'][ 1 ][ "image" ].".png' width='80px' height='55px' /></td>";
                  }else
                  {
                  if($count%2 ==0 && $tr%2 ==0)
                  {
                  echo "<td width='80px' height='40px' align='center' id='even'>".$count."</td>";
                  }
                  else if($count%2 ==0 && $tr%2 ==1){
                  echo "<td width='80px' height='40px' align='center' id='odd'>".$count."</td>";
                  }
                  else if($count%2 ==1 && $tr%2 ==0)
                  {
                  echo "<td width='80px' height='40px' align='center' id='odd'>".$count."</td>";
                  }
                  else if($count%2 ==1 && $tr%2 ==1)
                  {
                  echo "<td width='80px' height='40px' align='center' id='even'>".$count."</td>";
                  }
                  
                  }
                  }
                  $count--;
                  
                  }
                  echo "</tr>";
                  }
                  
                  
                  
                  echo "</table>";
                  ?>
            </div>
         </div>
         <?php
            if ( isset( $players ) ) {
                echo "<input hidden name=\"player_1_name\" type=\"text\" value=\"" . $players[ 0 ][ "name" ] . "\">";
                echo "<input hidden name=\"player_2_name\" type=\"text\" value=\"" . $players[ 1 ][ "name" ] . "\">";
                echo "<input hidden name=\"player_1_score\" type=\"text\" value=\"" . $players[ 0 ][ "score" ] . "\">";
                echo "<input hidden name=\"player_2_score\" type=\"text\" value=\"" . $players[ 1 ][ "score" ] . "\">";
            }
            
            echo "<input hidden name=\"player_turn\" type=\"text\" value=\"$player_turn\">";
            ?>
         <div id="player_1_gui">
         <div id="player_1_gui">
         <section class="skewed">
            <span>Scoreboard</span>
         </section>
         <div id="player1">
            <?php
               $player_being_configured = 1;
               include "player_gui.php" ?>
         </div>
         <div>
            <h1 id="show"><?php if ( isset( $_SESSION['dice'] ) )
               echo "You got a ".$_SESSION['dice'];
               ?></h1>
         </div>
         <div id="player_2_gui">
            <div id="player2">
               <?php
                  $player_being_configured = 2;
                  include "player_gui.php" ?>
            </div>
      </form>
      <?php else: ?>
      <div>
      <form  action="game.php" method="get" class="gameform">
      <div class="header">
      <p>Roll Your Dice With Us</p>
      </div>
      <br>
      <table class="gametable">
	  <tr>
	  <td colspan=2 class="gamecells">Player1 details</td>
	  <td style="border-right:none;border:none"></td>
	  <td colspan=2 style="border-right:none;border:none">Player2 details</td>	  
	  </tr>
      <tr>
      <td class="gamedetails">Name:</td>
      <td class="gameinputs"><div id="names"><input type="text" class="button" id="name" required name="player_1_name" placeholder="Player 1 Name"/></div></td>
	  <td style="border-right:none;border:none"></td>
	  <td class="gamedetails">Name:</td>
      <td class="gameinputs"><div id="names"><input type="text" class="button" id="name" required name="player_2_name" placeholder="Player 2 Name" /></div></td>
      </tr> 
	 
      <tr>
      <td class="gamedetails">Choose avatar:</td>
      <td class="gameavatars">
	  <div id="group1">
	  <label>
      <input type="radio" name="test" value="avatar1" checked>
      <img src="avatar1.png" alt="Option 3" class="avatar" name = "image">
      </label>
	  <label>
      <input type="radio" name="test" value="avatar2">
      <img src="avatar2.png" alt="Option 3" class="avatar">
      </label>
	  <label>
      <input type="radio" name="test" value="avatar3">
      <img src="avatar3.png" alt="Option 3" class="avatar">
      </label>
	  <label>
      <input type="radio" name="test" value="avatar4">
      <img src="avatar4.png" alt="Option 3" class="avatar">
      </label>
	  </div>
      </td>
	  <td style="border-right:none;border:none"></td>
	  <td class="gamedetails">Choose avatar:</td>
	  <td class="gameavatars">
	  <div id="group2">
	  <label>
      <input type="radio" name="test1" value="avatar1" checked>
      <img src="avatar1.png" alt="Option 3" class="avatar">
      </label>
	  <label>
      <input type="radio" name="test1" value="avatar2">
      <img src="avatar2.png" alt="Option 3" class="avatar">
      </label>
	  <label>
      <input type="radio" name="test1" value="avatar3">
      <img src="avatar3.png" alt="Option 3" class="avatar">
      </label>
	  <label>
      <input type="radio" name="test1" value="avatar4">
      <img src="avatar4.png" alt="Option 3" class="avatar">
      </label>
	  </div>
	  </td>
	  </tr>
	  </table>
      <input type="submit" id = "submit" class = "button" value="Start" name="start">
      </form>
      </div>
      <?php endif; ?>
   </body>
</html>