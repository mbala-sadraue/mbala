$(function(){

	$("#login").click(function(){
		var usuario = $("#usuario").val();
		var senha 	= $("#password").val();
		var  login	= $("#login").val();
		if(usuario !=""){
			if(senha !=""){
				$.ajax({
						url: "App/section.php",
						method:"POST",
						data:{usuario:usuario, senha: senha,login:login},
						success:function(data){
							alert(data);
						}
				})
			}
			else{
				alert("O campo Senha é obrigatorio ")
			}
		}else{
			alert("O campo usuario é obrigatorio ")
		}
		return false;
	})
})