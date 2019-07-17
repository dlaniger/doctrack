<div align="center" style="padding:0px; margin:0px">
	
	<table width="100%" style="padding:0px; margin:0px ; border: 1px solid black ; border-collapse: collapse;">
		<tr style=" border: 1px solid black;" >
		<td style="text-align:center; border: 1px solid black" colspan="2">
			<h4 style="padding:0px; margin:0px">CSRC DOCUMENT TRACKING SYSTEM</h4>
			<p style="padding:0px; margin:0px; font-size: 15px">UP College Science Diliman</p>
			<h4 style="padding:0px; margin:0px">Tracking Attachment</h4>
		</td>
	</tr>
	<tr style=" border: 1px solid black;" >
		<td style="">
			<strong><p style="padding:1px; margin:1px; font-size: 15px">Document Type: </p></strong>	
			<p style="padding-left:5px; margin:1px; font-size: 15px">{{$pdf_data->doc_desc}} </p>
				<br/>	
		</td>
		<td style="vertical-align:top;" >
				<strong><p style="padding:1px; margin:1px; font-size: 15px">Institue: </p></strong>
				<p style="padding-left:5px; margin:1px; font-size: 15px">{{$pdf_data->institute_name}} </p>
		</td>
	</tr>
	<tr style=" border: 1px solid black;" >
		<td style="">
			<strong><p style="padding:1px; margin:1px; font-size: 15px">Document Title: </p></strong>
			<p style="padding-left:5px; margin:1px; font-size: 15px">{{$pdf_data->doc_title}} </p>
			<br/>
			<strong><p style="padding:1px; margin:1px; font-size: 15px">Document Description: </p></strong>
			<p style="padding-left:5px; margin:1px; font-size: 15px">{{$pdf_data->doc_desc}} </p>
			<br/>	
			<strong><p style="padding:1px; margin:1px; font-size: 15px">Date Created: </p></strong>
			<p style="padding-left:5px; margin:1px; font-size: 15px"><?php echo date("m-d-Y", strtotime($pdf_data->date_created)); ?> </p>	
		</td>
		<td style="vertical-align:top; text-align: center;" >
				<strong><p style="padding:1px; margin:1px; font-size: 15px; " ><?php

						$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
						echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($pdf_data->tracking_barcode, $generator::TYPE_CODE_128)) . '">';
						
						?>
						<h4>{{$pdf_data->tracking_barcode}}</h4></p></strong>
		</td>
	</tr>		
	</table>
	
</div>