var myurl = "/krushi/";


var opt = {

	autoOpen: false,

	dialogClass: "dlg-no-title"

};

function loginuser()

{

$.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif' 
	});

	var username= document.getElementById('username').value;

	var password= document.getElementById('password').value;

	var check= document.getElementById('remember').checked;

	var v = grecaptcha.getResponse();

	if(v.length == 0)

	{

		setTimeout(function(){

			//document.getElementById('loginbttn').disabled=false;

			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

			$('#msg').show();

			$('#msg').delay(2000).hide(500);
			$.preloader.stop();
			

		}, 3000);

		return false;

	}

	var captcha= document.getElementById('g-recaptcha-response').value;

	//document.getElementById('loginbttn').disabled=true;	

	if(username!="" && password!="")

	//if(username!="" && password!="" && captcha!="")

{

	$('#msg').hide();

	$.post(myurl+"fetch/login.php", 

			//{"username":username,"password":password,"check":check},

			{"username":username,"password":password,"captcha":captcha,"check":check},

			function(data) 

			{

				//console.log(data);

				if(data=="captcha")

				{

					document.getElementById('loginbttn').disabled=false;

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

					$('#msg').show();

					$('#msg').delay(2000).hide(500); 

					location.reload(); 

				}

				else

					if(data=="inactive")

					{

						setTimeout(function(){

						//document.getElementById('loginbttn').disabled=false;

						$("#msg").html('<div class="alert alert-warning" role="alert"><b>Sorry your account is deactivated. Please contact your supervisors</b></div>');

						$('#msg').show();

						$('#msg').delay(2000).hide(1000); 

							$.preloader.stop();

					}, 3000);

					}

					else

						if(data=="notfound")

						{

							setTimeout(function(){

						//document.getElementById('loginbttn').disabled=false;

						$("#msg").html('<div class="alert alert-warning" role="alert"><b>Sorry Details you have provided not found</b></div>');

						$('#msg').show();

						$('#msg').delay(2000).hide(1000);

							$.preloader.stop();

					}, 3000);

						}

						else

						{

							var myarr = data.split("*");

							if(myarr[0]=="login")

							{

								setTimeout(function(){

									$("#msg").html('<div class="alert alert-success" role="alert"><b>Logging you into System.... </b></div>');

									$('#msg').show();

									//var redirecting = sessionStorage.getItem('redirect');

									// if(redirecting == 'track-order')

									// {

									// 	sessionStorage.removeItem('redirect');

										window.location.href = myurl+"listing.php";

									// }

									// else

									// {

									// 	window.location.href = myurl+"listing.php";

									// }

								});

							}

						}

					});

}

else

	if(username=="" || password=="")

	{	

		setTimeout(function(){

				//document.getElementById('loginbttn').disabled=false;

				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please enter your login details</b></div>');

				$('#msg').show();

				$('#msg').delay(2000).hide(1000);

			   $.preloader.stop();

			}, 3000);

	}

	else

	{

		setTimeout(function(){

			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

			$('#msg').show();

			$('#msg').delay(2000).hide(1000); 

			$.preloader.stop();

		}, 3000);			

	}

}

function forgot()

