$(function(){
	/*ESTILO DE ABRIR E FECHAR OPÇÕES DE NEMU DE SIDEBAR*/
	$(".li_a_main").click(function(){
		var conteudo = $(this).parent().find(".li_ul2");
		if(conteudo.hasClass("hide")){
			conteudo.slideDown("fast",function(){
				$(this).removeClass("hide").addClass("show")
			})
			$(".ul_li_main").find(".show").slideUp("fast",function(){
				$(this).removeClass("show").addClass("hide")
			})
			var popup = $(".popap_main");
			if(popup.hasClass("show")){
				slideUpp(popup);
			}
		}else{
			$(".ul_li_main").find(".show").slideUp("fast",function(){
				$(this).removeClass("show").addClass("hide")
			})
			var popup = $(".popap_main");
			if(popup.hasClass("show")){
				slideUpp(popup);
			}
		}
		return false;
	})
	/*FUNÇÕE PARA ABRIR E FECHAR POPUP */
	$(".click_img").click(function(){
		var popup = $(this).parent().find(".popap_main");
		if(popup.hasClass("hide")){
			slideDownp(popup);
		}else{
			slideUpp(popup);
		}
		return false;
	})
	$(".corpo_geral").click(function(){
		var popup = $(".popap_main");
		if(popup.hasClass("show")){
			slideUpp(popup);
		}
	})
	function slideUpp(popup){
		popup.slideUp("fast",function(){
			$(this).removeClass("show").addClass("hide");
		})
	}
	function slideDownp(popup){
		popup.slideDown("fast",function(){
			$(this).removeClass("hide").addClass("show");
		})
	}
	$(".btn_close_popup").click(function(){
		 alert("ola");
		var popup = $(".popap_main");
		 
		 alert("ola")
		 return false;
	})
	/*FUNÇÃO PARA COLAR TABELA*/

var tr = $('.tabela-body-tr');
for (var i = 0; i < tr.length; i++) {
	if (i % 2 == 0) {
		$(tr[i]).addClass('tabela-body-tr-linha')
	}
}
})