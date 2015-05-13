<?php
	$pSlash = base64_decode(isset($_POST['slash'])?@$_POST['slash']:@$_GET['slash']);
	$pModule = base64_decode(isset($_POST['module'])?@$_POST['module']:@$_GET['module']);
	
	require_once($pSlash."include/cPhpIniStart.php");
  require_once($pSlash."include/cPhpFunctions.php");
?>
<?php require_once($pSlash."include/cPhpModuleI.php");?>
<script type="text/javascript">
	
	var GB;
	
	// Definición Variables
    var oCard, oGrid, oForm, oFilter, oCheck = 1, oClk = false, cChk1, cChk2, cVal1, cVal2;
    
	rj.Ready = function(){
			rj.ApplySetting();
			GB = new Global();
			GB.oPrint({
					ToolBar:{
						buttons:['FIL']
					,	state:{ 1:[0] }
				}
				, Config:{ type:'EXL', filter:[
					
					{height:16,fields:[
						{id:'Param1', rjType:'LookUp', width:105, label:{text:'OPR:', width:110},
					lookLike:'Flat', scase:'opregis',allowBlank:true, tagWidth:272, margin:{left:2,bottom:2}, store:{params:{'cxn':1}}}]},
			]}}).show();
		};
	
	;
  </script>
<?php require_once($pSlash."include/cPhpModuleF.php"); ?>