	
	// METODO RESPONSÁVEL POR ADICIONAR NOVAS ATIVIDADES
	$(".addActivity").click(function()
	{			
		var name = $("#addActivity").val();
		$.post(
			'/activities/add',
			{nome:name},
			function(resposta){
				$("#concat").append(resposta);

				var total = $("#total").text();
				var total = $("#total").text(parseInt(++total));

			},"html"
		);
	});

	// MÉTODO RESPONSÁVEL POR REMOVER ATIVIDADES
	$(document).on('click', '.rmActivity',function()
	{	
		fechar_inputs();		
		var id = $(this).attr('id');
		if(confirm("Tem certeza que deseja excluir esta atividade?")){
			$.post(
				'/activities/delete',
				{id:id},
				function(resposta){
					if(resposta.status == 'sucess'){

						$("#tr-"+id).css('display','none');

						var total = $("#total").text();
						var total = $("#total").text(parseInt(--total));

						if(resposta.concluido == 1){
							var concluded = $("#concluded").text();
							var concluded = $("#concluded").text(parseInt(--concluded));
						}
					}
					// alert(resposta.msg);
				},"json"
			);
		}
	});

	// MÉTODO RESPONSÁVEL POR CONCLUIR ATIVIDADS
	$(document).on('change', '.doActivity',function()
	{		
		fechar_inputs();		
		var id = $(this).attr('id');
		if(confirm("Tem certeza que deseja concluir esta atividade?")){
			$.post(
				'/activities/concluir',
				{id:id},
				function(resposta){
					if(resposta.status == 'sucess'){
						
						var total = $("#concluded").text();
						if(resposta.type){
							var total = $("#concluded").text(parseInt(++total));
						}else{
							var total = $("#concluded").text(parseInt(--total));
						}
					}
					alert(resposta.msg);
				},"json"
			);
		}
	});

	//MÉTODO RESPONSÁVEL POR ABRIR O INPUT PARA ALTERAR A ATIVIDADE 
	$(document).on('click', '.spans',function()
	{
		fechar_inputs();

		var id = $(this).attr('id');
		var idText = id.replace('span-','');

		$(this).css('display','none');

		$("#text-"+id).css('display','block');
		$("#text-"+idText).focus();
	})

	//MÉTODO RESPONSÁVEL POR EFETUAR A ALTERAÇÃO DOS DADOS 
	$(document).on('click', '.change',function()
	{

		var text = $(this).parent();

		// Valor do input hidden
		var idText = text.attr('id');

		var idText = $("#"+idText).attr('id').replace('span-','');
		
		// Novo nome para edição
		var name = $("#"+idText).val();

		// Id da atividade em questão
		var id = $("#"+idText).attr('id').replace('text-','');

		$.post(
			'/activities/edit',
			{ 
				id:id,
				name:name,
			},
			function(resposta){
				if(resposta.status == 'sucess'){
					$("#span-"+id).text(name);
					fechar_inputs();
				}
				alert(resposta.msg);
			},"json"
		);
	});

	function fechar_inputs(){
		$(".div-input").css("display","none");
		$(".spans").css("display","block");
	}



