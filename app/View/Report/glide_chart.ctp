<div class="proj_grids glide_div" id="main_con">
	
	<?php echo $this->element('analytics_header'); ?>
	
	<?php if(empty($pjid)){ ?>
		<div class="col-lg-12 full_con_al no_analytic" style=""><?php echo __('Not enough Analytics data');?>!</div>
	<?php }else{ ?>
		<div style="margin:20px 0 10px;">
			<?php echo $this->Form->hidden('pjid',array('size'=>'45','class'=>'datepicker small','style'=>'','maxlength'=>'100', 'id'=>'pjid','readonly'=>'readonly','value'=>$pjid)); ?>
			<?php echo $this->Form->hidden('pj_uniq',array('size'=>'45','style'=>'','id'=>'pj_uniq','maxlength'=>'100','readonly'=>'readonly','value'=>@$proj_uniq)); ?>
			<?php $pjname = $this->Casequery->getProjectName($pjid); ?>
			<?php echo $this->Form->hidden('pjname',array('size'=>'45','class'=>'datepicker small','style'=>'','maxlength'=>'100','id'=>'pjname','readonly'=>'readonly','value'=>isset($pjname['Project']['name'])?$pjname['Project']['name']:'')); ?>
		</div>
		<div class="col-lg-12 full_con_al">
			<div class="col-lg-6 m-con fl">
				<h3><?php echo __('Bug Status Pie Chart');?></h3>
				<div id="piechart_container">
					<?php echo __('Loading bug status pie chart');?>... 
				</div>
			</div>
			<div class="col-lg-6 m-con fl">
				<h3><?php echo __('Bug Statistics');?></h3>
				<div id="statistic_container">
					<?php echo __('Loading Statistics');?>...
				</div>	
			</div>
			<div class="cb"></div>
			<div class="col-lg-12 con-100">
				<h3><?php echo __('Bugs Life Cycle - Line Chart');?></h3>
				<div id="linechart_container">
					<?php echo __('Loading bug life cycle line chart');?>...
				</div>
			</div>
			<div class="cb"></div>
			<div class="col-lg-12 con-100">
				<h3><?php echo __('Bug Glide Path Chart');?></h3>
				<div id="glide_container">
					<?php echo __('Loading bug glide path chart');?>...
				</div>
			</div>
		</div>
</div>
<div class="cb"></div>
<?php } ?>
<script>
<?php if(!isset($invalid)){ ?>
$(function(){
	var pjid = $('#pjid').val();
	var sdate = $('#start_date').val();
	var edate = $('#end_date').val();
	var url = HTTP_ROOT;
	
	$('#piechart_container').load(url+'reports/bug_pichart',{'type_id':1,'pjid':pjid,'sdate':sdate,'edate':edate}, function(res){
		if(res.length > 150){
			$('#piechart_container').parent(".col-lg-6").addClass('m-con');
			$('#piechart_container').parent(".col-lg-6").removeClass('error_box');
		}else{
			$('#piechart_container').parent(".col-lg-6").removeClass('m-con');
			$('#piechart_container').parent(".col-lg-6").addClass('error_box');
		}
	});
	
	$('#statistic_container').load(url+'reports/bug_statistics',{'type_id':1,'pjid':pjid,'sdate':sdate,'edate':edate}, function(res){
		if(res.length > 150){
			$('#statistic_container').parent(".col-lg-6").addClass('m-con');
			$('#statistic_container').parent(".col-lg-6").removeClass('error_box');
		}else{
			$('#statistic_container').parent(".col-lg-6").removeClass('m-con');
			$('#statistic_container').parent(".col-lg-6").addClass('error_box');
		}
	});
	
	$('#linechart_container').load(url+'reports/bug_linechart',{'type_id':1,'pjid':pjid,'sdate':sdate,'edate':edate}, function(res){
		if(res.length > 150){
			$('#linechart_container').parent(".col-lg-12").addClass('con-100');
			$('#linechart_container').parent(".col-lg-2").removeClass('error_box_main');
		}else{
			$('#linechart_container').parent(".col-lg-2").removeClass('con-100');
			$('#linechart_container').parent(".col-lg-12").addClass('error_box_main');
		}
	});
	
	$('#glide_container').load(url+'reports/bug_glide',{'type_id':1,'pjid':pjid,'sdate':sdate,'edate':edate}, function(res){
		if(res.length > 150){
			$('#glide_container').parent(".col-lg-12").addClass('con-100');
			$('#glide_container').parent(".col-lg-12").removeClass('error_box_main');
		}else{
			$('#glide_container').parent(".col-lg-12").removeClass('con-100');
			$('#glide_container').parent(".col-lg-12").addClass('error_box_main');
		}
	});
});
<?php } ?>
</script>