<?php
header('Content-type: application/json');
$errors = '';
if(empty($errors))
{
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$from_email = $request->from;
	$message = $request->text;
	$phone = $request->phone;
	$name = $request->subject;
	$to_email = $from_email;
	$email_subject = "Customer Enquiry - Wooden Bells";
	$email_body = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px #bfbfbf">
        <tbody>
                <tr>
                        <td height="35" bgcolor="#F0F0F0" style="padding:5px">
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                                <tr>
                                                        <td height="25" align="center" bgcolor="#FFFFFF" style="font-size:10px;font-weight:bold;color:#666666;font-family:Arial,Helvetica,sans-serif">
                                                                <strong>Customer Enquiry</strong> - Wooden Bells
                                                        </td>
                                                </tr>
                                        </tbody>
                                </table>
                        </td>
                </tr>
                <tr>
                        <td width="582" style="font-size:12px;font-family:Arial,Helvetica,sans-serif;line-height:18px;padding:10px">
                                <br>
                                <br>
                                <table width="400" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px #bfbfbf;margin:0 auto;">
                                        <tbody>
                                                <tr>
                                                        <td height="20" bgcolor="#FFFFFF" style="padding:5px;border: 1px solid #dddddd;">
                                                                Name
                                                        </td>
                                                        <td height="20" bgcolor="#FFFFFF" style="padding:5px;border: 1px solid #dddddd;">
                                                        '.$name.'
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td height="20" bgcolor="#FFFFFF" style="padding:5px;border: 1px solid #dddddd;">
                                                                Phone Number
                                                        </td>
                                                        <td height="20" bgcolor="#FFFFFF" style="padding:5px;border: 1px solid #dddddd;">
                                                               '. $phone.'
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td height="20" bgcolor="#FFFFFF" style="padding:5px;border: 1px solid #dddddd;">
                                                                Email ID
                                                        </td>
                                                        <td height="20" bgcolor="#FFFFFF" style="padding:5px;border: 1px solid #dddddd;">
                                                                '.$from_email.'
                                                        </td>
                                                </tr>
                                                <tr>
                                                        <td height="20" bgcolor="#FFFFFF" style="padding:5px;border: 1px solid #dddddd;">
                                                                Message
                                                        </td>
                                                        <td height="20" bgcolor="#FFFFFF" style="padding:5px;border: 1px solid #dddddd;">
                                                                '.$message.'
                                                        </td>
                                                </tr>
                                        </tbody>
                                </table>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>Regards,
                                <br>Admin
                        </td>
                </tr>
        </tbody>
</table>';
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "From: $from_email\n";
	$headers .= "Reply-To: $from_email";
	mail($to_email,$email_subject,$email_body,$headers);
	$response_array['status'] = 'success';
	$response_array['from'] = $from_email;
	echo json_encode($response_array);
	echo json_encode($from_email);
} else {
	$response_array['status'] = 'error';
	echo json_encode($response_array);
}
?>
