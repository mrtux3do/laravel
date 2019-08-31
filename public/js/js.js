var ProcessController = {
	getValue : function(){
		$('.lazyload').show();
		$('.error').remove();
		$('.success').remove();
		var data = $('#number-check').val();
		if(!data){
			$('.lazyload').hide();
			$('.alert').show();
			return false;
		}
		$.ajax({
			type: 'POST',
			url: 'checkNumber',
			data: {data: data},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(response){
				if(response === false){
					$('.notification').append("<div class='error'>Không thể có số đối xứng từ số: "+ data +"</div>");
					$('#number-check').val('');
					$('.lazyload').hide();
				} else {
					$('.notification').append("<div class='success'>Số đối xứng lớn nhất từ số "+ data +" là: " + response +" </div>");
					$('#number-check').val('');
					$('.lazyload').hide();
				}
			}
		});
	},

	back : function(){
		$('.alert').hide();
	}
}