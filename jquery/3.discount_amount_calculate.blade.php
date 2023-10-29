<div class="form-group m-form__group">
    <div class="row">
        <div class="col-md-2">
            <label for="bill_amount">Bill Amount</label>
            <input name="bill_amount" class="form-control m-input" id="bill_amount" value="{{$doctorFees->fees}}" readonly>
        </div>
        <div class="col-md-2">
            <label for="discount_type">Discount</label>
            {!! Form::select('discount_type', $discountTypes, null, ['class' => 'form-control m-input discount-field', 'id' => 'discount_type']) !!}
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label>
            <input name="discount_value" type="number" class="form-control m-input discount-field" id="discount_value">
        </div>
        <div class="col-md-2">
            <label for="payable_amount">Payable Amount</label>
            <input name="payable_amount" type="number" class="form-control m-input" id="payable_amount" value="{{$doctorFees->fees}}" readonly>
        </div>
        <div class="col-md-2">
            <label for="receive_amount">Receive Amount</label>
            <input name="receive_amount" type="number" class="form-control m-input" id="receive_amount">
        </div>
        <div class="col-md-2">
            <label for="due_amount">Due Amount</label>
            <input name="due_amount" type="number" class="form-control m-input" readonly id="due_amount">
        </div>
    </div>
</div>

<script>

	$('#discount_type').change(function(){
		calculateDiscount();
	});

	$('#discount_value').keyup(function(){
		calculateDiscount();
	});

	function calculateDiscount(){

		var method = $('#discount_type').val();
		var value = parseFloat($('#discount_value').val()) || 0;
		var billAmount = parseFloat($('#bill_amount').val());

		if(method == ''){
			value = 0;
			$('#discount_value').val(value);
		}


		if(method == 'Percentage' && value > 100){
			value = 100;
			$('#discount_value').val(value);
		}

		if(value == '' || method == 0){
			$('#payable_amount').val(billAmount);
			return true;
		}

		var discountAmount = 0;
		if(method == 'Percentage'){
			discountAmount = (value * billAmount)/100;
		}else{
			discountAmount = value;
		}

		var payableAmount = billAmount - discountAmount;
		console.log(billAmount);
		console.log(value);
		console.log(discountAmount);
		console.log(payableAmount);
		$('#payable_amount').val(payableAmount);
		$('#receive_amount').val('');
		$('#due_amount').val('');
	}

	$('#receive_amount').keyup(function(){

		@if($appointment->bill_amount == null)
		var payableAmount = parseFloat($('#payable_amount').val()) || 0;
		@else
		var payableAmount = parseFloat($('#remaining_amount').val()) || 0;
		@endif
		var receiveAmount = parseFloat($('#receive_amount').val()) || 0;
		var dueAmount = payableAmount - receiveAmount;
		$('#due_amount').val(dueAmount);

	});

	</script>