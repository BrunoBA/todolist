	
	$(".addActivity").click(function()
	{			
		var name = $("#addActivity").val();
		$.post(
			'/activities/add',
			{nome:name},
			function(resposta){
				if(resposta.status == 'sucess'){

					// var total = $("#total").text();
					// var total = $("#total").text(parseInt(++total));
					location.reload();
				}
				alert(resposta.msg);
			},"json"
		);
	});


	$(".rmActivity").click(function()
	{			
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
							var done = $("#concluded").text();
							var done = $("#concluded").text(parseInt(--done));
						}
					}
					alert(resposta.msg);
				},"json"
			);
		}
	});


	$(".doneActivity").change(function()
	{			
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

	$(".spans").click(function(){
		
		var id = $(this).attr('id');
		var idText = id.replace('span-','');

		$(this).css('display','none');

		$("#text-"+id).css('display','block');
		$("#text-"+idText).focus();
	})

	$(".change").click(function(){

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

	// $(".input-name").blur(function(){
	// 	fechar_inputs();
	// });

	function fechar_inputs(){
		$(".div-input").css("display","none");
		$(".spans").css("display","block");
	}



