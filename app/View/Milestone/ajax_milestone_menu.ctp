<?php if(isset($milestone_all) && !empty($milestone_all)){ 
		$i = 0;$count = 0;?>
<?php foreach($milestone_all as $mile){
	$i++;$count++;?>
<a class="proj_lnks ttc" href="javascript:jsVoid();" onClick="switchMilestone(this,'<?php echo $mile['Milestone']['id']; ?>','<?php echo $pjid; ?>')"><?php echo $this->Format->shortLength($mile['Milestone']['title'],20); ?></a>
<?php if($i != count($milestone_all)){	?>
		<hr class="pro_div"/>
<?php }
	}} ?>
