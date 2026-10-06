<head>
	<title>รายงานตรวจสอบบุคคลล้มละลาย</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
    <style type="text/css">
    html,body {padding: 0;margin: 0;width: 100%;height: 100%;}   
    #overlay {position: absolute;top: 0px;left: 0px;background: #ccc;width: 100%;height: 100%;opacity: .75;filter: alpha(opacity=75);-moz-opacity: .75;z-index: 999;background: #fff url(http://i.imgur.com/KUJoe.gif) 50% 50% no-repeat;}   
    .main-contain{position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;overflow: hidden;}

	.repTitleGrp {text-shadow: 2px 2px 5px #6495ED;font-family:AngsanaUPC;font-size:25px;text-align:center;}
	table.repTitleGrp th {border:#5555aa 1px ridge;font-family:AngsanaUPC;font-size:20px;background-color:#CCCCCC;text-shadow: 2px 2px 5px #6495ED;}
	table.repTitleGrp td {border:#aaaaff 1px dotted;font-family:AngsanaUPC;font-size:20px;text-shadow: 2px 2px 5px #6495ED;margin: 0px 0px 0px 0px;}
	.repTitleGrp2 {border:#aaaaff 0px dotted;font-family:AngsanaUPC;font-size:20px;text-shadow: 2px 2px 5px #6495ED;margin: 0px 0px 0px 0px;}
    </style>
</head>

<body>

<?PHP
//error_reporting(0);										///			ERROR  ARRAY
$getGrp = $_POST['recGrp'];

$getDbDept = $_POST['dbDept'];						//	ข้อมูล ณ วันที่ ......
$arrMth = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
//echo "วันที่ ".date("d")." ".$arrMth[date("m")]." ".date("Y");

include "connectOracle.php";

//echo "Group == ".$getGrp;

switch ($getGrp)
{
	case 1:$txtGrp = "mg.membgroup_ctlsch in('100100','101800','101900','102000','102100','102500','102600','102700') and mb.membgroup_code not between '500000' and '5ฮ9999' ";break;		//  สพป.บร. เขต 1  (เฉพาะหน้า 0 5)
	case 2:$txtGrp = "mg.membgroup_ctlsch in('100200','101600','101700','102200','102300') and mb.membgroup_code not between '500000' and '5ฮ9999' ";break;												//  สพป.บร. เขต 2  (เฉพาะหน้า 0 5)
	case 3:$txtGrp = "mg.membgroup_ctlsch in('100300','100800','100900','101000','101100','101200','101300','102400') and mb.membgroup_code not between '500000' and '5ฮ9999' ";break;		//  สพป.บร. เขต 3  (เฉพาะหน้า 0 5)
	case 4:$txtGrp = "mg.membgroup_ctlsch in('100400','100500','100600','100700','101400','101500') and mb.membgroup_code not between '500000' and '5ฮ9999' ";break;									//  สพป.บร. เขต 4  (เฉพาะหน้า 0 5)
	case 5:$txtGrp = "mb.membgroup_code between '500000' and '5ฮ9999' ";break;																				//  สพม.32
	case 6:$txtGrp = "mb.membgroup_code between '100000' and '4ฮ9999' ";break;																				//  พนักงานราชการ
	case 7:$txtGrp = "mg.membgroup_ctlsch in('300100','301800','301900','302000','302100','302500','302600','302700') ";break;		//  บำนาญ เขต 1
	case 8:$txtGrp = "mg.membgroup_ctlsch in('300200','301600','301700','302200','302300') ";break;													//  บำนาญ เขต 2
	case 9:$txtGrp = "mg.membgroup_ctlsch in('300300','300800','300900','301000','301100','301200','301300','302400') ";break;		//  บำนาญ เขต 3
	case 10:$txtGrp = "mg.membgroup_ctlsch in('300400','300500','300600','300700','301400','301500') ";break;									//  บำนาญ เขต 4
	case 11:$txtGrp = "mb.membgroup_code between '600000' and '8ฮ9999' ";break;																			//  ลูกหนี้พิเศษ เทศบาล/อบต
	case 12:$txtGrp = "mb.membgroup_code = 'S10001' ";break;																												//  สมทบ S10001
	case 13:$txtGrp = "mb.membgroup_code = 'S10002' ";break;																												//  สมทบ S10002
	case 14:$txtGrp = "mb.membgroup_code in('S10004','S10005','S10006','S10007') ";break;																//  สมทบ S10004 S10005 S10006 S10007
	default:echo "=== none ===";break;
}	

$sql = "select mb.member_no as membNo,mp.prename_desc as prefix,mb.memb_name as name,mb.memb_surname as surname,mb.membgroup_code as mgcode,";
$sql .= "mg.membgroup_desc as mgdesc,mb.card_person as card,sh.sharestk_amt * 10 as shareamt,";
$sql .= "to_char(mb.resign_date,'dd/mm/yyyy') as resign ";
$sql .= "from mv_mbmembmaster mb  ";
$sql .= "left join mv_mbucfprename mp on mb.prename_code = mp.prename_code ";
$sql .= "join mv_mbucfmembgroup mg on mb.membgroup_code = mg.membgroup_code ";
$sql .= "join mv_shsharemaster sh on mb.member_no = sh.member_no ";
$sql .= "where ".$txtGrp." and mb.card_person <> ' ' ";
$sql .= "order by mb.membgroup_code,mb.member_no";
$result = oci_parse($conn, $sql);
oci_execute ($result);

//header ("content-type:application/json");

$pageNo = 1;
$arrGrpName = array('','สพป.บร. เขต 1','สพป.บร. เขต 2','สพป.บร. เขต 3','สพป.บร. เขต 4','สพม.32','พนักงานราชการเขต 1-4','บำนาญ เขต 1','บำนาญ เขต 2','บำนาญ เขต 3','บำนาญ เขต 4','ลูกหนี้พิเศษและ เทศบาล/อบต.','สมทบ S10001','สมทบ S10002','สมทบ อื่นๆ');
$txtTitle = "รายงานตรวจสอบบุคคลล้มละลาย<br>หน่วย ";
$txtTitle .= $arrGrpName[$getGrp];
echo "<center><table width='100%'border='0'><tr><td width='20%'>&nbsp;</td><td align='center'><center><font class='repTitleGrp'>".$txtTitle."</font></td>
<td width='20%'align='right'><font face='AngsanaUPC'><i>หน้า&nbsp;&nbsp;".$pageNo."</i></font></td></tr></table>";

echo "<form method='POST'action='apiReport.php'target='_blank'>";
echo "<table class='repTitleGrp'width='100%'>
<tr><th>ลำดับ</th><th>ทะเบียน</th><th>ชื่อ-นามสกุล</th><th>เลขบัตรประชาชน</th><th>สังกัด</th><th>ชื่อสังกัด</th><th>ข้อมูลกรมบังคับคดี</th><th>พิพากษาล้มละลาย</th>
<th>ล้มละลาย</th></tr>";

//require_once "jasonCurl.php";
//require_once "s.loan.php";

$num = 1;$sumCont = 0;
while ($row = oci_fetch_assoc($result))
{
	$memNo = $row['MEMBNO'];
	$fullname = $row['PREFIX']."".$row['NAME']." ".$row['SURNAME'];
	$grpCode = $row['MGCODE'];
	$grpName = $row['MGDESC'];
	$iden = $row['CARD'];

	include  "jasonCurl.php";
	//include "s.loan.php";
	
	//$data = checkBankruptcy($iden);  // เรียกฟังก์ชันแทน include
    //$sumLn = getLoanSummary($memNo);

	if($row['SHAREAMT']==0 ){continue;}
	else
	{
		if($status=="000")			//  $status=="000"
		{
			continue;
		}
		else
		{
			$data = $obj['data'];										//  รายละเอียด Array บุคคลล้มละลาย
			echo "<tr>";echo "<td align='center'>".$num."</td>";
			echo "<td align='center'>".$memNo."</td>";
			echo "<td align='left'>&nbsp;&nbsp;".$fullname."</td>";
			echo "<td align='center'>".$iden."</td>";
			echo "<td align='center'>".$grpCode."</td>";
			echo "<td>".$grpName."</td>";

			echo "<td align='center'color='#ff3333'><u>คดีดำ</u> ".$data['BLACK_CASE']." ปี ".$data['BLACK_YY']." <u>คดีแดง</u> ".$data['RED_CASE']." ปี ".$data['RED_YY']."</td>";
			if($data['BKR_PROT_DD'] <> "")
			{
				echo "<td align='center'color='#ff3333'>".intval($data['BKR_PROT_DD'])." ".$arrMth[intval($data['BKR_PROT_MM'])]." ".$data['BKR_PROT_YY']."</td>";
			}
			else
			{
				echo "<td align='center'color='#ff3333'>-</td>";
			}
			echo "<td><a href='apiReport.php?membNo=".$memNo."&card=".$iden." 'target='_blank'>ตรวจสอบ</a></td></tr>";
		}
	}		

	//  ขึ้นหน้าใหม่
	if($num % 36 == 0)
	{
		$pageNo+=1;
		echo "</table></center>";
		echo "<div style='page-break-after: always'></div>";
		echo "<center><table width='100%'border='0'><tr><td width='20%'>&nbsp;</td><td align='center'><center><font class='repTitleGrp'>".$txtTitle."</font></td>
		<td width='20%'align='right'><font face='AngsanaUPC'><i>หน้า&nbsp;&nbsp;".$pageNo."</i></font></td></tr></table>";
		echo "<table class='repTitleGrp'width='100%'>
		<tr><th>ลำดับ</th><th>ทะเบียน</th><th>ชื่อ-นามสกุล</th><th>เลขบัตรประชาชน</th><th>สังกัด</th><th>ชื่อสังกัด</th><th>ข้อมูลกรมบังคับคดี</th><th>พิพากษาล้มละลาย</th><th>ล้มละลาย</th></tr>";
	}
		
	$num++;
	$sumCont++;
}		//  END WHILE

	$dd = date("d");$dd = intval($dd);$mm = date("m");$mm = intval($mm);$yy = date("Y") + 543;
	$arrMth = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');

	echo "<tr><th colspan='12'align='center'>&nbsp;</th></tr>";
	echo "<tr>
	<td align='right'class='repTitleGrp2'colspan='7'>&nbsp;</td>
	<td align='center'class='repTitleGrp2'colspan='5'>
	<br>ลงชื่อ...................................................................<br>(...................................................................)<br>วันที่ ".$dd."&nbsp;".$arrMth[$mm]."&nbsp;พ.ศ.&nbsp;".$yy."
	</td>
	</tr>";
	echo "</table>";
	echo "</form>";

	oci_free_statement($result);
	oci_close($conn);
?>

    
</body>