<style>
.ajx-selctd {color: #F6911D; font-weight:bold; }
</style>
<div id="id2_new" class="ajx-cs-srch" style="max-height:400px;overflow-x:auto;">
    <div id="id_ajx1" class="ajx-cntnt">
	<table cellpadding="0" cellspacing="0" class="col-lg-12 ajx-srch-tbl">
	    <tr class="nohover">
        	<td colspan="2">
		    <div><span class="src_txt search_font"><?php echo __('Search Results');?></span>
		    <div class="fr close close-icon" onclick="document.getElementById('id_ajx1').style.display = 'none';document.getElementById('id2_new').style.display = 'none';"><i class="material-icons">&#xE14C;</i></div>
		    </div>
		</td>
	    </tr>
	    <?php if ((!empty($results['cases'])) || (!empty($results['projects'])) || (!empty($results['defect'])) || (!empty($results['users'])) || (!empty($results['files'])) || (!empty($results['milestone'])) ) {
		if (!empty($results['cases'])) { ?>
		    <?php $c = 0;
		    $uniqId = NULL;
		    $shortName = NULL;
		    $projArr = array();
		    foreach ($results['cases'] as $getcase) {
			$projArr = $this->Casequery->caseProject($getcase['Easycase']['project_id']);
			if (count($projArr)) {
			    $uniqId = $projArr['Project']['uniq_id'];
			    $shortName = $projArr['Project']['short_name'];
			} ?>
		    <tr class="alltrcls cmn_link_color anchor" data-id="<?php echo $getcase['Easycase']['uniq_id'];?>" data-case-no="<?php echo $getcase['Easycase']['case_no'];?>" onclick="searchTasks('<?php echo $getcase['Easycase']['case_no']; ?>', '<?php echo $getcase['Easycase']['uniq_id']; ?>')">
			    <td class="ttu max-width75">
			    <?php echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $shortName); ?>
			    - <?php echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $getcase['Easycase']['case_no']); ?>
			    </td>
			    <td class="wrap-txt ttc">
				<?php $data = $this->Format->formatSearchText($getcase['Easycase']['title']);
				    echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $data);
				?>
			    </td>
			</tr>		
		    <?php }
		}
		if (!empty($results['milestone'])) { ?>
		    <?php $c = 0;
		    $uniqId = NULL;
		    $shortName = NULL;
		    $projArr = array();
		    foreach ($results['milestone'] as $getcase) {
			$projArr = $this->Casequery->caseProject($getcase['Milestone']['project_id']);
			if (count($projArr)) {
			    $uniqId = $projArr['Project']['uniq_id'];
			    $shortName = $projArr['Project']['short_name'];
			} ?>
		    <tr class="alltrcls cmn_link_color anchor" data-id="<?php echo $getcase['Milestone']['uniq_id'];?>" data-case-no="<?php echo $getcase['Milestone']['id'];?>" onclick="searchMilestones('<?php echo $getcase['Milestone']['id']; ?>', '<?php echo $getcase['Milestone']['uniq_id']; ?>')">
			    <td class="ttu max-width75">
			    <?php echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $shortName); ?>
			    - <?php echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $getcase['Milestone']['id']); ?>
			    </td>
			    <td class="wrap-txt ttc">
				<?php $data = $this->Format->formatSearchText($getcase['Milestone']['title']);
				    echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $data);
				?>
			    </td>
			</tr>		
		    <?php }
		}

		if (!empty($results['projects'])) { ?>
		    <?php foreach ($results['projects'] as $getproject) { 
			$role = '';
			if($getproject['Project']['isactive'] == 2) {
			    $role = 'inactive';
			}
			?>
			<tr class="alltrcls cmn_link_color anchor" data-id="<?php echo $getproject['Project']['uniq_id'];?>" data-role="<?php echo $role;?>" onclick="searchProject('<?php echo $role;?>','<?php echo $getproject['Project']['uniq_id'];?>')">
			    <td colspan="2" class="ttc">
				<?php $data = ucfirst($getproject['Project']['name'])." (".strtoupper($getproject['Project']['short_name']).")";
				    echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $data);
				?>
			    </td>
			</tr>
		    <?php }
		}
		if (!empty($results['defect'])) { ?>
		    <?php foreach ($results['defect'] as $getdefect) { 
			$role = '';
			if($getdefect['Defect']['is_active'] == 0) {
			    $role = 'inactive';
			}
			?>
			<tr class="alltrcls cmn_link_color anchor" data-id="<?php echo $getdefect['Defect']['uniq_id'];?>" data-role="<?php echo $role;?>" onclick="searchDefectSrchBr('<?php echo $role;?>','<?php echo $getdefect['Defect']['uniq_id'];?>')">
			    <td colspan="2" class="ttc">
				<?php $data = ucfirst($getdefect['Defect']['title']);
				    echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $data);
				?>
			    </td>
			</tr>
		    <?php }
		}
		if (!empty($results['users'])) { ?>
		    <?php foreach ($results['users'] as $getuser) { 
			if($getuser['CompanyUser']['is_active'] == 1 || $getuser['CompanyUser']['is_active'] == 0) {
			    if($getuser['CompanyUser']['is_active'] == 0) {
				$role = 'disable';
			    } else {
				$role = 'all';
			    }
			    $data = ucfirst($getuser['User']['name'])." ".ucfirst($getuser['User']['last_name'])." (".strtoupper($getuser['User']['short_name']).")";
			} elseif($getuser['UserInvitation']['is_active'] == 1) {
			    $role = 'invited';
			    $data = $getuser['User']['email'];
			}
			?>
			<tr class="alltrcls cmn_link_color anchor" data-id="<?php echo $getuser['User']['uniq_id'];?>" data-role="<?php echo $role;?>" onclick="searchUser('<?php echo $role;?>', '<?php echo $getuser['User']['uniq_id'];?>', '')">
			    <td colspan="2" class="ttc">
				<?php echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $data); ?>
			    </td>
			</tr>
		    <?php }
		}
		
		if (!empty($results['files'])) { ?>
		    <?php foreach ($results['files'] as $getfile) { ?>
			<tr class="alltrcls cmn_link_color anchor" data-id="<?php echo $getfile['Project']['uniq_id'];?>" data-role="<?php echo $getfile['CaseFile']['id'];?>" onclick="searchFile('<?php echo $getfile['CaseFile']['id'];?>','<?php echo $getfile['Project']['uniq_id'];?>','<?php echo $srchstr;?>')">
			    <td colspan="2" class="ttc">
				<?php $data = $getfile['CaseFile']['file'];
				    echo str_ireplace($srchstr, "<span class='ajx-selctd'>" . $srchstr . "</span>", $data);
				?>
			    </td>
			</tr>
		    <?php }
		}
	    } else {
		?>
	    <tr class="nohover noborder">
		<td colspan="2">
			<?php if($results['page'] == 'tasks'){ ?>
				<span class="colr_red"><?php echo __('No Task Found');?>.</span>
			<?php }else{ ?>
		    	<span class="colr_red"><?php echo __('No result found');?>.</span>
			<?php } ?>
		</td>
	    </tr>	
	<?php } ?>
	</table>
    </div>
</div>