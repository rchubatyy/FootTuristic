function formhash(form, password)
{
   // Create a new element input, this will be our hashed password field.
   var p = document.createElement("input");
   var res_nome=0;
   var res_morada=0;
   var res_username=0;
   var res_password=0;
   var res_pass_conf=0;
   var res_localidade=0;
   var res_nif=0;
   var res_telefone=0;
 
   // Add the new element to our form.
   form.appendChild(p);
   p.name = "p";
   p.type = "hidden";
   p.value = sha512(password.value);
   // Make sure the plaintext password doesn't get sent.
   password.value = "";
   // Finally submit the form.
   form.submit();
}

function voltarAtras()
{
	window.history.back()
}

function clear_mail(textbox)
{
	if(textbox.value == "mail@host.com")
		textbox.value = "";
}

function restore_mail(textbox)
{
	if(textbox.value == "")
		textbox.value = "mail@host.com";
}

function clear_password(textbox)
{
	if(textbox.value == "password")
	{
		textbox.type = "password";
		textbox.value = "";
	}
	//this.select();
}

function restore_password(textbox)
{
	if(textbox.value == "")
	{
		textbox.type = "text";
		textbox.value = "password";
	}
}

//__ REGIISTO__________________________________________________
function verificar_confirmacao_password(password, confirmacao, div)	//true = OK
{
	if(confirmacao.value.length == password.value.length)
	{
		if(confirmacao.value == password.value)
		{
		   div.hidden = true;
		   res_pass_conf=1;
		   verificar_registo();
		   return;
		}
		else
		{
			div.hidden = false;
			res_pass_conf=0;
			verificar_registo();
			return;
		}
	}
	else
	{
	   div.hidden = false;
	   res_pass_conf=0;
	   verificar_registo();
	   return;
	}

}

function limpar_form()
{
	document.getElementById("registo").reset();
	document.getElementById("submeter").disabled = true;
	res_nome=0;
    res_morada=0;
   res_username=0;
   res_password=0;
   res_pass_conf=0;
   res_localidade=0;
   res_nif=0;
   res_telefone=0;
	
}

function verificar_null(textbox, div)
{
	if(textbox.value == "")
		div.hidden = false;
	else
		div.hidden = true;
}

function verificar_morada(textbox, div)
{
	if(textbox.value == "")
		{div.hidden = false;
		res_morada=0;
		verificar_registo();
		return;}
	else
		{div.hidden = true;
		res_morada=1;
		verificar_registo();
		return;}
}

function verificar_username(textbox, div)
{
	if(textbox.value == "")
		{div.hidden = false;
		res_username=0;
		verificar_registo();
		return;}
	else
		{div.hidden = true;
		res_username=1;
		verificar_registo();
		return;}
}


function verificar_telefone(textbox, div)	  //true = OK
{
	if(textbox.value == "" || !(isNumber(textbox.value)) || textbox.value.length != 9)
	{
		div.hidden = false;
		res_telefone=0;
		verificar_registo();
		return;
	}
	else
	{
		div.hidden = true;
		res_telefone=1;
		verificar_registo();
		return;
	}
}

function verificar_nif(textbox, div)	  //true = OK
{
	if(textbox.value == "" || !(isNumber(textbox.value)) || textbox.value.length != 9)
	{
		div.hidden = false;
		res_nif=0;
		verificar_registo();
		return;
	}
	else
	{
		div.hidden = true;
		res_nif=1;
		verificar_registo();
		return;
	}
}


function verificar_password(textbox, div)	  //true = OK
{
	if(textbox.value == "" || textbox.value.length < 4)
	{
		div.hidden = false;
		res_password=0;
		verificar_registo();
		return;
	}
	else
	{
		div.hidden = true;
		res_password=1;
		verificar_registo();
		return;
	}
}

function verificar_nome(textbox, div)		//true = OK
{
	verificar_null(textbox, div);
	var ver_nome = textbox.value.match(/[a-zA-Z\u00E0-\u00FC ]+/g);
	if(ver_nome == null || ver_nome.length != 1 || ver_nome[0] != textbox.value)
	{
		div.hidden = false;
		res_nome=0;
		verificar_registo();
		return;
	}
	else
	{
		div.hidden = true;
		res_nome=1;
		verificar_registo();
		return;
	}
}

function verificar_localidade(textbox, div)		//true = OK
{
	verificar_null(textbox, div);
	var ver_nome = textbox.value.match(/[a-zA-Z\u00E0-\u00FC ]+/g);
	if(ver_nome == null || ver_nome.length != 1 || ver_nome[0] != textbox.value)
	{
		div.hidden = false;
		res_localidade=0;
		verificar_registo();
		return;
	}
	else
	{
		div.hidden = true;
		res_localidade=1;
		verificar_registo();
		return;
	}
}

function verificar_mail(textbox, div)
{
	verificar_null(textbox, div);

	if(textbox.value.match(/[a-zA-Z0-9_]+[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)+/g) == null ||
		textbox.value.match(/[.]$/) != null || textbox.value.match(/[@]/g).length > 1)
	{
		div.hidden = false;
		return false;
	}
	else
	{
		div.hidden = true;
		return true;
	}
}

function verificar_registo()
{
	if(     //verificar_nome(document.getElementById("registo_nome"), document.getElementById("erro_nome"))
		res_nome
		&& res_morada//verificar_morada(document.getElementById("registo_morada"), document.getElementById("erro_morada"))
		&& res_localidade//verificar_localidade(document.getElementById("registo_localidade"), document.getElementById("erro_localidade"))
		&& res_telefone//verificar_telefone(document.getElementById("registo_telefone"), document.getElementById("erro_telefone"))	
		&& res_nif//verificar_nif(document.getElementById("registo_nif"), document.getElementById("erro_nif"))		
		&& res_username//verificar_morada(document.getElementById("registo_username"), document.getElementById("erro_username"))
	    && res_password//verificar_password(document.getElementById("registo_pass"), document.getElementById("erro_pass"))
		&& res_pass_conf//verificar_confirmacao_password(document.getElementById("registo_pass"), document.getElementById("registo_pass_conf"), document.getElementById("erro_confirmacao"))
	)
		{
		document.getElementById("submeter").disabled = false;
		document.getElementById("submeter2").style.color="#339933";
		}
	else
		{document.getElementById("submeter").disabled = true;
		document.getElementById("submeter2").style.color="#FF0000";	}
}


function isNumber(n)
{
  return !isNaN(parseFloat(n)) && isFinite(n);
}
