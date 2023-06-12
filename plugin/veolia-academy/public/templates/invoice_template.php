<?php 

function get_content($image,$invoice_data)
{
	$total = 0;
	$content = '';
	foreach ($invoice_data['order_details_data'] as $data) {
		$content .= '<tr>
			<td class="pad-3">'.$data["order_detail_learning_program"].' <br>
				<div class="rtl">order #'.$data["order_detail_id"].'</div>
			</td>
			<td class="pad-3">'.$data["order_detail_qty"].'</td>
			<td class="rtl pad-3">$'.$data["order_detail_learning_program_fee"].'</td>
			<td class="rtl pad-3">$'.$data["order_detail_learning_program_fee"].'</td>
		</tr>';
	$total += $data["order_detail_learning_program_fee"];
 }

	if(isset($_SESSION['user_type']) && $_SESSION['user_type']=='internal')
	{
		return '<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8" />
				<title>Veolia Academy - Order Invoice</title>

						<style>
						body {
							font-family: sans-serif;
							font-size: 10pt;
						}
					
						p {
							margin: 0pt;
						}

						table {width:100%;line-height: 24px; border-collapse: collapse;} 
					
						table.items {
							border: 0.1mm solid #e7e7e7;
							border-collapse: collapse;
						}
					
					
						td {
							vertical-align: top;
						}
					
						.items td {
							border-left: 0.1mm solid #e7e7e7;
							border-right: 0.1mm solid #e7e7e7;
						}

						.invoice-box {
							max-width: 800px;
							margin: auto;
							padding: 30px;
							font-size: 14px;
							line-height: 24px;
							font-family: ""Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
							color: #555;
							border-collapse: collapse;
						
						}

						
						table thead td {
							text-align: center;
							border: 0.1mm solid #e7e7e7;
						}
					
						.items td.blanktotal {
							background-color: #EEEEEE;
							border: 0.1mm solid #e7e7e7;
							background-color: #FFFFFF;
							border: 0mm none #e7e7e7;
							border-top: 0.1mm solid #e7e7e7;
							border-right: 0.1mm solid #e7e7e7;
						}
					
						.items td.totals {
							text-align: right;
							border: 0.1mm solid #e7e7e7;
						}
					
						.items td.cost {
							text-align: "."center;
						}
						td.rtl {
							text-align:right;
							}

						td.ltr {
							text-align:left;
						}
						table.items2 td {
							padding: 8px;
						}

						table td.pad-3  {
							padding: 8px;
						}
				

				</style>
			</head>

			<body>
				<div class="invoice-box">
					<table class="items" cellpadding="0" cellspacing="0">
						<tr class="top">
							<td colspan="4">
								<table class="items2">
									<tr>
										<td class="title">
											<img src="'.$image[0].'" style="max-width: 140px;height:40px;" />
										</td>

										<td class="rtl">
											Invoice #: 000'.$invoice_data['order_data']["order_id"].'<br />
											Order Date: '.date("d F Y", strtotime($invoice_data['order_data']["order_created_datetime"])).'<br />
											
										</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr class="information">
							<td colspan="4" class="ltr">
								
								<table class="items2">
								
									<tr>
										<td>
											
											<strong>BILLING ADDRESS</strong><br />
											'.$invoice_data["vro_lms_userfullname"].'<br />
											'.$invoice_data["vro_lms_useraddr"].'
											<br>&nbsp;<br>&nbsp;
										</td>

										<td>
										
										<strong>SHIPPING ADDRESS</strong><br />
										'.$invoice_data["vro_lms_userfullname"].'<br />
										'.$invoice_data["vro_lms_useraddr"].'
										<br>&nbsp;<br>&nbsp;
										</td>
									</tr>
									
								</table>
							
							</td>
						</tr>
						<tr>
						<td class="pad-3"><strong>Items</strong></td>
						<td class="pad-3"><strong>Quantity</strong></td>
						<td class="pad-3"><strong>Cost</strong></td>
						<td class="pad-3"><strong>Total</strong></td>
					<tr>
					'.$content.'
					<tr>
						<td colspan=3 class="rtl pad-3">
							<div><strong>Discount</strong></div>
						</td>
						<td class="rtl pad-3">
							<strong>$'.$total.'</strong>
						</td>
					</tr>
					<tr>
						<td colspan=3 class="rtl pad-3">
							<div><strong>Total</strong></div>
						</td>
						<td class="rtl pad-3">
							<strong>$0</strong>
						</td>
					</tr>
					</table>
				</div>
			</body>
		</html>';
	}
	else
	{
		return '<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8" />
			<title>Veolia Academy - Order Invoice</title>

					<style>
					body {
						font-family: sans-serif;
						font-size: 10pt;
					}
				
					p {
						margin: 0pt;
					}

					table {width:100%;line-height: 24px; border-collapse: collapse;} 
				
					table.items {
						border: 0.1mm solid #e7e7e7;
						border-collapse: collapse;
					}
				
				
					td {
						vertical-align: top;
					}
				
					.items td {
						border-left: 0.1mm solid #e7e7e7;
						border-right: 0.1mm solid #e7e7e7;
					}

					.invoice-box {
						max-width: 800px;
						margin: auto;
						padding: 30px;
						font-size: 14px;
						line-height: 24px;
						font-family: ""Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
						color: #555;
						border-collapse: collapse;
					
					}

					
					table thead td {
						text-align: center;
						border: 0.1mm solid #e7e7e7;
					}
				
					.items td.blanktotal {
						background-color: #EEEEEE;
						border: 0.1mm solid #e7e7e7;
						background-color: #FFFFFF;
						border: 0mm none #e7e7e7;
						border-top: 0.1mm solid #e7e7e7;
						border-right: 0.1mm solid #e7e7e7;
					}
				
					.items td.totals {
						text-align: right;
						border: 0.1mm solid #e7e7e7;
					}
				
					.items td.cost {
						text-align: "."center;
					}
					td.rtl {
						text-align:right;
						}

					td.ltr {
						text-align:left;
					}
					table.items2 td {
						padding: 8px;
					}

					table td.pad-3  {
						padding: 8px;
					}
			

			</style>
		</head>

		<body>
			<div class="invoice-box">
				<table class="items" cellpadding="0" cellspacing="0">
					<tr class="top">
						<td colspan="4">
							<table class="items2">
								<tr>
									<td class="title">
										<img src="'.$image[0].'" style="max-width: 140px;height:40px;" />
									</td>

									<td class="rtl">
										Invoice #: 000'.$invoice_data['order_data']["order_id"].'<br />
										Order Date: '.date("d F Y", strtotime($invoice_data['order_data']["order_created_datetime"])).'<br />
										
									</td>
								</tr>
							</table>
						</td>
					</tr>

					<tr class="information">
						<td colspan="4" class="ltr">
							
							<table class="items2">
							
								<tr>
									<td>
										
										<strong>BILLING ADDRESS</strong><br />
										'.$invoice_data["vro_lms_userfullname"].'<br />
										'.$invoice_data["vro_lms_useraddr"].'
										<br>&nbsp;<br>&nbsp;
									</td>

									<td>
									
									<strong>SHIPPING ADDRESS</strong><br />
									'.$invoice_data["vro_lms_userfullname"].'<br />
									'.$invoice_data["vro_lms_useraddr"].'
									<br>&nbsp;<br>&nbsp;
									</td>
								</tr>
								
							</table>
						
						</td>
					</tr>
					<tr>
					<td class="pad-3"><strong>Items</strong></td>
					<td class="pad-3"><strong>Quantity</strong></td>
					<td class="pad-3"><strong>Cost</strong></td>
					<td class="pad-3"><strong>Total</strong></td>
				<tr>
				'.$content.'
				<tr>
					<td colspan=3 class="rtl pad-3">
						<div><strong>Total</strong></div>
					</td>
					<td class="rtl pad-3">
						<strong>$'.$total.'</strong>
					</td>
				</tr>
				</table>
			</div>
		</body>
	</html>';	
	}
}
?>