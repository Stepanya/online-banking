<?php
    session_start();
    include "../db.php";

    $accno = (isset($_GET['accno']) ? $_GET['accno'] : "");
    $desc = (isset($_GET['desc']) ? $_GET['desc'] : "Funds Transfer");
    $types = array('Funds Transfer', 'Bills Payment');
    $bth = $size = "";
    $width = "16.66";
    if ($desc == "Bills Payment") {
        $bth = '<th width="12.5%" align="center"><b>Bill Reference #</b></th>
                <th width="12.5%" align="center"><b>Status</b></th>';
        $width = "12.5";
        $size = "font-size: 8px;";            
    }

    $result = $con->query("SELECT type FROM accounts WHERE account_no = $accno");
    $row = $result->fetch_assoc();
    $type = $row['type'];

	function generateRow($con, $accno, $desc, $types, $bth){
		$contents = '';
	 	
        if ($desc == "Bills Payment") {
            $query = "SELECT * FROM transactions 
                                WHERE description = '$desc'
                                AND account_no = '$accno'
                                ORDER BY date DESC";
        } else {
            $query = "SELECT * FROM transactions 
                                WHERE description = '$desc'
                                AND account_no = '$accno'
                                OR beneficiary = '$accno'
                                ORDER BY date DESC";
        }
        $result = $con->query($query);
        while ($row = $result->fetch_assoc()) {
		
			$contents .= '
			<tr>
				<td align="left">'.$row['account_no'].'</td>
				<td align="left">'.$row['beneficiary'].'</td>
				<td align="left">'.$row['description'].'</td>
				<td align="left">Php '.number_format($row['amount'], 2).'</td>
                <td align="left">Php '.($row['beneficiary'] == $accno ? $row['bal_after_to'] : $row['bal_after_from']).'</td>
                <td align="left">'.date('M d, Y h:i A', strtotime($row['date'])).'</td>
                '.($desc == "Bills Payment" ? "<td align='left'>{$row["bill_ref"]}</td> <td align='left'>{$row["status"]}</td>" : "").'
			</tr>
			';
		}
		return $contents;
	}

	require_once('../tcpdf/tcpdf.php');  

    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("$desc Transactions");  
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
                        '.$size.' 
                    }
                    th {
                        background-color: #F0EAD6;
                        '.$size.'
                    }
                </style>';  
    $content .= '
      	<h2 align="center">Baysic Bank</h2>
        <h4 align="center">'.$desc.' Transactions</h4>
        <h4>Account Number: '.$accno.'</h4>
        <h4>Account Type: '.$type.'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="'.$width.'%" align="center"><b>Account Number</b></th>
                <th width="'.$width.'%" align="center"><b>Benificiary</b></th>
                <th width="'.$width.'%" align="center"><b>Description</b></th>
                <th width="'.$width.'%" align="center"><b>Amount</b></th>
                <th width="'.$width.'%" align="center"><b>Balance After Transaction</b></th>
				<th width="'.$width.'%" align="center"><b>Date</b></th>
                '.$bth.' 
           </tr>  
      ';  
    $content .= generateRow($con, $accno, $desc, $types, $bth);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('transactions.pdf', 'I');

    
?>