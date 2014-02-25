<html> <head> <title> </title> </head>
<body style="margin-top:0; margin-bottom:0; margin-left:0; margin-right:0;">
<table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #ccc; width:750px;">
	<!-- table 1 -->
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" style=" width:728px; margin-left:15px;">
				<tr>
					<td style="padding-top:20px; padding-bottom:12px;font-size: 24px;  font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-weight: 500;line-height: 1.1"> YOU ARE CORDIALLY INVITED </td>
				</tr>
				<tr>
					<td style="color: #333333;font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 14px;"> To: <?php echo $to;?> </td>
				</tr>
				<tr>
					<td style="padding-top:4px; padding-bottom:22px;color: #333333;font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 14px;"> <?php echo date("j F, Y, g:i a")?> </td>
				</tr>
				
			</table>
		</td>
	</tr>
	<tr>
		<td style="border-width: 50px 38px; border-style:solid; border-color:#ccc;"> 
			<table cellpadding="0" cellspacing="0" border="0" style="text-align:center; width:100%">
				<tr>
					<td><span style="border-right:1px solid #999; display:block; width:1px; height:50px; margin:0 auto">
					<?php
				if($event['event_image']!=''){
					$src = "files/images/big/".$event['event_image'];
				}else{
					$src = "img/noimage.jpg";
				}
			?>
					</span><img src="http://shaadiseason.in/<?= $src;?>" style="width: 160px;height: 139px;border-radius: 100%;"> </td>
				</tr>
				<tr>
					<td style=" padding-top:20px;font-size: 30px;  font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-weight: 500;line-height: 1.1"><?php echo $event['event_title']?> </td>
				</tr>
				<tr>
					<td style="padding-top:20px;font-size: 24px;  font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-weight: 500;line-height: 1.1"><?php echo $event['event_date_text']?></td>
				</tr>
				<tr>
					<td style="padding-top:10px;"><img src="http://shaadiseason.in/img/torino_google-map.png" style="width: 100px;border-radius: 100%;"></td>
				</tr>
				<tr>
					<td style="padding-top:5px;color: #333333;font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 14px;"><?php echo $event['venue']?></td>
				</tr>
				<tr>
					<td style="padding-top:35px;color: #333333;font-family: Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 14px;">RSVP: <?php echo $event['rsvp']?></td>
				</tr>
				 
			</table>
		</td>
	</tr>
</table>
</body>
</html>