{

	

	setTimeout(function(){

		window.location.href = myurl+"forgot-password/";

	});

		//document.getElementById('loginbttn').disabled=true;

	}

	

	// function register()

	// {

		

	// 	setTimeout(function(){

	// 		window.location.href = myurl+"index.php/register/";

	// 	});

	// }

	function gotologin()

	{

	$.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif' 
	});

		setTimeout(function(){

			window.location.href = myurl+"index.php/login/";
			$.preloader.stop();

		}, 3000);		

	}

	function submitforgot()

	{

		$.preloader.start({

			modal: true,

			src : myurl+'images/loading2.gif'

		});

		var username= document.getElementById('username').value;

		var captcha= document.getElementById('g-recaptcha-response').value;

		if(username!="" && captcha!="")

		{

			$('#msg').hide();

			$("#msg").html('<div class="alert alert-warning" role="alert"><i class="fas fa-spinner fa-spin"></i><b>Request in process Please Wait.... </b></div>');

			$('#msg').show();

			$.post(myurl+"fetch/fogot.php", {"username":username,"captcha":captcha},

				function(data) 

				{

					if(data=="captcha")

					{

						setTimeout(function(){

							$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

							$('#msg').show();

							$('#msg').delay(2000).hide(1000); 

							location.reload(); 

						}, 3000);				

					}

					else

						if(data=="inactive")

						{

							setTimeout(function(){

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Sorry your account is Inactive</b></div>');

								$('#msg').show();

								$('#msg').delay(2000).hide(1000); 

								$.preloader.stop();

							}, 3000);				

						}

						else

							if(data=="notfound")

							{

								setTimeout(function(){

									$("#msg").html('<div class="alert alert-warning" role="alert"><b>Sorry Details you have provided not found</b></div>');

									$('#msg').show();

									$('#msg').delay(2000).hide(1000); 

									$.preloader.stop();

								}, 3000);				

							}

							else

								if(data=="emailserver")

								{

									setTimeout(function(){

										$("#msg").html('<div class="alert alert-warning" role="alert"><b>Somthing went wrong please try after some time.... </b></div>');

										$('#msg').show();

										$.preloader.stop();

									}, 3000);

								}

								else

									if(data=="sent")

									{

										setTimeout(function(){

											$("#msg").html('<div class="alert alert-success" role="alert"><b>Your login details sent on your registered email id.');

											$('#msg').show();

											$.preloader.stop();

										}, 3000);				

									}

								});

		}

		else

			if(username=="")

			{

				setTimeout(function(){

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please enter your Email ID or Username details</b></div>');

					$('#msg').show();

					$('#msg').delay(2000).hide(1000);

					$.preloader.stop();

				}, 3000);

			}

			else

			{	

				setTimeout(function(){

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

					$('#msg').show();

					$('#msg').delay(2000).hide(1000); 

					$.preloader.stop();

				}, 3000);				

			}

		}

		function register()

		{

			 $.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif'
	     });

			setTimeout(function(){

				window.location.href = myurl+"index.php/WorkholderRegister/";

			}, 3000);

		}

		function vender()

		{

			 $.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif'
	});

			setTimeout(function(){

				window.location.href = myurl+"index.php/venderregister/";

			}, 3000);

		}

		function venderregister()

		{
			
     $.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif'
	});
			var fruite = [];

		var name= document.getElementById('name').value;
        var tel= document.getElementById('tel').value;
		var company= document.getElementById('company').value;
        var cntry= document.getElementById('cntry').value;
        var city= document.getElementById('city').value;
		var address= document.getElementById('address').value;
		
		var email= document.getElementById('email').value;
		var captcha= document.getElementById('g-recaptcha-response').value;

		$.each($("input[name='fruites']:checked"), function()
	    {
		   fruite.push($(this).val());
		   
	   });

	  var ids = fruite.join(", ");
	if(captcha!="" && name!="" && company!="" && tel!="" && city!="" && address!="" && email!="" )

				{



					var mobres = mobile(tel);

					var mailres = validEmail(email);

					if(mobres==false)

					{

						setTimeout(function(){

							$("#msg").html('<div class="alert alert-warning" role="alert"><b>Pleas Enter Correct Telephone/Cell Number</b></div>');

							$('#msg').show();

							$('#msg').delay(2000).hide(1000); 

							 $.preloader.stop();

						}, 1000);

					}

					else

						if(mailres==false)

						{

							setTimeout(function(){

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Pleas Enter Correct Email ID</b></div>');

								$('#msg').show();

								$('#msg').delay(2000).hide(1000); 

								 $.preloader.stop();

							}, 3000);	

						}

						else

						{

							$('#msg').hide();

							$("#msg").html('<div class="alert alert-warning" role="alert"><i class="fas fa-spinner fa-spin"></i><b>Request in process Please Wait.... </b></div>');

							$('#msg').show();

							$.post(myurl+"fetch/venderregister.php", {"name":name,"tel":tel,"company":company,"cntry":cntry,"city":city,"address":address,"email":email,"fruites" : ids,"captcha":captcha},

								function(data) 

								{

									console.log(data);

									if(data=="captcha")

									{

										setTimeout(function(){

											$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

											$('#msg').show();

											$('#msg').delay(2000).hide(1000); 

											location.reload(); 

										}, 3000);				

									}

									else

										if(data=="exist")

										{

											setTimeout(function(){

												$("#msg").html('<div class="alert alert-warning" role="alert"><b>You are already registered with Us<br/>Forgor Password <a href="javascript:void(0)" onclick="forgot();">Click Here</a></b></div>');

												$('#msg').show();



												 $.preloader.stop();

											}, 1000);				

										}

										else

											if(data=="emailserver")

											{

												setTimeout(function(){

													$("#msg").html('<div class="alert alert-warning" role="alert"><b>Somthing went wrong please try after some time.... </b></div>');

													$('#msg').show();

													$.preloader.stop();

												}, 1000);



											}

											else

												if(data=="sent")

												{

													setTimeout(function(){

														$("#msg").html('<div class="alert alert-success" role="alert"><b>Your registration request sent.</br></b></div>');

														$('#msg').show();

														$.preloader.stop();

													}, 3000);	



													setTimeout(function(){

														window.location.href = myurl+"index.php/success-profile/";

													}, 5000);	

												}

											});



						}



					}

					else

						if(name=="")

						{

							setTimeout(function(){

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Name</b></div>');

								$('#msg').show();

								$('#msg').delay(2000).hide(1000); 

								$.preloader.stop();

							}, 1000);		

						}

						else

							if(company=="")

							{

								setTimeout(function(){

									$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Company Name</b></div>');

									$('#msg').show();

									$('#msg').delay(2000).hide(1000); 

									$.preloader.stop();

								}, 1000);		

							}

							else

								if(tel=="")

								{

									setTimeout(function(){

										$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Telephone/Cell</b></div>');

										$('#msg').show();

										$('#msg').delay(2000).hide(1000); 

										$.preloader.stop();

									}, 1000);		

								}

									else

										if(city=="")

										{

											setTimeout(function(){

												$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter City</b></div>');

												$('#msg').show();

												$('#msg').delay(2000).hide(1000); 

												$.preloader.stop();

											}, 1000);		

										}

										else

	if(cntry=="")

	{

		setTimeout(function(){

			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Country Name</b></div>');

			$('#msg').show();

			$('#msg').delay(2000).hide(1000); 

			$.preloader.stop();

		}, 1000);		

	}	

	else

		if(address=="")

		{

			setTimeout(function(){

				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Address</b></div>');

				$('#msg').show();

				$('#msg').delay(2000).hide(1000); 

				$.preloader.stop();

			}, 1000);		

		}

		else

			if(email=="")

			{

				setTimeout(function(){

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Email ID</b></div>');

					$('#msg').show();

					$('#msg').delay(2000).hide(1000); 

					$.preloader.stop();

				}, 1000);		

			}

			else

			if(fruite=="")

			{

				setTimeout(function(){

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Select Fruits In which you are dealing</b></div>');

					$('#msg').show();

					$('#msg').delay(2000).hide(1000); 

					$.preloader.stop();

				}, 1000);		

			}

			// else

			// 	if(pwd=="")

			// 	{

			// 		setTimeout(function(){

			// 			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Password</b></div>');

			// 			$('#msg').show();

			// 			$('#msg').delay(2000).hide(1000); 

			// 			$.preloader.stop();

			// 		}, 1000);		

			// 	}

			// 	else

			// 		if(pwd2=="")

			// 		{

			// 			setTimeout(function(){

			// 				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Confirm Password</b></div>');

			// 				$('#msg').show();

			// 				$('#msg').delay(2000).hide(1000); 

			// 				$.preloader.stop();

			// 			}, 1000);		

			// 		}

					else

						if(captcha=="")

						{

							setTimeout(function(){

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

								$('#msg').show();

								$('#msg').delay(2000).hide(1000); 

								$.preloader.stop();

							}, 1000);		

						}

					}



					mobile = function(value)

					{

						var numericExpression = /^[0-9]+$/;

						if(value!="")

						{

							if (!(value.match(numericExpression)))

							{

								return false;

							}

							else if(value.length < 7) 

							{

								return false;

							}

							else if(value.length > 12) 

							{

								return false;

							}

							else 

							{

								return true;

							}	

						}

						else

						{

							return false;

						}

					} 



					validEmail = function(val) {

						if(val == "") 

						{

							return false;

						}



						if(val != "") 

						{ 	

							var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

							if(!(val.match(emailExp)))

							{

								return false;

							}

							else

							{

								return true;   

							}

						}

					}




		function getregistered()

		{
			console.log(sakshi);
			 // $.preloader.start({
		  //    modal: true,
		  //    src : myurl+'images/sprites.gif'
	   //      });

			var firstname= document.getElementById('firstname').value;

			var lastname= document.getElementById('lastname').value;

			var tel= document.getElementById('tel').value;

			

			var cntry= document.getElementById('cntry').value;

			var city= document.getElementById('city').value;

			

			var address= document.getElementById('address').value;



			// if(male==true)

			// {

			// 	var gender = "male";

			// }

			// else

			// 	if(female==true)

			// 	{

			// 		var gender = "female";

			// 	}



			// 	if(newslt==true)

			// 	{

			// 		var subscribe = "1";

			// 	}

			// 	else

			// 	{

			// 		var subscribe = "0";

			// 	}



				var email= document.getElementById('email').value;

				var pwd= document.getElementById('pwd').value;

				var pwd2= document.getElementById('pwd2').value;



				var captcha= document.getElementById('g-recaptcha-response').value;

				if(captcha!="" && firstname!="" && lastname!="" && tel!="" && city!="" && address!="" && email!="" && pwd!="" && pwd2!="" )

				{



					var mobres = mobile(tel);

					var mailres = validEmail(email);

					if(mobres==false)

					{

						setTimeout(function(){

							$("#msg").html('<div class="alert alert-warning" role="alert"><b>Pleas Enter Correct Telephone/Cell Number</b></div>');

							$('#msg').show();

							$('#msg').delay(2000).hide(1000); 

							 $.preloader.stop();

						}, 1000);

					}

					else

						if(mailres==false)

						{

							setTimeout(function(){

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Pleas Enter Correct Email ID</b></div>');

								$('#msg').show();

								$('#msg').delay(2000).hide(1000); 

								 $.preloader.stop();

							}, 3000);	

						}

						if(pwd!=pwd2)

						{

							setTimeout(function(){

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Password and Confirm Password not Matched</b></div>');

								$('#msg').show();

								$('#msg').delay(2000).hide(1000); 

								 preloader.stop();

							}, 1000);

						}

						else

						{

							$('#msg').hide();

							$("#msg").html('<div class="alert alert-warning" role="alert"><i class="fas fa-spinner fa-spin"></i><b>Request in process Please Wait.... </b></div>');

							$('#msg').show();

							$.post(myurl+"fetch/register.php", {"firstname":firstname,"lastname":lastname,"tel":tel,"company":company,"cntry":cntry,"city":city,"address":address,"email":email,"pwd":pwd,"captcha":captcha},

								function(data) 

								{

									console.log(data);

									if(data=="captcha")

									{

										setTimeout(function(){

											$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

											$('#msg').show();

											$('#msg').delay(2000).hide(1000); 

											location.reload(); 

										}, 3000);				

									}

									else

										if(data=="exist")

										{

											setTimeout(function(){

												$("#msg").html('<div class="alert alert-warning" role="alert"><b>You are already registered with Us<br/>Forgor Password <a href="javascript:void(0)" onclick="forgot();">Click Here</a></b></div>');

												$('#msg').show();



												 $.preloader.stop();

											}, 1000);				

										}

										else

											if(data=="emailserver")

											{

												setTimeout(function(){

													$("#msg").html('<div class="alert alert-warning" role="alert"><b>Somthing went wrong please try after some time.... </b></div>');

													$('#msg').show();

													$.preloader.stop();

												}, 1000);



											}

											else

												if(data=="sent")

												{

													setTimeout(function(){

														$("#msg").html('<div class="alert alert-success" role="alert"><b>Your registration request sent Now You can Login</br></b></div>');

														$('#msg').show();

														$.preloader.stop();

													}, 3000);	



													setTimeout(function(){

														window.location.href = myurl+"login.php";

													}, 5000);	

												}

											});



						}



					}

					else

						if(firstname=="")

						{

							setTimeout(function(){

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter First Name</b></div>');

								$('#msg').show();

								$('#msg').delay(2000).hide(1000); 

								$.preloader.stop();

							}, 1000);		

						}

						else

							if(lastname=="")

							{

								setTimeout(function(){

									$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Last Name</b></div>');

									$('#msg').show();

									$('#msg').delay(2000).hide(1000); 

									$.preloader.stop();

								}, 1000);		

							}

							else

								if(tel=="")

								{

									setTimeout(function(){

										$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Telephone/Cell</b></div>');

										$('#msg').show();

										$('#msg').delay(2000).hide(1000); 

										$.preloader.stop();

									}, 1000);		

								}

								// else

								// 	if(dob=="")

								// 	{

								// 		setTimeout(function(){

								// 			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Date of Birth</b></div>');

								// 			$('#msg').show();

								// 			$('#msg').delay(2000).hide(1000); 

								// 			$.preloader.stop();

								// 		}, 1000);		

								// 	}

									else

										if(city=="")

										{

											setTimeout(function(){

												$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter City</b></div>');

												$('#msg').show();

												$('#msg').delay(2000).hide(1000); 

												$.preloader.stop();

											}, 1000);		

										}

										else

	if(cntry=="")

	{

		setTimeout(function(){

			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Country Name</b></div>');

			$('#msg').show();

			$('#msg').delay(2000).hide(1000); 

			$.preloader.stop();

		}, 1000);		

	}	

	else

		if(address=="")

		{

			setTimeout(function(){

				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Address</b></div>');

				$('#msg').show();

				$('#msg').delay(2000).hide(1000); 

				$.preloader.stop();

			}, 1000);		

		}

		else

			if(email=="")

			{

				setTimeout(function(){

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Email ID</b></div>');

					$('#msg').show();

					$('#msg').delay(2000).hide(1000); 

					$.preloader.stop();

				}, 1000);		

			}

			else

				if(pwd=="")

				{

					setTimeout(function(){

						$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Password</b></div>');

						$('#msg').show();

						$('#msg').delay(2000).hide(1000); 

						$.preloader.stop();

					}, 1000);		

				}

				else

					if(pwd2=="")

					{

						setTimeout(function(){

							$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Confirm Password</b></div>');

							$('#msg').show();

							$('#msg').delay(2000).hide(1000); 

							$.preloader.stop();

						}, 1000);		

					}

					else

						if(captcha=="")

						{

							setTimeout(function(){

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

								$('#msg').show();

								$('#msg').delay(2000).hide(1000); 

								$.preloader.stop();

							}, 1000);		

						}

					}



					mobile = function(value)

					{

						var numericExpression = /^[0-9]+$/;

						if(value!="")

						{

							if (!(value.match(numericExpression)))

							{

								return false;

							}

							else if(value.length < 7) 

							{

								return false;

							}

							else if(value.length > 12) 

							{

								return false;

							}

							else 

							{

								return true;

							}	

						}

						else

						{

							return false;

						}

					} 



					validEmail = function(val) {

						if(val == "") 

						{

							return false;

						}



						if(val != "") 

						{ 	

							var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

							if(!(val.match(emailExp)))

							{

								return false;

							}

							else

							{

								return true;   

							}

						}

					}



					



