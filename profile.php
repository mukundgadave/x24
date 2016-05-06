<?php session_start(); 
include_once('postgredb.php');
if(isset($_SESSION) && empty($_SESSION['SESSION_USER_ID']))
{
	header('Location: index.php');  
}

$dbname = "d92o4qc54jr2cc";
$host = "ec2-54-83-36-176.compute-1.amazonaws.com";
$port = "5432";
$user = "xxslmxhhwabpmk";
$password = "S16JA1ihgZQAa-63NYMysn-UAR";
$persistent = 0;
$dbdrv=new PostgreDB ($dbname, $host, $port, $user, $password, $persistent);
/* construct connection to database $dbname, with URL: $host, username is $user, password is $pass. If $persistent!=0 then function pg_pconnect is used otherwise pg_connect. */
$dbdrv->Begin();// Begin transaction block 
$sql="SELECT * FROM loyaltymanagement.Contact WHERE id = '".$_SESSION['SESSION_USER_ID']."'";
if (!$dbdrv->ExecQuery($sql)) // Execute query or die if error is occured
    die ($dbdrv->Error());

$result = $dbdrv->FetchResult($row, PGSQL_BOTH);
$tierValue = '20%';
$tier = $result['tier__c'];
if($tier == 'Bronze')
	$tierValue = '40%';
if($tier == 'Silver')
	$tierValue = '60%';
if($tier == 'Gold')
	$tierValue = '80%';
if($tier == 'Platinum')
	$tierValue = '100%';


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Heroku: Loyalty History</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  </head>
  <body>
    
    
    <div class="container">
    <?php 
	$active_menu = 'profile';
	?>
		
	<div class="row">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!--a class="navbar-brand" href="#">Loyalty Management System</a-->
            <img class="navbar-brand img-responsive" style="padding: 5px 5px !important;" src="images/hires_logo.png" width="140px;"/>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
         		<li <?php if($active_menu == 'profile') {echo 'class="active"';} ?>><a href="profile.php">Profile</a></li>
				<li <?php if($active_menu == 'itinerary') {echo 'class="active"';} ?>><a href="itinerary.php">Miles</a></li>
				<!--li <?php if($active_menu == 'history') {echo 'class="active"';} ?>><a href="history.php">Flight History</a></li-->
				<li <?php if($active_menu == 'claim') {echo 'class="active"';} ?>><a href="claim.php">Claim</a></li>
				<?php if($active_menu == 'miles'){ ?>
				<li class="active"><a href="miles.php">Miles</a></li>
				<?php } ?>
				<?php if($active_menu == 'case'){ ?>
				<li class="active"><a href="case.php">Case</a></li>
				<?php } ?>
         
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome <?php if(isset($_SESSION) && !empty($_SESSION['SESSION_FIRST_NAME'])){ echo $_SESSION['SESSION_FIRST_NAME']; } else{echo $_SESSION['SESSION_NAME'];} ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Setting</a></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
	</div>
      <!-- Main component for a primary marketing message or call to action -->
     <div class="row jumbotron"> 
        

