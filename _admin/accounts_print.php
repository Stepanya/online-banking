<?php
    session_start();
    include "../db.php";

	function generateRow($con){
		$contents = '';
        $result = $con->query("SELECT * FROM accounts");

        if ($result->num_rows == 0) {
            $_SESSION['error'] = "There are no accounts to print.";
            header("location: accounts.php");
            exit();
        }

        while ($row = $result->fetch_assoc()) {
		
			$contents .= '
			<tr>
				<td align="center">'.$row['fname'].'</td>
				<td align="center">'.$row['mi'].'</td>
				<td align="center">'.$row['lname'].'</td>
                <td align="center">'.$row['type'].'</td>
                <td align="center">'.$row['balance'].'</td>
                <td align="center">'.$row['account_no'].'</td>
                <td align="center">'.$row['status'].'</td>
			</tr>
			';
		}
		return $contents;
	}

	require_once('../tcpdf/tcpdf.php');  

    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("All Accounts");  
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
                        font-size: 9px;
                    }
                    th {
                        background-color: #F0EAD6;
                        font-size: 9px;
                    }
                </style>';  
    $content .= '
      	<h2 align="center">Baysic Bank</h2>
        <h4 align="center">All Accounts</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="14.28%" align="center"><b>First Name</b></th>
                <th width="14.28%" align="center"><b>M.I</b></th>
                <th width="14.28%" align="center"><b>Last Name</b></th>
                <th width="14.28%" align="center"><b>Account Type</b></th>
                <th width="14.28%" align="center"><b>Balance</b></th>
				<th width="14.28%" align="center"><b>Account #</b></th>
                <th width="14.28%" align="center"><b>Status</b></th>
           </tr>  
      ';  
    $content .= generateRow($con);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('accounts.pdf', 'I');

    
?>