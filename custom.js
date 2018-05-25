$(document).ready(function($){
 
	
	$("#fname").on("input",function(){
		var input=$(this);
		var is_name=input.val();
		
			if(is_name)
			{
				
				input.removeClass("invalid").addClass("valid");
			}
			else{
				
				input.addClass("invalid").removeClass("valid");
			}
	});

	$("#lname").on("input",function()
	{
		var input=$(this);
		var is_name=input.val();
		if(is_name)
		{
			input.removeClass("invalid").addClass("valid");
		}
		else
		{
			input.addClass("invalid").removeClass("valid");
		}

	});

	$("input[type=password]").keyup(function()
	{
		console.log('not-enter');
      var password=$(this);
      var is_password=password.val();
      if(is_password)
      {
      	if(is_password.length<8)
      	{
      		password.removeClass("valid").addClass("invalid");      	}
      	else
      	{
      		password.removeClass("invalid").addClass("valid");
      	}
      	
      }
      else
      {
      	password.addClass("invalid").removeClass("valid");
      }


	});
	$("#register").click(function()
	{
		var email=$("#email").val();
		if(emailvalidate(email))
		{
			$(this).removeClass("invalid").addClass("valid");
		}
		else
		{
			$(this).removeClass("valid").addClass("invalid");
		}


	});
});

function emailvalidate(email)
{
var filter=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
if(filter.test(email))
{
	return true;
}
	else
	{
		return false;
	}
}