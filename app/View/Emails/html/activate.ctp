<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link href="http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic-ext,greek-ext" rel="stylesheet" type="text/css">
<style>

</style>
</head>
<body>
<table style="width:600px; border:0; background:url(http://webinfomart.com/nitika/wedding/images/mailer-bg.jpg); margin:0 auto; font-family:Arial;"border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			
			<table style="width:552px; border:1px solid #78e4ff; background:#fff; margin:32px 25px 32px 25px; padding:0 84px 144px 84px" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center"style="padding-top:52px;">
						<img src="http://webinfomart.com/nitika/wedding/images/logo_emailer1.jpg">
					</td>
				</tr>
				<tr>
					<td style="padding-top:81px">
						<h3 style="font-size:40px; font-weight:normal; color:#00baf2; margin:0; padding-bottom:6px;"> Welcome to Shaadi season! </h3>
					</td>
				</tr>
				<tr>
					<td>
						<p style="font-size:17px; padding-bottom:28px;  margin:0;"> Thanks for joining Shaadi Season. We listed your sign in details below, make sure you keep them safe.<br />
To verify your email address, please follow this link: 
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<p class="title" style="font-weight:bold;font-size:17px; padding-bottom:28px;  margin:0;">What's next </p>
						<p style="font-size:17px; padding-bottom:28px;  margin:0;">When we're ready for you, well send an invitation with a registration URL, it could be about 2- 4 weeks before this arrives.</p>
					</td>
				</tr>
				<tr>
					<td>
						<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo base_url.'users/activate/'.$user_id.'/'.$user['new_email_key']; ?>" style="color: #3366cc;">Finish your registration...</a></b></big><br />
						<br />
						<p style="font-size:17px;margin:0;">Link doesn't work? Copy the following link to your browser address bar:</p>
						<br />
						<nobr><a href="<?php echo base_url.'users/activate/'.$user_id.'/'.$user['new_email_key']; ?>" style="color: #3366cc;"><?php echo base_url.'users/activate/'.$user_id.'/'.$user['new_email_key']; ?></a></nobr><br />
						<br />
						<p style="font-size:17px;  margin:0;">Please verify your email within 4 hours, otherwise your registration will become invalid and you will have to register again.</p><br />
						<br />
						<br />
						<p style="font-size:17px;margin:0;">Your email address: <?php echo $user['email']; ?>
						</p>
						<br />
						<br />
						<br />
						<p style="font-size:17px; padding-bottom:28px;  margin:0;">Have fun!</p><br />
						
						<p style="font-size:17px; padding-bottom:28px;  margin:0;">Sincerely,<br>
						The ShaadiSeasonTeam</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	
</table>
<body></html>