function updatemyprofile()

{
$.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif' 
	});



	var firstname= document.getElementById('fname').value;

	var lastname= document.getElementById('lname').value;

	var tel= document.getElementById('tel').value;


	var cntry= document.getElementById('cntry').value;

	var city= document.getElementById('city').value;

	var address= document.getElementById('add').value;

	var email= document.getElementById('email').value;
	var company= document.getElementById('company').value;

	//var newslt= document.getElementById('newslt').checked;



	// if(newslt==true)

	// {

	// 	var subscribe = "1";

	// }

	// else

	// {

	// 	var subscribe = "0";

	// }

	

	//if(firstname!="" && lastname!="" && tel!="" && city!="" && cntry!="" && address!="" && email!="" )

	if(firstname!="" && lastname!="" && tel!="" && city!="" && address!="" && email!="" && cntry!="" && company!="")

	{

		var mobres = mobile(tel);

		var mailres = validEmail(email);

		if(mobres==false)

		{

			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Pleas Enter Correct Telephone/Cell Number</b></div>');

			setTimeout(function(){

				$('#msg').show();

				$('#msg').delay(2000).hide(1000); 

				$.preloader.stop();

			}, 3000);	

		}

		else

			if(mailres==false)

			{

				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Pleas Enter Correct Email ID</b></div>');

				setTimeout(function(){

					$('#msg').show();

					$('#msg').delay(2000).hide(1000); 

					$.preloader.stop();

				}, 3000);	

			}

			else

			{	





				$('#msg').hide();

				$("#msg").html('<div class="alert alert-warning" role="alert"><i class="fas fa-spinner fa-spin"></i><b>Request in process Please Wait.... </b></div>');

				$('#msg').show();

				$.post(myurl+"fetch/update.php", {"firstname":firstname,"lastname":lastname,"tel":tel,"cntry":cntry,"city":city,"address":address,"email":email,"company":company},

					function(data) 

					{

						$("#msg").html('<div class="alert alert-success" role="alert"><b>Profile Updated succesfully</br></b></div>');

			//alert(data);

			if(data=="sent")

			{

				setTimeout(function(){

					$('#msg').show();

					$.preloader.stop();

					$('#msg').delay(3000).hide(1000); 

				}, 3000);	

			}

		});



			}



		}

		else

			if(firstname=="")

			{

				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter First Name</b></div>');

				setTimeout(function(){

					$('#msg').show();

					$('#msg').delay(2000).hide(1000); 

					$.preloader.stop();

				}, 1000);		

			}

			else

				if(lastname=="")

				{

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Last Name</b></div>');

					setTimeout(function(){

						$('#msg').show();

						$('#msg').delay(2000).hide(1000); 

						$.preloader.stop();

					}, 1000);		

				}

				else

					if(tel=="")

					{

						$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Telephone/Cell</b></div>');

						setTimeout(function(){

							$('#msg').show();

							$('#msg').delay(2000).hide(1000); 

							$.preloader.stop();

						}, 1000);		

					}

					// else

					// 	if(dob=="")

					// 	{

					// 		$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Date of Birth</b></div>');

					// 		setTimeout(function(){

					// 			$('#msg').show();

					// 			$('#msg').delay(2000).hide(1000); 

					// 			$.preloader.stop();

					// 		}, 1000);		

					// 	}
						else

							if(cntry=="")

							{

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Select Country</b></div>');

								setTimeout(function(){

									$('#msg').show();

									$('#msg').delay(2000).hide(1000); 

									$.preloader.stop();

								}, 1000);		

							}

						else

							if(city=="")

							{

								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Select City</b></div>');

								setTimeout(function(){

									$('#msg').show();

									$('#msg').delay(2000).hide(1000); 

									$.preloader.stop();

								}, 1000);		

							}

							else

	if(company=="")

	{

		$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter company Name</b></div>');

		setTimeout(function(){

			$('#msg').show();

			$('#msg').delay(2000).hide(1000); 

			$.preloader.stop();

		}, 1000);		

	}	

	else

		if(address=="")

		{

			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Address</b></div>');

			setTimeout(function(){

				$('#msg').show();

				$('#msg').delay(2000).hide(1000); 

				$.preloader.stop();

			}, 1000);		

		}

		else

			if(email=="")

			{

				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Email ID</b></div>');

				setTimeout(function(){

					$('#msg').show();

					$('#msg').delay(2000).hide(1000); 

					$.preloader.stop();

				}, 1000);		

			}

		}



		function changepass()

		{

			$.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif' 
	});


			var oldpass= document.getElementById('oldpass').value;

			var newpass= document.getElementById('newpass').value;

			var confpass= document.getElementById('confpass').value;



			if(oldpass!="" && newpass!="" && confpass!="")

			{

				if(newpass==confpass)

				{

					$.post(myurl+"fetch/change-pass.php", {"oldpass":oldpass,"newpass":newpass,"confpass":confpass},

						function(data) 

						{

							if(data=="old")

							{

								$("#msg2").html('<div class="alert alert-warning" role="alert"><b>Please Enter Correct Current Password</br></b></div>');



								setTimeout(function(){

									$('#msg2').show();

									$.preloader.stop();

									$('#msg2').delay(3000).hide(1000); 

								}, 3000);	

							}

							else

								if(data=="match")

								{

									$("#msg2").html('<div class="alert alert-warning" role="alert"><b>New Password and Confirm Password Dosent Match</br></b></div>');



									setTimeout(function(){

										$('#msg2').show();

										$.preloader.stop();

										$('#msg2').delay(3000).hide(1000); 

									}, 3000);	

								}

								else

								{

									$("#oldpass").val('');

									$("#newpass").val('');

									$("#confpass").val('');



									$("#msg2").html('<div class="alert alert-success" role="alert"><b>Password Changed succesfully</br></b></div>');

									$("#fanc").removeClass("fa-eye");

									$("#fanc").addClass("fa-eye-slash");



									setTimeout(function(){

										$('#msg2').show();

										$.preloader.stop();

										$('#msg2').delay(3000).hide(1000); 

									}, 3000);	

								}

							});

				}

				else

				{

					$("#msg2").html('<div class="alert alert-warning" role="alert"><b>New Password and Confirm Password Dosent Match</b></div>');

					setTimeout(function(){

						$('#msg2').show();

						$('#msg2').delay(2000).hide(1000); 

						$.preloader.stop();

					}, 1000);

				}

			}

			else

			{

				if(oldpass=="")

				{

					$("#msg2").html('<div class="alert alert-warning" role="alert"><b>Please Enter Your Current password</b></div>');

					setTimeout(function(){

						$('#msg2').show();

						$('#msg2').delay(2000).hide(1000); 

						$.preloader.stop();

					}, 1000);

				}

				else

					if(newpass=="")

					{

						$("#msg2").html('<div class="alert alert-warning" role="alert"><b>Please Enter New Password</b></div>');

						setTimeout(function(){

							$('#msg2').show();

							$('#msg2').delay(2000).hide(1000); 

							$.preloader.stop();

						}, 1000);

					}

					else

						if(confpass=="")

						{

							$("#msg2").html('<div class="alert alert-warning" role="alert"><b>Please Confirm your New Password</b></div>');

							setTimeout(function(){

								$('#msg2').show();

								$('#msg2').delay(2000).hide(1000); 

								$.preloader.stop();

							}, 1000);

						}

					}



				}



				function swithtext()

				{

					var tttype = $("#oldpass").attr('type');



					if(tttype=="password")

					{

						$('#oldpass').attr('type', 'text');

						$("#fanc").removeClass("fa-eye-slash");

						$("#fanc").addClass("fa-eye");



					}

					else

					{

						$('#oldpass').attr('type', 'password');

						$("#fanc").removeClass("fa-eye");

						$("#fanc").addClass("fa-eye-slash");

					}

				}





				function submitfeadback()

				{
	$.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif' 
	});


					var txtname = $('#txtname').val();

					var txtemail = $('#txtemail').val();

					var tel = $('#tel').val();

					var message = $('#message').val();

					var captcha = $('#g-recaptcha-response').val();

	//alert(txtname);



	//if(txtname!="" || txtemail!="" || tel!="" || message!="" || captcha!="")

	if(txtname!="" || txtemail!="" || tel!="" || message!="")

	{	

		$('#msg').hide();

		$.post(myurl+"fetch/submit.php", 

			{"txtname":txtname,"txtemail":txtemail,"tel":tel,"message":message,"captcha":captcha},

			function(data) 

			{

			//alert(data);

			if(data=="captcha")

			{

				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

				setTimeout(function(){

					$('#msg').show();

					$('#msg').delay(2000).hide(1000); 

					location.reload(); 

				}, 1000);

			}

			else

			{

				if(data=="blank")

				{

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Some of felads are blank</b></div>');

					setTimeout(function(){

						$('#msg').show();

						$('#msg').delay(2000).hide(1000); 

						$.preloader.stop();

					}, 1000);

				}

				else

					if(data=="maileror")

					{

						$("#msg").html('<div class="alert alert-warning" role="alert"><b>Sorry Unable to send your feedback. Please try after sometime</b></div>');

						setTimeout(function(){

							$('#msg').show();

							$('#msg').delay(2000).hide(1000); 

							$.preloader.stop();

						}, 1000);

					}

					else

						if(data=="sent")

						{

					//$("#msg").html('<div class="alert alert-warning" role="alert"><b>Sorry Unable to send your feedback. Please try after sometime</b></div>');

					setTimeout(function(){

						$('#msg').show();

						$('#msg').delay(2000).hide(1000); 

						window.location.href = myurl+"index.php/success/";

					}, 1000);

				}

			}

		});

	}

	else

		if(txtname=="")

		{

			$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please enter your Name</b></div>');

			setTimeout(function(){

				$('#msg').show();

				$('#msg').delay(2000).hide(1000);

				$.preloader.stop();

			}, 3000);

		}

		else

			if(txtemail=="")

			{

				$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please enter your Email ID</b></div>');

				setTimeout(function(){

					$('#msg').show();

					$('#msg').delay(2000).hide(1000);

					$.preloader.stop();

				}, 3000);

			}

			else

				if(tel=="")

				{

					$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please enter your Telephone/Cell Number</b></div>');

					setTimeout(function(){

						$('#msg').show();

						$('#msg').delay(2000).hide(1000);

						$.preloader.stop();

					}, 3000);

				}

				else

					if(message=="")

					{

						$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please enter your Comment/Message</b></div>');

						setTimeout(function(){

							$('#msg').show();

							$('#msg').delay(2000).hide(1000);

							$.preloader.stop();

						}, 3000);

					}

					else

					{

						$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Show you are Human</b></div>');

						setTimeout(function(){

							$('#msg').show();

							$('#msg').delay(2000).hide(1000); 

							$.preloader.stop();

						}, 3000);			

					}

				}

