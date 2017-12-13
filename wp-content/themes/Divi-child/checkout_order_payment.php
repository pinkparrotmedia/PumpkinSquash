<style type="text/css">
.input-text {
    display: block;
    height:45px;
    border: 1px solid #ccc;
    width: 100%;
    color: #403f41;
    font-size: 12px;
    font-family: 'Montserrat', sans-serif;
    margin-top: 20px;
}
.checkout-login-div{
	text-align: left;
}

.custom-radio {
    background: url(/wp-content/themes/Divi-child/images/radio2-unchecked.jpg);
    height: 21px;
    width: 40px;
    background-position-x: 0px;
    background-size: 16px;
    background-repeat: no-repeat;
}
.custom-radio.checked {
    background: url(/wp-content/themes/Divi-child/images/radio2-checked.jpg);
    background-size: 16px;
    display: inline-block;
    background-repeat: no-repeat;
}
.tbl-payment-types, .tbl-payment-types tr{
	border:none !important;
}

.tbl-payment-types td{
	padding: 0px !important;
	border:none !important;
	vertical-align: top;
}
.payment-select{
	width: 30px;
}
.tbl-payment-types, .tbl-payment-types tr{
	border-bottom: 1px solid #e6e6e6;
}
.payment-products {
	margin-top: 32px !important;
}
.payment-products td,.payment-products{
	border-right: none;
	border-left: none;
}
.payment-products tr, .payment-products td{
	border-bottom: 1px solid #eee;
	border-top: none !important;
	padding-left: 0px !important;
}
</style>

<h1 style="text-align:center;border-bottom:1px solid #e6e6e6;padding-bottom:15px;">Order & Payment</h1>

<div class="checkout-login-div" style="margin:0px 22px">
  		
	<table class="payment-products" style="border:none !important">
		<tr>
			<td>Product</td>
			<td>Total</td>
		</tr>

		<tr>
			<td>Product Name</td>
			<td>$100</td>
		</tr>

		<tr>
			<td>Product Name</td>
			<td>$100</td>
		</tr>

		<tr>
			<td>Product</td>
			<td>$100</td>
		</tr>
	</table>

	<table class="tbl-payment-types">
		<tr style="border-bottom: 1px solid #e6e6e6 !important; padding-bottom:22px !important;">
			<td class="payment-select" style="padding:23px !important"><label class="custom-radio "><input type="checkbox" class="" /></label></td>
			<td style=" padding-bottom:22px !important; padding-top:25px !important;">
				<h2>Direct Bank Transfer</h2>
				Lorem ipsum dolor sit amet, consectetur 
adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
			</td>
		</tr>

		<tr style="border-bottom: 1px solid #e6e6e6 !important; padding-bottom:22px !important;">
			<td class="payment-select" style="padding:23px !important"><label class=" custom-radio"><input type="checkbox" class="" /></label></td>
			<td style=" padding-bottom:22px !important; padding-top:25px !important;"><h2>Cheque Payments</h2></td>
		</tr>

		<tr style="border-bottom: 1px solid #e6e6e6 !important; padding-bottom:22px !important;">
			<td class="payment-select" style="padding:23px !important"><label class=" custom-radio"><input type="checkbox" class="" /></label></td>
			<td style=" padding-bottom:22px !important; padding-top:25px !important;"><h2>Cash On Delivery</h2></td>
		</tr>
		<tr >
			<td colspan="2" style=" padding-bottom:63px !important; padding-top:25px !important;">

				<div style="float:left; width:33%;position:relative;text-align:center">
					<label style="position:absolute;left: 0;top: 18px;" class=" custom-radio"><input type="checkbox" class=""></label> 
					<img src="/wp-content/themes/Divi-child/images/mastercard.jpg" style="
					    width: 75px;
					  
					">
				</div>
				<div style="float:left; width:33%;position:relative;text-align:center">
					<label style="position:absolute;left: -9px;top: 18px;" class=" custom-radio"><input type="checkbox" class=""></label> 
					<img src="/wp-content/themes/Divi-child/images/paypal.jpg" style="width: 80px;margin-top: 8px;margin-right: -6px;">
				</div>
				<div style="float:left; width:33%;position:relative;text-align:center">
					<label style="position:absolute;left: -4px;top: 18px;" class=" custom-radio"><input type="checkbox" class=""></label> 
					<img src="/wp-content/themes/Divi-child/images/amex.jpg" style="width: 75px;margin-top: 4px;">
				</div>
			</td>
		</tr>
	</table>

	<button type="button" class="btn btn-dark" style="margin-top:20px; font-size:16.5px; margin-bottom:10px;display:block;width:100%;padding-top:11px;">Previous</button>
	<button type="button" class="btn btn-green" style="margin-top:20px; margin-bottom:40px;display:block;width:100%;padding-top:11px;">Apply Coupon</button>
	<div style="text-align:center">Step 4/4</div>

</div>