<div class="container">
    <h2>Profile</h2>
    <div class="row profile">
    	
		<div class="col-md-3">
			<div class="profile-sidebar">
				<center>
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="resource/profile.jpg" class="img-responsive img-circle" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					&nbsp;
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<img src="resource/<?php echo $tier.".png";?>" class="img-responsive" alt="Responsive image" />
				</div>
				</center>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<!--li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="glyphicon glyphicon-ok"></i>
							Tasks </a>
						</li-->
						<li>
							<a href="#" id="help">
							<i class="glyphicon glyphicon-flag"></i>
							Help </a>
						</li>
					</ul>
				</div>
				
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-6">
			
            <div class="profile-content">
            	<h3><?php echo $result['name'];?></h3>
			    <dl>
			    <dt>Frequent Flyer Number</dt><dd><?php echo $result['frequent_flyer_number__c'];?></dd>
				<dt>Tier</dt><dd><?php echo $result['tier__c'];?></dd>
				<dt>Total Miles Accrued</dt><dd><?php echo $result['total_miles_accrued__c'];?></dd>
				<dt>Pending Accruals</dt><dd><?php echo $result['pending_accruals__c'];?></dd>
				<dt>Total Miles Redeemed</dt><dd><?php echo $result['total_miles_redeemed__c'];?></dd>
				<dt>Miles Balance</dt><dd><?php echo $result['miles_balance__c'];?></dd>
				<dt>Email</dt><dd><?php echo $result['email'];?></dd>
				<dt>Mobile</dt><dd><?php echo $result['mobilephone'];?></dd>
				<dt>Address</dt><dd>
					<?php echo $result['mailingstreet'] .'<br/>'.$result['mailingcity'].', '.$result['mailingstate'].' '.$result['mailingpostalcode'].' '.$result['mailingcountry'];?>
				</dd>
				</dl>
				
				<br/><br/><br/><br/>
				
            </div>
		</div>
		<div class="col-md-3">
			<img src="images/add.jpg" class="img-responsive" alt="Responsive image" width="400px;" />
			<img src="images/add1.jpg" class="img-responsive" alt="Responsive image" width="400px;" />
			 </div>
		
	</div>
	<div class="row" id="help-content" style="display: none;">
		<div class="col-md-6">
				<img src="resource/Bronze.png" class="img-responsive" alt="Responsive image" />
			    <h4>Bronze features:</h4>
			    	<ul>
					  <li>Collecting Avios</li>
					  <li>Earning Tier Points</li>
					  <li>Sharing your Avios</li>
					  <li>Saving your preferences</li>
					  <li>Added reassurance</li>
					  <li>Member-only offers</li>
					  <li>Stay in control with our free mobile app</li>
					  <li>Next stop — Silver</li>
					</ul>
		</div>
		<div class="col-md-6">
	    	    <img src="resource/Silver.png" class="img-responsive" alt="Responsive image" />
					<h4>Silver features:</h4>
					<ul>
					  <li>More rewards, sooner</li>
					  <li>Business class check-in and priority boarding whenever you fly</li>
					  <li>Choose your seats in advance</li>
					  <li>Priority at Baggage Arrival Services desks</li>
					  <li>Sharing your Avios</li>
					  <li>Saving your preferences</li>
					  <li>Next stop, Gold</li>
					</ul>
			
		</div>
	</div>	
	
	
	<div class="row" id="help-content1" style="display: none;">
		<div class="col-md-6">
				<img src="resource/Gold.png" class="img-responsive" alt="Responsive image" />
			    <h4>Gold features:</h4>
			    	<ul>
					  <li>More rewards, sooner</li>
					  <li>Your lounges await</li>
					  <li>Make your time your own at the airport</li>
					  <li>A tailored service</li>
					  <li>Peace of mind with Reservation Assurance</li>
					  <li>Partner privileges</li>
					  <li>Sharing your Avios</li>
					  <li>Exclusive Gold benefits are waiting for you</li>
					</ul>
		</div>
		<div class="col-md-6">
	    	    <img src="resource/Platinum.png" class="img-responsive" alt="Responsive image" />
					<h4>Platinum features:</h4>
					<ul>
					<li>More rewards, sooner</li>
					  <li>Making it easier to spend your Avios</li>
					  <li>Our First lounges await you and a guest</li>
					  <li>Elemis Travel Spas</li>
					  <li>Putting you in control</li>
					  <li>A tailored service</li>
					  <li>Partner privileges</li>
					  <li>Sharing your Avios</li>
					  <li>An upgraded experience</li>
					  <li>Gold membership for life</li>  
					</ul>
			
		</div>
	</div>	

</div>

<br>
<br>

        	
      
        	
        
        
        
	</div>
    </div> <!-- /container -->
    

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script language="JavaScript1.2">
    	$(document).ready(function() {
		  	$("#help").click(function(){
		  		$("#help-content").toggle(1000);
		  		$("#help-content1").toggle(1000);
		  	});
		});
    	
    </script>
  </body>
</html>