function pagelisting()
{
	 $.preloader.start({
		modal: true,
		src : myurl+'images/sprites.gif'
	});
	var sort;
	var contry = $('#contry').val(); 

	$.post(myurl+"fetch/page-lisintg.php", 
			{"sort":sort,"contry":contry},
		function(data) 
		{
			//alert(data);
			setTimeout(function(){
				$("#pagelistingview").html(data);
				$('#pagelistingview').show();
				$.preloader.stop();
			}, 1000);		
		});
}

// function pagelistingsort()
// {
// 	$.preloader.start({
// 		modal: true,
// 		src : myurl+'images/sprites.gif'
// 	});
	
//     var contry = $('#contry').val(); 

// 		$.post(myurl+"fetch/page-lisintg.php", 
// 			{"contry":contry},
// 		function(data) 
// 		{
// 			//alert(data);
// 			setTimeout(function(){
// 				$("#pagelistingview").html(data);
// 				//alert(data);
// 				$('#pagelistingview').show();
// 				$.preloader.stop();
// 			}, 1000);		
// 		});
// 	}

// function enquiry()
// {

 // $.preloader.start({
	// 	modal: true,
	// 	src : myurl+'images/sprites.gif'
	// });
// $('#msg').hide();
// var fruite = [];
// var qty = [];
// var shidate = [];
// var vender = $('#vender').val();
// var num = 0;
// var num1 = 0;
// var num2 = 0;
// 	$.each($("input[name='fruites']"), function()
// 	{
// 		fruite.push($(this).val());
// 		 num++;
// 	});

