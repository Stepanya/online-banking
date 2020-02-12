<?php
    session_start();
    include "../db.php";

	function generateRow($con){
		$contents = '';
        $result = $con->query("SELECT * FROM users");

        if ($result->num_rows == 0) {
            $_SESSION['error'] = "There are no clients to print.";
            header("location: clients.php");
            exit();
        }

        while ($row = $result->fetch_assoc()) {
		
			$contents .= '
			<tr>
				<td align="center">'.$row['fname'].'</td>
				<td align="center">'.$row['mi'].'</td>
				<td align="center">'.$row['lname'].'</td>
                <td align="center">'.$row['dob'].'</td>
                <td align="center">'.$row['address'].'</td>
                <td align="center">'.$row['contact'].'</td>
                <td align="center">'.$row['status'].'</td>
                <td align="center">'.$row['lastlogin'].'</td>
			</tr>
			';
		}
		return $contents;
	}

	require_once('../tcpdf/tcpdf.php');  

    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("All Clients");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    // $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(true);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    // $pdf->SetFont('helvetica', '', 11);  
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->AddPage();  
    $content = '<style>
                    td {
                        background-color: #aec6cf;
                        font-size: 7px;
                    }
                    th {
                        background-color: #F0EAD6;
                        font-size: 7px;
                    }
                </style>';  
    $content .= '
      	<h2 align="center">Baysic Bank</h2>
        <h4 align="center">All Clients</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="12.5%" align="center"><b>First Name</b></th>
                <th width="4.5%" align="center"><b>M.I</b></th>
                <th width="12.5%" align="center"><b>Last Name</b></th>
                <th width="12%" align="center"><b>Date of Birth</b></th>
                <th width="26%" align="center"><b>Address</b></th>
				<th width="12.5%" align="center"><b>Contact #</b></th>
                <th width="8%" align="center"><b>Status</b></th>
                <th width="12%" align="center"><b>Last Login</b></th>
           </tr>  
      ';  
    $content .= generateRow($con);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('clients.pdf', 'I');

    
?>