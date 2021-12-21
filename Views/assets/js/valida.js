

/*INICIO DE FUNÇÃO PARA VALIDAR OS CAMPOS*/
var btn_cadastra = document.getElementById("btn_cadastra");

btn_cadastra.onclick = function(){
	//tirarEspacoVazio();

	var formulario = document.querySelector("form.form_main");
	if(formulario.nome.value==0){
		alert("O campo nome é obrigatório");
		return false;
	}
	if(formulario.nascimento.value==0){
		alert("O campo nascimento é obrigatório");
		return false;
	}
	if(formulario.telefone.value==0){
		alert("O campo telefone é obrigatório");
		return false;
	}
	if(formulario.nascimento.value==0){
		alert("O campo nascimento é obrigatório");
		return false;
	}
	if(formulario.provincia.value==0){
		alert("O campo provincia é obrigatório");
		return false;
	}
	if(formulario.municipio.value==0){
		alert("O campo munícipio é obrigatório");
		return false;
	}
	if(formulario.bairro.value==0){
		alert("O campo bairro é obrigatório");
		return false;
	}
	if(formulario.usuario.value==0){
		alert("O campo Usuario é obrigatório");
		return false;
	}
	if (formulario.password.value==0){
		alert("O campo senha é obrigatório");
		return false;
	}
	var quer = confirm("Tens certezas quer cadastrar "+formulario.nome.value);
	if(quer){
		return true;
	}else{
		return false;
	}
} 


/*FIM DE FUNÇÃO PARA VALIDAR OS CAMPOS*/
var tr = $('.tabela-body-tr');
	for (var i = 0 ; i < tr.length ; i++) {
		if (i%2 == 0) {
			$(tr[i]).addClass('tabela-body-tr-linha')
		}
	}

tirarEspacoVazio();

/*FUNÇÃO QUE NÕA DWIXA CADASTRA COM  ESPAÇO VAZIO*/
function tirarEspacoVazio()
{
	var input = $("form .form_input > input")
	

	$(input).each(function(){
		$(this).keyup(function(){
			var v = $(this).val();


			//var  regex= /[´~^!""?''()[\]\/=;:,\.\\><»«_*@# ]+/.test(v);
			var  regex= /\w/.test(v)
			var tipo = $(this).attr("type");
			if((!v.trim() && tipo != "password")){
				if(tipo != "password" && regex == true){
					$(this).val("");

				}
				
				
			}
			alert(regex)

		})
	})
	
}

var n = 2;
/*/console.log(typeof(n));
if(typeof(n)=="number"){
	console.log("ola");
}*/