// 	var ids = fruite.join(", ");
//    //var qty = $('#qty').val(); 
//   // var qty= document.getElementById('qty').value;
//  $.each($("input[name='qty']"), function()
// 	{
// 		qty.push($(this).val());
// 		num1++;
// 	});
//   var id_qty = qty.join(", ");
 
// //console.log(qty.length);
// // let objectsLen = 0;
// // for (let i = 0; i < id_qty.length; i++) {

// //    // if entity is object, increase objectsLen by 1, which is the stores the total number of objects in array.
// //    if (id_qty[i] instanceof Object) {
// //       objectsLen++;
// //    }
// // }

 
//    $.each($("input[name='date']"), function()
// 	{
// 		shidate.push($(this).val());
// 		num2++;
// 	});
 
// id_date= shidate.join(", ");


// if(ids!="" && id_qty!="" && vender!="")

// 	{	

//    // $('#msg').hide();

//    //  $("#msg").html('<div class="alert alert-warning" role="alert"><i class="fas fa-spinner fa-spin"></i><b>Request For enquiry is in process Please Wait.... </b></div>');
//    //  $('#msg').show();
// 	$.post(myurl+"submit_enquiry.php", {"fruites" : ids,"qty" : id_qty,"shidate" : id_date,"vender" : vender},
// 		function(data) {
// 			//console.log(data)
// // 		if(data=="add")
// // 			{
			
