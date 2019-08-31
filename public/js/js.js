var ProcessController = {
	getValue : function(){
		$('.error').remove();
		$('.success').remove();
		var data = $('#number-check').val();
		if(!data){
			alert('Bạn phải nhập số để kiểm tra');
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
				} else {
					$('.notification').append("<div class='success'>Số đối xứng lớn nhất từ số "+ data +" là: " + response +" </div>");
					$('#number-check').val('');
				}
			}
		});
	}
}