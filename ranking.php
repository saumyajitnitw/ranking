<?php
$username="";
$usernameErr="";
$aContext = array(
    'http' => array(
        'proxy' => 'tcp://172.30.0.15:3128',
        'request_fulluri' => true,
        'header' => "Proxy-Authorization: Basic auth",
    ),
);
$cxContext = stream_context_create($aContext);
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(!isset($_POST["username"]))
		$usernameErr="Please enter some characters";
	else
	{
		$username=strval($_POST["username"]);
		$urlForRating="http://codeforces.com/api/user.rating?handle=".$username;
    	$jsondataRating=@file_get_contents($urlForRating,false,$cxContext);
		$objRating= json_decode($jsondataRating,true);
		if($objRating['status']==="OK")
		{
			$rating=intval($objRating['result'][count($objRating)-1]['newRating']);
			echo "Rating of ".$username." = ".$rating."<br>";
			//echo"Refreshing in 5 seconds";
			echo'
			<form name="redirect"> 
			<center> 
			<font face="Arial"><b>You will be redirected in<br><br> 
			<form> 
			<input type="text" size="3" name="redirect2"> 
			</form> 
			seconds</b></font> 
			</center>
			<script> 
			<!-- 
				//change below target URL to your own 
				var targetURL="http://localhost/ranking.php" 
				//change the second to start counting down from 
				var countdownfrom=5
				var currentsecond=document.redirect.redirect2.value=countdownfrom+1 
				function countredirect()
				{ 
					if (currentsecond!=1)
					{ 
						currentsecond-=1 
						document.redirect.redirect2.value=currentsecond 
					} 
					else
					{ 
						window.location=targetURL 
						return 
					} 
					setTimeout("countredirect()",1000) 
				}
				countredirect() 
			//--> 
			</script>';
			//header("refresh:4;url=http://localhost/redirect.html" );			
		}
		else
		{
			echo"<b>Username is invalid</b>".'<br>'.'<br>';
			echo"Refreshing in 2 seconds";
			header("refresh:2;url=http://localhost/redirect.html" );
		}
	}
}
?>

<style>
	h2
	{
		text-align:center;
	}
	p.align
	{
		text-align:center;
		font-weight:bold;
		font-size:30; 
	}
	p.imagepos
	{
    	position: fixed;
    	top: 10px;
    	left: 350px;
    	z-index:-1;
    }
    p.formpos
    {
    	position:relative;
    	left: +100px;
    }
}
</style>


<p class="align">Get Codeforces Rating</p>
<style>
.error {color: #FF0000;}
</style>
<p class="imagepos trans"><img src="http://codeforces.com/static/images/codeforces-logo-with-telegram.png" alt="Mountain View" style="width:160px;height:100px"></p>
<form method="post" action="ranking.php" class="navbar-form navbar-left" role="search"> 
    <div class="form-group">
    <p class="formpos"><p class="align"><input type="text" onkeypress="<?php echo"hello"?>" class="form-control" name='username' placeholder="Username" <?php echo $username?>></p></p>
  	</div>
    <p class="align"><input type="submit" name="submit" value="Get latest Rating"></p>
</form>

	