// //             setTimeout(function(){
// //            $("#msg").html('<div class="alert alert-success" role="alert"><b>Your Enquire data is sended.</br></b></div>');
// //             $('#msg').show();
// //           //$.preloader.stop();
// //            });	
// //             setTimeout(function(){
// //            //window.location.href = myurl+"success.php";
// //           });	
      
// // }
// });
// }
// else

// 						if(qty=="")

// 						{

// 							setTimeout(function(){

// 								$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Quantity For All Fruits</b></div>');

// 								$('#msg').show();

// 								$('#msg').delay(2000).hide(1000); 

// 								$.preloader.stop();

// 							}, 1000);		

// 						}

// 						else

// 							if(id_date=="")

// 							{

// 								setTimeout(function(){

// 									$("#msg").html('<div class="alert alert-warning" role="alert"><b>Please Enter Requested Shipping dates for All Fruits</b></div>');

// 									$('#msg').show();

// 									$('#msg').delay(2000).hide(1000); 

// 									$.preloader.stop();

// 								}, 1000);		

// 							}

$("#addCity").submit(function(e) {
 e.preventDefault();
var myurl2 = myurl+"submit_enquiry.php";
 var form = $(this);
var url = myurl2;
	$.preloader.start({
 		modal: true,
	src : myurl+'images/sprites.gif'
 	});
 $.ajax({
type: "POST",
 url: url,
 dataType: "json",
 data: form.serialize(), // serializes the form's elements.
success: function(data)
 {
 	console.log(data);
 	if(data.success==true)
 	{
 	 // $("#msg").html('<div class="alert alert-success" role="alert"><b>Your Enquire data is sended.Please wait</br></b></div>');
   //   	setTimeout(function(){

			// 				$('#msg').show();

			// 				$('#msg').delay(2000).hide(1000);
			// 				document.location.href="success.php";
			// 				$.preloader.stop();

			// 			},3000);

     	setTimeout(function(){

									$("#msg").html('<div class="alert alert-success" role="alert"><b>Your Enquire data is sended.Please wait.... </b></div>');

									$('#msg').show();


										window.location.href = myurl+"success.php";
										$.preloader.stop();

							

								},3000);
 	}
 	else
 	{
 	$("#msg").html('<div class="alert alert-success" role="alert"><b>Please Enter Require Details for All fruits</br></b></div>');
     	setTimeout(function(){

							$('#msg').show();

							$('#msg').delay(2000).hide(1000);

							$.preloader.stop();

						},3000);
 	}
 	//if(data=="sucess")
   //    echo($json);//$("#msg").replaceWith("<div id='alert-new-role' class='alert alert-success col-xs-10 col-xs-offset-1'><strong>role created!</strong></div>");
 	 // //window.location.href = myurl+"success.php";
},
error: function(jqxhr,exception)
{
console.log(jqxhr);
}
 });
//setTimeout(function(){
 //document.location.href="success.php";
 //}, 1000);

});

function showentcat(val)

{

  //alert(val);

  $.post(myurl+"fetch/fetch-city.php", {"cntry" : val},

      function(data) {

        $("#subcontainercity").fadeOut('slow',function() {

            $("#subcontainercity").html(data);

        });

        $("#subcontainercity").fadeIn('slow');

      });

  

}

selecthdofc = function(hdofc) 

{

  document.getElementById('txthhdofc').value = hdofc;

}


	









