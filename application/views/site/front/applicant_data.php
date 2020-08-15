<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

<?php
	$p_empty	= "panel-col-grey";
	$p_fill		= "panel-col-indigo";
	$panelColor = [];
		
	# LOAD F1 F2 F8 - PERSONAL
	if ($applicant_data != '0') {		
		foreach($applicant_data as $a) {
			xss_filter($a); # XSS FILTERING
			
			$f1['cv']			= $a->candidat_cv;
			$f1['photo']		= $a->candidat_foto;
			
			$f2['name'] 		= $a->candidat_name;
			$f2['idno'] 		= $a->id_number;
			$f2['pob'] 			= $a->pob;
			$f2['dob'] 			= !empty($a->dob) ? date('d-m-Y', strtotime($a->dob)) : '';
			$f2['gender']		= $a->gender;
			$f2['nat']			= $a->nationality;
			$f2['blood']		= $a->blood_id;
			$f2['religi']		= $a->religion_id;
			$f2['height']		= $a->height;
			$f2['weight']		= $a->weight;
			$f2['cadd']			= $a->curr_address;
			$f2['ccity']		= $a->ca_city;
			$f2['cpost']		= $a->ca_zip_code;
			$f2['cphone']		= $a->ca_ph;
			$f2['padd']			= $a->per_address;
			$f2['pcity']		= $a->pa_city;
			$f2['ppost']		= $a->pa_zip_code;
			$f2['pphone']		= $a->pa_ph;
			$f2['addr_new']		= (empty($f2['cadd']) and empty($f2['ccity']) and empty($f2['cpost']) and empty($f2['cphone']));	
			$f2['addr_check']	= (($f2['cadd'] == $f2['padd']) and ($f2['ccity'] == $f2['pcity']) and ($f2['cpost'] == $f2['ppost']) and ($f2['cphone'] == $f2['pphone']));
			$f2['marital_status'] = $a->marital_status;
			$f2['marriagedate'] = !empty($a->marital_date) ? date('d-m-Y', strtotime($a->marital_date)) : '';
			$f2['spousename']	= $a->spouse_name;
			$f2['spousedob']	= !empty($a->spouse_dob) ? date('d-m-Y', strtotime($a->spouse_dob)) : '';
			$f2['spouseocc']	= $a->spouse_occupation;
			$f2['spouseedu']	= $a->spouse_edu;
			
			$f3_eng['cert']		= $a->candidat_eng_cert;
			$f3_eng['score']	= $a->candidat_eng_score;
			$f3_eng['year']		= $a->candidat_eng_year;
			
			$f6['hobby']		= $a->candidat_hobby;			
			$f8['describe']		= $a->candidat_describe;
			$f8['salary']		= !empty($a->expect_salary) ? $a->expect_salary : '';

			$panelColor[1] 		= (!empty($f1['cv']) and !empty($f1['photo'])) ? $p_fill : $p_empty;
			$panelColor[2]		= !empty($f2['name']) ? $p_fill : $p_empty;
			$panelColor[8] 		= !empty($f8['describe']) ? $p_fill : $p_empty;
		}
	}
	
	# LOAD F3 - EDUCATION
	$univ_array = [];
	if ($university != '0') { 
		$univ_array[] = 'Other';
		foreach ($university as $u) {
			xss_filter($u);
			$univ_array[] = $u->university_name;
		}
	}
	if ($applicant_edu != '0') {
		foreach ($applicant_edu as $edu) { 
			xss_filter($edu);
			$f3[$edu->edu_title]['edu_id'] 			= $edu->cedu_id;
			$f3[$edu->edu_title]['edu_institute'] 	= $edu->edu_institute;
			$f3[$edu->edu_title]['edu_other'] 		= !in_array($edu->edu_institute, $univ_array);
			$f3[$edu->edu_title]['edu_major'] 		= $edu->edu_major;
			$f3[$edu->edu_title]['edu_start'] 		= !empty($edu->edu_start) ? date('m/Y', strtotime($edu->edu_start)) : '';
			$f3[$edu->edu_title]['edu_end'] 		= !empty($edu->edu_end) ? date('m/Y', strtotime($edu->edu_end)) : '';
			$f3[$edu->edu_title]['gpa'] 			= ($edu->gpa != '0') ? $edu->gpa : '';			
		}
		$panelColor[3] = $p_fill;
	}
	if ($applicant_inf_edu != '0') {
		foreach ($applicant_inf_edu as $key => $edu) { 
			xss_filter($edu);
			$f3_inf[$key]['inf_edu_id'] 	= $edu->inf_edu_id;
			$f3_inf[$key]['inf_edu_name'] 	= $edu->inf_edu_name;
			$f3_inf[$key]['inf_edu_cert'] 	= $edu->inf_edu_cert;
			$f3_inf[$key]['inf_edu_year'] 	= $edu->inf_edu_year;	
		}
	}
	if ($applicant_lang != '0') {
		foreach ($applicant_lang as $key => $edu) { 
			xss_filter($edu);
			$f3_lang[$key]['lang_id'] 		= $edu->clang_id;
			$f3_lang[$key]['lang_name'] 	= $edu->lang_name;
			$f3_lang[$key]['lang_spoken'] 	= $edu->cap_spoken;
			$f3_lang[$key]['lang_written'] 	= $edu->cap_written;	
		}
	}
	
	# LOAD F4 - FAMILY & CHILDREN
	if ($applicant_family != '0') {
		foreach ($applicant_family as $key => $fam) { 
			xss_filter($fam);
			$f4_fam[$key]['family_id'] 			= $fam->family_id;
			$f4_fam[$key]['family_name'] 		= $fam->family_name;
			$f4_fam[$key]['family_relation']	= $fam->family_relation;
			$f4_fam[$key]['family_dob'] 		= !empty($fam->family_dob) ? date('d-m-Y', strtotime($fam->family_dob)) : '';
			$f4_fam[$key]['family_gender'] 		= $fam->family_gender;
			$f4_fam[$key]['family_edu'] 		= $fam->family_edu;	
		}
		$panelColor[4] = $p_fill;
	}
	if ($applicant_children != '0') {
		foreach ($applicant_children as $key => $child) { 
			xss_filter($child);
			$f4_child[$key]['child_id'] 		= $child->child_id;
			$f4_child[$key]['child_name'] 		= $child->child_name;
			$f4_child[$key]['child_dob'] 		= !empty($child->child_dob) ? date('d-m-Y', strtotime($child->child_dob)) : '';
			$f4_child[$key]['child_gender'] 	= $child->child_gender;
			$f4_child[$key]['child_edu'] 		= $child->child_edu;	
		}
		$panelColor[4] = $p_fill;
	}
	
	# LOAD F5 - EMPLOYMENT
	if ($applicant_employment != '0') {
		foreach ($applicant_employment as $emp) { 
			xss_filter($emp);
		}
		$panelColor[5] = $p_fill;
	}
	
	# LOAD F6 - ORGANIZATIONAL
	if ($applicant_organization != '0') {
		foreach ($applicant_organization as $key => $org) { 
			xss_filter($org);
			$f6_org[$key]['org_id'] 		= $org->org_id;
			$f6_org[$key]['org_name'] 		= $org->activities;
			$f6_org[$key]['org_type']		= $org->type_of_org;
			$f6_org[$key]['org_year_start'] = $org->org_year_start;
			$f6_org[$key]['org_year_end'] 	= $org->org_year_end;
			$f6_org[$key]['org_post'] 		= $org->org_pos;
		}
		$panelColor[6] = $p_fill;
	}
	if ($applicant_achivement != '0') {
		foreach ($applicant_achivement as $key => $ach) { 
			xss_filter($ach);
			$f6_ach[$key]['ach_id'] 	= $ach->achievement_id;
			$f6_ach[$key]['ach_title'] 	= $ach->achievement_title;
			$f6_ach[$key]['ach_org']	= $ach->achievement_org;
			$f6_ach[$key]['ach_year'] 	= $ach->achievement_year;
		}
		$panelColor[6] = $p_fill;
	}
	
	# LOAD F7 - REFERENCES
	if ($applicant_reference != '0') {
		foreach ($applicant_reference as $key => $ref) { 
			xss_filter($ref);
			$f7[$key]['ref_id'] 		= $ref->cref_id;
			$f7[$key]['ref_name'] 		= $ref->cref_name;
			$f7[$key]['ref_relation']	= $ref->cref_rel;
			$f7[$key]['ref_address'] 	= $ref->cref_addr;
			$f7[$key]['ref_occupation'] = $ref->cref_occu;
			$f7[$key]['ref_year'] 		= $ref->cref_years;	
		}
		$panelColor[7] = $p_fill;
	}
?>
	<div class="col-xs-12 col-md-12 pull-right">
		<div class="card" id="fc_applicant">
			<div class="header bg-black" style="background-color:#555 !important;">
				<h2 class="strong">APPLICATION FORM</h2>
			</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-md-12">
						<div class="strong">Please complete all the required information in this application form.</div>				
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-12">
						<div class="panel-group" id="applicant_form" role="tablist" aria-multiselectable="true">
							<!-- FORM 1 - CV & PHOTO -->
							<div class="panel <?=ist($panelColor[1], $p_empty)?>">
								<div class="panel-heading" role="tab" id="f1_heading">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#applicant_form" href="#f1_upload" aria-expanded="true" aria-controls="f1_upload">
											<i class="material-icons">cloud_upload</i> 1. Upload CV &amp; Latest Photo <!--span class="col-orange">*</span-->
											<?php if ($panelColor[1] == $p_fill) echo "<i class='material-icons pull-right'>done</i>" ?>
										</a>
									</h4>
								</div>
								<div id="f1_upload" class="panel-collapse collapse" role="tabpanel" aria-labelledby="f1_heading">
									<div class="panel-body">
										<?php echo form_open('', ['id' => 'frm_f1', 'class' => 'frm_applicant'])?>
										<div class="row clearfix">
											<div class="col-md-6">
												<div class="dropzone" id="dz_cv">
													<div class="dz-message" style="margin:0">
														<div class="drag-icon-cph">
															<i class="material-icons <?=empty($f1['cv']) ? "" : "col-teal"?>"><?=empty($f1['cv']) ? "cloud_upload" : "picture_as_pdf" ?></i>
														</div>
														<div class="m-t-10">Drop your <strong>CV</strong> here or <strong>click</strong> to upload.</div>
														<div class="m-t-10"><em>Allowed file type : doc, docx, pdf (max. 200 Kb)</em></div>
														<div class="m-t-10">
															<?=empty($f1['cv']) ? "<span class='badge bg-grey'>STATUS : INCOMPLETE</span>" : "<span class='badge bg-teal'>STATUS : COMPLETE</span>" ?>
														</div>
													</div>
													<div>
													</div>
													<div class="fallback">
														<input name="fc_drop_cv" type="file" required>
													</div>
												</div>
												<?php if (!empty($f1['cv'])) { ?>
												<div class="text-center m-t-10">
													<button class="btn bg-orange waves-effect" data-type="f1_remove" data-file="cv" type="button">Remove File</button>
												</div>
												<?php } ?>
											</div>
											<div class="col-md-6">
												<div class="dropzone" id="dz_photo">
													<div class="dz-message" style="margin:0">
														<div class="drag-icon-cph">
															<?php 
																if (!empty($f1['photo'])) {
																	echo "<img class='' height='85' src='".base_url("media/candidate/{$f1['photo']}")."'>";
																} 
																else { 
																	echo "<i class='material-icons'>cloud_upload</i>";
																} 
															?>
														</div>
														<div class="m-t-10">Drop your <strong>Latest Photo</strong> here or <strong>click</strong> to upload.</div>
														<div class="m-t-10"><em>Allowed file type : jpg, png (max. 200 Kb)</em></div>
														<div class="m-t-10">
															<?=empty($f1['photo']) ? "<span class='badge bg-grey'>STATUS : INCOMPLETE</span>" : "<span class='badge bg-teal'>STATUS : COMPLETE</span>" ?>
														</div>
													</div>
													<div class="fallback">
														<input name="fc_drop_photo" type="file" required>
													</div>
												</div>
												<?php if (!empty($f1['photo'])) { ?>
												<div class="text-center m-t-10">
													<button class="btn bg-orange waves-effect" data-type="f1_remove" data-file="photo" type="button">Remove File</button>
												</div>
												<?php } ?>
											</div>
											<div class="col-md-12 text-center">
												<button class="btn btn-lg bg-indigo waves-effect" data-type="f1" type="button">Save Changes</button>
											</div>
										</div>
										<?php echo form_close()?>
									</div>
								</div>
							</div>
							<!-- FORM 2 - PERSONAL INFORMATION -->
							<div class="panel <?=ist($panelColor[2], $p_empty)?>">
								<div class="panel-heading" role="tab" id="f2_heading">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#applicant_form" href="#f2_personal" aria-expanded="true" aria-controls="f2_personal">
											<i class="material-icons">perm_contact_calendar</i> 2. Personal Information <span class="col-orange">*</span>
											<?php if ($panelColor[2] == $p_fill) echo "<i class='material-icons pull-right'>done</i>" ?>
										</a>
									</h4>
								</div>
								<div id="f2_personal" class="panel-collapse collapse" role="tabpanel" aria-labelledby="f2_heading">
									<div class="panel-body">
										<?php echo form_open('', ['id' => 'frm_f2', 'class' => 'frm_applicant'])?>
										<div class="row clearfix">
											<div class="col-md-12">
												<div class="form-group form-float" style="margin-top:10px">
													<div class="form-line">
														<input type="text" class="form-control" name="f2[name]" value="<?=ist($f2['name'])?>" required>
														<label class="form-label">Fullname</label>
													</div>
												</div>
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="f2[idno]" value="<?=ist($f2['idno'])?>" required>
														<label class="form-label">ID Number <small>(KTP)</small></label>
													</div>
												</div>						
												<div class="row clearfix">
													<div class="col-sm-4" style="margin-bottom:10px;">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[pob]" value="<?=ist($f2['pob'])?>" required>
																<label class="form-label">Place of Birth</label>
															</div>
														</div>
													</div>
													<div class="col-sm-8" style="margin-bottom:10px;">
														<div class="form-group">
															<div class="form-line">
																<input type="text" class="form-control date-picker" placeholder="Date of Birth" name="f2[dob]" required value="<?=ist($f2['dob'])?>">
																<!--label class="form-label">Date of Birth</label-->
															</div>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-sm-4" style="margin-bottom:0">
														<label style="margin-right:20px">Gender</label>
													</div>
													<div class="col-sm-8" style="margin-bottom:0">
														<div class="form-group">
															<input type="radio" name="f2[gender]" id="male" value="M" class="with-gap radio-col-orange" required <?=(ist($f2['gender']) == 'M') ? 'checked' : ''?>>
															<label for="male">Male</label>
															<input type="radio" name="f2[gender]" id="female" value="F" class="with-gap radio-col-orange" <?=(ist($f2['gender']) == 'F') ? 'checked' : ''?>>
															<label for="female" class="m-l-20">Female</label>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-sm-4" style="margin-bottom:0">
														<label style="margin-right:20px">Nationality</label>
													</div>
													<div class="col-sm-8" style="margin-bottom:0">
														<div class="form-group">
															<input type="radio" name="f2[nat]" id="wni" value="WNI" class="with-gap radio-col-orange" required <?=(ist($f2['nat']) == 'WNI') ? 'checked' : ''?>>
															<label for="wni">WNI</label>
															<input type="radio" name="f2[nat]" id="wna" value="WNA" class="with-gap radio-col-orange" <?=(ist($f2['nat']) == 'WNA') ? 'checked' : ''?>>
															<label for="wna" class="m-l-20">WNA</label>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-sm-4" style="margin-bottom:0">
														<label style="margin-right:20px">Blood Type</label>
													</div>
													<div class="col-sm-8" style="margin-bottom:0">
														<div class="form-group">
															<input type="radio" name="f2[blood]" id="blood_a" value="A" class="with-gap radio-col-orange" required <?=(ist($f2['blood']) == 'A') ? 'checked' : ''?>>
															<label for="blood_a">A</label>
															<input type="radio" name="f2[blood]" id="blood_b" value="B" class="with-gap radio-col-orange" <?=(ist($f2['blood']) == 'B') ? 'checked' : ''?>>
															<label for="blood_b" class="m-l-20">B</label>
															<input type="radio" name="f2[blood]" id="blood_ab" value="AB" class="with-gap radio-col-orange" <?=(ist($f2['blood']) == 'AB') ? 'checked' : ''?>>
															<label for="blood_ab" class="m-l-20">AB</label>
															<input type="radio" name="f2[blood]" id="blood_o" value="O" class="with-gap radio-col-orange" <?=(ist($f2['blood']) == 'O') ? 'checked' : ''?>>
															<label for="blood_o" class="m-l-20">O</label>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-sm-4">
														<label style="">Religion</label>
													</div>
													<div class="col-sm-8">
														<div class="form-group">
															<select class="form-control show-tick" name="f2[religi]" data-container="body" required>
																<option value="">- Choose -</option>
																<option value="I" <?=(ist($f2['religi']) == 'I') ? 'selected' : ''?>>Islam</option>
																<option value="P" <?=(ist($f2['religi']) == 'P') ? 'selected' : ''?>>Kristen Protestan</option>
																<option value="K" <?=(ist($f2['religi']) == 'K') ? 'selected' : ''?>>Kristen Katolik</option>
																<option value="H" <?=(ist($f2['religi']) == 'H') ? 'selected' : ''?>>Hindu</option>
																<option value="B" <?=(ist($f2['religi']) == 'B') ? 'selected' : ''?>>Budha</option>
																<option value="O" <?=(ist($f2['religi']) == 'O') ? 'selected' : ''?>>Other</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-sm-6" style="margin-bottom:0">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="number" class="form-control" name="f2[height]" required value="<?=ist($f2['height'])?>">
																<label class="form-label">Height <small>(cm)</small></label>
															</div>
														</div>
													</div>
													<div class="col-sm-6" style="margin-bottom:0">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="number" class="form-control" name="f2[weight]" required value="<?=ist($f2['weight'])?>">
																<label class="form-label">Weight <small>(kg)</small></label>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group form-float" style="margin-top:10px">
													<div class="form-line">
														<input type="text" class="form-control" name="f2[cadd]" id="f2_cadd" value="<?=ist($f2['cadd'])?>" required>
														<label class="form-label">Current Address</label>
													</div>
												</div>						
												<div class="row clearfix">
													<div class="col-sm-4" style="margin-bottom:0px;">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[ccity]" id="f2_ccity" value="<?=ist($f2['ccity'])?>" required>
																<label class="form-label">City</label>
															</div>
														</div>
													</div>
													<div class="col-sm-4" style="margin-bottom:0px;">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[cpost]" id="f2_cpost" value="<?=ist($f2['cpost'])?>" required>
																<label class="form-label">Postal Code</label>
															</div>
														</div>
													</div>
													<div class="col-sm-4" style="margin-bottom:0px;">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[cphone]" id="f2_cphone" value="<?=ist($f2['cphone'])?>" required>
																<label class="form-label">Phone</label>
															</div>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-sm-12" style="margin-top:20px;margin-bottom:0px;">
														<div class="form-group">
														<?php if ($f2['addr_new']) { ?>
															<input type="checkbox" class="filled-in chk-col-orange" name="f2[checkaddress]" id="f2_checkaddress">
														<?php } else { ?>
															<input type="checkbox" class="filled-in chk-col-orange" name="f2[checkaddress]" id="f2_checkaddress" <?=$f2['addr_check'] ? 'checked' : ''?>>
														<?php } ?>
															<label for="f2_checkaddress">Permanent Address same as Current Address</label>
														</div>
													</div>
												</div>							
												<div class="form-group form-float">
													<div class="form-line">
														<input type="text" class="form-control" name="f2[padd]" id="f2_padd" value="<?=ist($f2['padd'])?>" required>
														<label class="form-label">Permanent Address</label>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-sm-4">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[pcity]" id="f2_pcity" value="<?=ist($f2['pcity'])?>" required>
																<label class="form-label">City</label>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[ppost]" id="f2_ppost" value="<?=ist($f2['ppost'])?>" required>
																<label class="form-label">Postal Code</label>
															</div>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[pphone]" id="f2_pphone" value="<?=ist($f2['pphone'])?>" required>
																<label class="form-label">Phone</label>
															</div>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-sm-4">
														<label class="form-label">Marital Status</label>
													</div>
													<div class="col-sm-8">
														<div class="form-group" style="margin-bottom:0;">
															<input type="radio" name="f2[marital_status]" id="f2_single" value="Single" class="with-gap" <?=($f2['marital_status'] != 'Married') ? 'checked' : ''?>>
															<label for="f2_single" class="m-r-30">Single</label>
															<input type="radio" name="f2[marital_status]" id="f2_married" value="Married" class="with-gap" <?=($f2['marital_status'] != 'Married') ? '' : 'checked'?>>
															<label for="f2_married" class="m-r-30">Married</label>
														</div>
													</div>
												</div>
												<div class="row clearfix for-f2-married <?=($f2['marital_status'] != 'Married') ? 'collapse' : ''?>">
													<div class="col-sm-4">
														<label class="form-label">Date Of Marriage</label>
													</div>
													<div class="col-sm-8">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control date-picker" name="f2[marriagedate]" value="<?=ist($f2['marriagedate'])?>" placeholder="DD-MM-YYYY">
																<label class="form-label"></label>
															</div>
														</div>
													</div>
												</div>
												<div class="row clearfix for-f2-married <?=($f2['marital_status'] != 'Married') ? 'collapse' : ''?>">
													<div class="col-md-6">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[spousename]" placeholder="" value="<?=ist($f2['spousename'])?>">
																<label class="form-label">Spouse Name</label>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="form-line">
																<input type="text" class="form-control date-picker" name="f2[spousedob]" placeholder="Spouse DOB" value="<?=ist($f2['spousedob'])?>">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-float">
															<div class="form-line">
																<input type="text" class="form-control" name="f2[spouseocc]" placeholder="" value="<?=ist($f2['spouseocc'])?>"><label class="form-label">Spouse Occupation</label>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<select class="form-control show-tick" name="f2[spouseedu]" data-container="body">
															<option value="">- Spouse Education -</option>
															<option value="SMU" <?=(ist($f2['spouseedu']) == 'SMU') ? 'selected' : ''?>>High School</option>
															<option value="D3" <?=(ist($f2['spouseedu']) == 'D3') ? 'selected' : ''?>>Diploma (D3)</option>
															<option value="S1" <?=(ist($f2['spouseedu']) == 'S1') ? 'selected' : ''?>>Bachelor (S1)</option>
															<option value="S2" <?=(ist($f2['spouseedu']) == 'S2') ? 'selected' : ''?>>Master (S2)</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-12 m-t-10 text-center">
												<button class="btn btn-lg bg-indigo waves-effect" data-type="fx" type="button">Save Changes</button>
											</div>
										</div>
										<?php echo form_close()?>
									</div>
								</div>
							</div>
							<!-- FORM 3 - EDUCATION -->
							<div class="panel <?=ist($panelColor[3], $p_empty)?>">
								<div class="panel-heading" role="tab" id="f3_heading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#applicant_form" href="#f3_educational" aria-expanded="false" aria-controls="f3_educational">
											<i class="material-icons">local_library</i> 3. Educational Background <span class="col-orange">*</span>
											<?php if ($panelColor[3] == $p_fill) echo "<i class='material-icons pull-right'>done</i>" ?>
										</a>
									</h4>
								</div>
								<div id="f3_educational" class="panel-collapse collapse" role="tabpanel" aria-labelledby="f3_heading">
									<div class="panel-body">
										<?php echo form_open('', ['id' => 'frm_f3', 'class' => 'frm_applicant'])?>
										<div class="row clearfix">
											<div class="col-sm-12"><h3 style="display:inline-block;">Formal Education</h3> <span class="col-pink strong italic">(required one latest formal education)</span></div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Grade</th>
														<th>School / Institution</th>
														<th>Major</th>
														<th>Date (Month / Year)</th>
														<th>GPA</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$grade = ['S2', 'S1', 'D3', 'SMU'];
														$univ_counter = 0;
														foreach ($grade as $grd) {															
													?>
													<tr class="<?=$grd?>">
														<td class="text-center strong" style="width:5%;vertical-align:middle"><?=$grd?></td>
														<td style="width:35%">
															<input type="hidden" name="f3[<?=$univ_counter?>][grade]" value="<?=$grd?>">
															<input type="hidden" name="f3[<?=$univ_counter?>][edu_id]" value="<?=ist($f3[$grd]['edu_id'])?>">
															<?php if ($grd != 'SMU') { ?>
															<select class="form-control show-tick f3_university" id="" name="f3[<?=$univ_counter?>][university]" data-container="body" data-live-search="true" data-size="5">
																<option value="">- Choose -</option>
																<?php
																	if ($univ_array) {
																		foreach ($univ_array as $univ) {
																			if (ist($f3[$grd]['edu_other']) and ($univ == 'Other')) {
																				echo "<option selected value='{$univ}'>{$univ}</option>";
																			}
																			else if (ist($f3[$grd]['edu_institute']) == $univ) {
																				echo "<option selected value='{$univ}'>{$univ}</option>";
																			}
																			else {
																				echo "<option value='{$univ}'>{$univ}</option>";
																			}
																		}
																	}
																?>															
															</select>
															<div class="form-group <?=ist($f3[$grd]['edu_other']) ? '' : 'collapse'?> for-f3-univ m-t-15 m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f3[<?=$univ_counter?>][univother]" placeholder="Type here.." value="<?=ist($f3[$grd]['edu_other']) ? ist($f3[$grd]['edu_institute']): ''?>">
																</div>
															</div>
															<?php } else { ?>
															<select class="form-control ms collapse" name="f3[<?=$univ_counter?>][university]" data-container="body" data-live-search="true">
																<option value="">- Choose -</option>
															</select>
															<div class="form-group for-f3-univ m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f3[<?=$univ_counter?>][univother]" placeholder="Type here.." value="<?=ist($f3[$grd]['edu_institute'])?>">
																</div>
															</div>
															<?php } ?>
														</td>
														<td style="width:25%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f3[<?=$univ_counter?>][major]" value="<?=ist($f3[$grd]['edu_major'])?>">
																</div>
															</div>
														</td>
														<td style="width:25%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<div class="input-daterange input-group month-picker" id="" style="margin-bottom:4px">
																		<input type="text" class="input-sm form-control" name="f3[<?=$univ_counter?>][date_start]" value="<?=ist($f3[$grd]['edu_start'])?>"/>
																		<span class="input-group-addon">to</span>
																		<input type="text" class="input-sm form-control" name="f3[<?=$univ_counter?>][date_end]" value="<?=ist($f3[$grd]['edu_end'])?>"/>
																	</div>
																</div>
															</div>
														</td>
														<td style="width:10%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="number" class="form-control" name="f3[<?=$univ_counter?>][gpa]" value="<?=ist($f3[$grd]['gpa'])?>">
																</div>
															</div>
														</td>
													</tr>
													<?php 															
															$univ_counter++;
														} 
													?>
												</tbody>
											</table>
										</div>
										<div class="row clearfix">
											<div class="col-sm-12"><h3>Informal Education</h3></div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Name</th>
														<th>Certification/Proficiency</th>
														<th>Year</th>
													</tr>
												</thead>
												<tbody>
													<?php
														for ($i = 0; $i < 3; $i++) {
													?>
													<tr class="">
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f3_inf[<?=$i?>][name]" value="<?=ist($f3_inf[$i]['inf_edu_name'])?>">
																	<input type="hidden" name="f3_inf[<?=$i?>][inf_edu_id]" value="<?=ist($f3_inf[$i]['inf_edu_id'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f3_inf[<?=$i?>][cert]" value="<?=ist($f3_inf[$i]['inf_edu_cert'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control year-picker" name="f3_inf[<?=$i?>][year]" value="<?=ist($f3_inf[$i]['inf_edu_year'])?>">
																</div>
															</div>
														</td>
													</tr>
													<?php 
														} 
													?>
												</tbody>
											</table>
										</div>
										<div class="row clearfix">
											<div class="col-sm-12"><h3>Foreign Language Skills</h3></div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Language</th>
														<th>Spoken</th>
														<th>Written</th>
													</tr>
													<tr>
													</tr>
												</thead>
												<tbody>
													<?php
														for ($i = 0; $i < 3; $i++) {
													?>
													<tr>
														<td style="width:34%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f3_lang[<?=$i?>][name]" value="<?=ist($f3_lang[$i]['lang_name'])?>">
																	<input type="hidden" name="f3_lang[<?=$i?>][lang_id]" value="<?=ist($f3_lang[$i]['lang_id'])?>">
																</div>
															</div>
														</td>
														<td style="width:33%">
															<select class="form-control show-tick" name="f3_lang[<?=$i?>][spoken]" data-container="body">
																<option value="Basic" <?=(ist($f3_lang[$i]['lang_spoken']) == 'Basic') ? 'selected' : ''?>>Basic</option>
																<option value="Intermediate" <?=(ist($f3_lang[$i]['lang_spoken']) == '"Intermediate"') ? 'selected' : ''?>>Intermediate</option>
																<option value="Advanced" <?=(ist($f3_lang[$i]['lang_spoken']) == 'Advanced') ? 'selected' : ''?>>Advanced</option>									
															</select>
														</td>
														<td style="width:33%">
															<select class="form-control show-tick" name="f3_lang[<?=$i?>][written]" data-container="body">
																<option value="Basic" <?=(ist($f3_lang[$i]['lang_written']) == 'Basic') ? 'selected' : ''?>>Basic</option>
																<option value="Intermediate" <?=(ist($f3_lang[$i]['lang_written']) == 'Intermediate') ? 'selected' : ''?>>Intermediate</option>
																<option value="Advanced" <?=(ist($f3_lang[$i]['lang_written']) == 'Advanced') ? 'selected' : ''?>>Advanced</option>									
															</select>
														</td>
													</tr>
													<?php 
														} 
													?>
												</tbody>
											</table>
										</div>
										<div class="row clearfix">
											<div class="col-sm-4">
												<label for="f5_company">English Certification</label>
												<select class="form-control show-tick" name="f3_eng[name]" data-container="body">
													<option value="TOEFL" <?=(ist($f3_eng['cert']) == '"TOEFL"') ? 'selected' : ''?>>TOEFL</option>
													<option value="TOEIC" <?=(ist($f3_eng['cert']) == '"TOEIC"') ? 'selected' : ''?>>TOEIC</option>
													<option value="IELTS" <?=(ist($f3_eng['cert']) == '"IELTS"') ? 'selected' : ''?>>IELTS</option>								
												</select>
											</div>
											<div class="col-sm-4">
												<label for="f5_company">Score</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f3_eng[score]" class="form-control" value="<?=ist($f3_eng['score'])?>">
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<label for="f5_company">Year</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f3_eng[year]" class="form-control year-picker" value="<?=ist($f3_eng['year'])?>">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12 m-t-10 text-center">
											<button class="btn btn-lg bg-indigo waves-effect" data-type="fx" type="button">Save Changes</button>
										</div>
										<?php echo form_close()?>
									</div>
								</div>
							</div>
							<!-- FORM 4 - FAMILY -->
							<div class="panel <?=ist($panelColor[4], $p_empty)?>">
								<div class="panel-heading" role="tab" id="f4_heading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#applicant_form" href="#f4_family" aria-expanded="false" aria-controls="f4_family">
											<i class="material-icons">people</i> 4. Family Information
											<?php if ($panelColor[4] == $p_fill) echo "<i class='material-icons pull-right'>done</i>" ?>
										</a>
									</h4>
								</div>
								<div id="f4_family" class="panel-collapse collapse" role="tabpanel" aria-labelledby="f4_heading">
									<div class="panel-body">
										<?php echo form_open('', ['id' => 'frm_f4', 'class' => 'frm_applicant'])?>
										<div class="row clearfix">
											<div class="col-sm-12"><h3>Family</h3></div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Name</th>
														<th>Relationship</th>
														<th>Gender</th>
														<th>DOB</th>
														<th>Education</th>
													</tr>
												</thead>
												<tbody>
													<?php
														for ($i = 0; $i < 5; $i++) {
													?>
													<tr class="">
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f4_fam[<?=$i?>][name]" value="<?=ist($f4_fam[$i]['family_name'])?>">
																	<input type="hidden" name="f4_fam[<?=$i?>][family_id]" value="<?=ist($f4_fam[$i]['family_id'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<select class="form-control show-tick" name="f4_fam[<?=$i?>][relation]" data-container="body">
																<option value="">- Choose -</option>
																<option value="PARENT" <?=(ist($f4_fam[$i]['family_relation']) == 'PARENT') ? 'selected' : ''?>>Parent</option>
																<option value="SIBLING" <?=(ist($f4_fam[$i]['family_relation']) == 'SIBLING') ? 'selected' : ''?>>Sibling</option>
															</select>
														</td>
														<td style="width:20%">
															<select class="form-control show-tick" name="f4_fam[<?=$i?>][gender]" data-container="body">
																<option value="">- Choose -</option>
																<option value="M" <?=(ist($f4_fam[$i]['family_gender']) == 'M') ? 'selected' : ''?>>Male</option>
																<option value="F" <?=(ist($f4_fam[$i]['family_gender']) == 'F') ? 'selected' : ''?>>Female</option>									
															</select>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control date-picker" name="f4_fam[<?=$i?>][dob]" value="<?=ist($f4_fam[$i]['family_dob'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<select class="form-control show-tick" name="f4_fam[<?=$i?>][education]" data-container="body">
																<option value="">- Choose -</option>
																<option value="S2" <?=(ist($f4_fam[$i]['family_edu']) == 'S2') ? 'selected' : ''?>>S2</option>
																<option value="S1" <?=(ist($f4_fam[$i]['family_edu']) == 'S1') ? 'selected' : ''?>>S1</option>									
																<option value="D3" <?=(ist($f4_fam[$i]['family_edu']) == 'D3') ? 'selected' : ''?>>D3</option>									
																<option value="SMU" <?=(ist($f4_fam[$i]['family_edu']) == 'SMU') ? 'selected' : ''?>>SMU</option>									
															</select>
														</td>
													</tr>
													<?php 
														} 
													?>
												</tbody>
											</table>
										</div>
										<div class="row clearfix">
											<div class="col-sm-12"><h3>Children</h3></div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Name</th>
														<th>Gender</th>
														<th>DOB</th>
														<th>Education</th>
													</tr>
												</thead>
												<tbody>
													<?php
														for ($i = 0; $i < 3; $i++) {
													?>
													<tr class="">
														<td style="width:25%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f4_child[<?=$i?>][name]" value="<?=ist($f4_child[$i]['child_name'])?>">
																	<input type="hidden" name="f4_child[<?=$i?>][child_id]" value="<?=ist($f4_child[$i]['child_id'])?>">
																</div>
															</div>
														</td>
														<td style="width:25%">
															<select class="form-control show-tick" name="f4_child[<?=$i?>][gender]" data-container="body">
																<option value="">- Choose -</option>
																<option value="M" <?=(ist($f4_child[$i]['child_gender']) == 'M') ? 'selected' : ''?>>Male</option>
																<option value="F" <?=(ist($f4_child[$i]['child_gender']) == 'F') ? 'selected' : ''?>>Female</option>									
															</select>
														</td>
														<td style="width:25%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control date-picker" name="f4_child[<?=$i?>][dob]" value="<?=ist($f4_child[$i]['child_dob'])?>">
																</div>
															</div>
														</td>
														<td style="width:25%">
															<select class="form-control show-tick" name="f4_child[<?=$i?>][education]" data-container="body">
																<option value="">- Choose -</option>
																<option value="S2" <?=(ist($f4_child[$i]['child_edu']) == 'S2') ? 'selected' : ''?>>S2</option>
																<option value="S1" <?=(ist($f4_child[$i]['child_edu']) == 'S1') ? 'selected' : ''?>>S1</option>									
																<option value="D3" <?=(ist($f4_child[$i]['child_edu']) == 'D3') ? 'selected' : ''?>>D3</option>									
																<option value="SMU" <?=(ist($f4_child[$i]['child_edu']) == 'SMU') ? 'selected' : ''?>>SMU</option>									
															</select>
														</td>
													</tr>
													<?php 
														} 
													?>
												</tbody>
											</table>
										</div>
										<div class="col-md-12 m-t-10 text-center">
											<button class="btn btn-lg bg-indigo waves-effect" data-type="fx" type="button">Save Changes</button>
										</div>
										<?php echo form_close()?>
									</div>
								</div>
							</div>
							<!-- FORM 5 - EMPLOYMENT -->
							<div class="panel <?=ist($panelColor[5], $p_empty)?>">
								<div class="panel-heading" role="tab" id="f5_heading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#applicant_form" href="#f5_employment" aria-expanded="false" aria-controls="f5_employment">
											<i class="material-icons">work</i> 5. Employment Background
											<?php if ($panelColor[5] == $p_fill) echo "<i class='material-icons pull-right'>done</i>" ?>
										</a>
									</h4>
								</div>
								<div id="f5_employment" class="panel-collapse collapse" role="tabpanel" aria-labelledby="f5_heading">
									<div class="panel-body">
										<div class="row clearfix m-b-10">
											<div class="col-sm-12 italic">Employment history for the last 10 years. <span class="strong">Please insert the most recent first</strong>.</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-12">
												<?php
													if ($applicant_employment != '0') {
														$counter = 1;
												?>
												<div class="panel-group" id="accordion_1984" role="tablist" aria-multiselectable="true">
												<?php 
														foreach ($applicant_employment as $emp) {
															$emp_start = !empty($emp->work_exp_from) ? date('m/Y', strtotime($emp->work_exp_from)) : '';
															$emp_end = !empty($emp->work_exp_to) ? date('m/Y', strtotime($emp->work_exp_to)) : '';
												?>
													<div class="panel panel-col-teal">
														<div class="panel-heading" role="tab" id="headingOne1_<?=$counter?>">
															<h4 class="panel-title">
																<a role="button" data-toggle="collapse" data-parent="#accordion_1984" href="#collapseOne1_<?=$counter?>" aria-expanded="true" aria-controls="collapseOne1_<?=$counter?>">
																	<?='#'.$counter.' - '.$emp->company_name?>
																</a>
															</h4>
														</div>
														<div id="collapseOne1_<?=$counter?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne1_<?=$counter?>">
															<div class="panel-body">
																<div class="row clearfix">
																	<div class="col-md-4">
																		<label for="f5_company">Company Name</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="f5_edit[<?=$counter?>][company]" class="form-control" required value="<?=$emp->company_name?>">
																			</div>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<label for="f5_date">Date (Month / Year)</label>
																		<div class="form-group">
																			<div class="form-line">
																				<div class="input-daterange input-group month-picker" id="" style="margin-bottom:4px">
																					<input type="text" class="input-sm form-control" name="f5_edit[<?=$counter?>][date_start]" required value="<?=$emp_start?>"/>
																					<span class="input-group-addon">to</span>
																					<input type="text" class="input-sm form-control" name="f5_edit[<?=$counter?>][date_end]" value="<?=$emp_end?>"/>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-4">
																		<label for="f5_title">Title</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="f5_edit[<?=$counter?>][title]" class="form-control" required value="<?=$emp->work_exp_title?>">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row clearfix">
																	<div class="col-md-4">
																		<label for="f5_report">Report To</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="f5_edit[<?=$counter?>][report_to]" class="form-control" required value="<?=$emp->report_to?>">
																			</div>
																		</div>
																	</div>
																	<div class="col-md-8">
																		<label for="f5_description">Job Description</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="f5_edit[<?=$counter?>][job_desc]" class="form-control" required value="<?=$emp->job_desc?>">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row clearfix">
																	<div class="col-md-4">
																		<label for="f5_salary">Last Salary (IDR)</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="f5_edit[<?=$counter?>][salary]" class="form-control currency" required value="<?=$emp->last_salary?>">
																			</div>
																		</div>
																	</div>
																	<div class="col-md-8">
																		<label for="f5_reason">Reason For Leaving</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="f5_edit[<?=$counter?>][reason_leave]" class="form-control" required value="<?=$emp->reason_leaving?>">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row clearfix">
																	<div class="col-md-4">
																		<label for="f5_edit_may_contact">May we contact this current/previous employer?</label>
																		<div class="form-group m-t-10">
																			<input type="radio" name="f5_edit[<?=$counter?>][may_contact]" value="Y" id="f5_<?=$counter?>_yes" class="with-gap" <?=($emp->may_contact == 'Y') ? 'checked' : ''?>>
																			<label for="f5_<?=$counter?>_yes">Yes</label>
																			<input type="radio" name="f5_edit[<?=$counter?>][may_contact]" value="N" id="f5_<?=$counter?>_no" class="with-gap" <?=($emp->may_contact == 'N') ? 'checked' : ''?>>
																			<label for="f5_<?=$counter?>_no" class="m-l-20">No</label>
																		</div>
																	</div>
																	<div class="col-md-8">
																		<label for="f5_reason_contact">If not, please explain why.<br>If yes, please provide name and contact number.</label>
																		<div class="form-group">
																			<div class="form-line">
																				<input type="text" name="f5_edit[<?=$counter?>][reason_contact]" class="form-control" required value="<?=$emp->reason_deny?>">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row clearfix">
																	<div class="col-md-12 text-center">
																		<!--button class="btn btn-lg bg-indigo waves-effect m-r-20" data-type="f5" data-action="update" data-title="<?=$emp->company_name?>" data-emp-id="<?=$emp->work_exp_id?>" type="button">Update</button-->
																		<button class="btn btn-lg bg-red waves-effect" data-type="f5" data-action="delete" data-title="<?=$emp->company_name?>" data-emp-id="<?=$emp->work_exp_id?>" type="button">Delete</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php 
														$counter++; 
													} 
												?>
												</div>
												<?php } ?>
											</div>
										</div>
										<?php echo form_open('', ['id' => 'frm_f5', 'class' => 'frm_applicant'])?>
										<div class="row clearfix">
											<div class="col-md-4">												
												<label for="f5_company">Company Name</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f5[company]" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<label for="f5_date">Date (Month / Year)</label>
												<div class="form-group">
													<div class="form-line">
														<div class="input-daterange input-group month-picker" id="" style="margin-bottom:4px">
															<input type="text" class="input-sm form-control" name="f5[date_start]" required/>
															<span class="input-group-addon">to</span>
															<input type="text" class="input-sm form-control" name="f5[date_end]" />
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<label for="f5_title">Title</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f5[title]" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-4">
												<label for="f5_report">Report To</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f5[report_to]" class="form-control" required>
													</div>
												</div>
											</div>
											<div class="col-md-8">
												<label for="f5_description">Job Description</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f5[job_desc]" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-4">
												<label for="f5_salary">Last Salary (IDR)</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f5[salary]" class="form-control currency" required>
													</div>
												</div>
											</div>
											<div class="col-md-8">
												<label for="f5_reason">Reason For Leaving</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f5[reason_leave]" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-4">
												<label for="f5_may_contact">May we contact this current/previous employer?</label>
												<div class="form-group m-t-10">
													<input type="radio" name="f5[may_contact]" value="Y" id="f5_yes" class="with-gap" checked>
													<label for="f5_yes">Yes</label>
													<input type="radio" name="f5[may_contact]" value="N" id="f5_no" class="with-gap">
													<label for="f5_no" class="m-l-20">No</label>
												</div>
											</div>
											<div class="col-md-8">
												<label for="f5_reason_contact">If not, please explain why.<br>If yes, please provide name and contact number.</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" name="f5[reason_contact]" class="form-control" required>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-md-12 m-t-10 text-center">
												<button class="btn btn-lg bg-indigo waves-effect" data-type="fx" type="button">Save Changes</button>
											</div>
										</div>
										<?php echo form_close()?>
									</div>
								</div>
							</div>
							<!-- FORM 6 - ORGANIZATION -->
							<div class="panel <?=ist($panelColor[6], $p_empty)?>">
								<div class="panel-heading" role="tab" id="f6_heading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#applicant_form" href="#f6_organizational" aria-expanded="false" aria-controls="f6_organizational">
											<i class="material-icons">folder_shared</i> 6. Organizational Experiences
											<?php if ($panelColor[6] == $p_fill) echo "<i class='material-icons pull-right'>done</i>" ?>
										</a>
									</h4>
								</div>
								<div id="f6_organizational" class="panel-collapse collapse" role="tabpanel" aria-labelledby="f6_heading">
									<div class="panel-body">
										<?php echo form_open('', ['id' => 'frm_f6', 'class' => 'frm_applicant'])?>
										<div class="row clearfix">
											<div class="col-sm-12"><h3>Organizational Experiences</h3></div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Name</th>
														<th>Type of Organization</th>
														<th>Year</th>
														<th>Position</th>
													</tr>
												</thead>
												<tbody>
													<?php
														for ($i = 0; $i < 3; $i++) {
													?>
													<tr class="">
														<td style="width:30%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f6_org[<?=$i?>][name]" value="<?=ist($f6_org[$i]['org_name'])?>">
																	<input type="hidden" class="form-control" name="f6_org[<?=$i?>][org_id]" value="<?=ist($f6_org[$i]['org_id'])?>">
																</div>
															</div>
														</td>
														<td style="width:30%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f6_org[<?=$i?>][type]" value="<?=ist($f6_org[$i]['org_type'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<div class="input-daterange input-group year-picker" id="" style="margin-bottom:4px">
																		<input type="text" class="input-sm form-control" name="f6_org[<?=$i?>][year_start]" value="<?=ist($f6_org[$i]['org_year_start'])?>"/>
																		<span class="input-group-addon">to</span>
																		<input type="text" class="input-sm form-control" name="f6_org[<?=$i?>][year_end]" value="<?=ist($f6_org[$i]['org_year_end'])?>"/>
																	</div>
																</div>
															</div>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f6_org[<?=$i?>][position]" value="<?=ist($f6_org[$i]['org_post'])?>">
																</div>
															</div>
														</td>
													</tr>
													<?php 
														} 
													?>
												</tbody>
											</table>
										</div>
										<div class="row clearfix">
											<div class="col-sm-12"><h3>Achievement</h3></div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Title / Type of achievement</th>
														<th>Organization</th>
														<th>Year</th>
													</tr>
												</thead>
												<tbody>
													<?php
														for ($i = 0; $i < 3; $i++) {
													?>
													<tr class="">
														<td style="width:35%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f6_ach[<?=$i?>][ach_title]" value="<?=ist($f6_ach[$i]['ach_title'])?>">
																	<input type="hidden" class="form-control" name="f6_ach[<?=$i?>][ach_id]" value="<?=ist($f6_ach[$i]['ach_id'])?>">
																</div>
															</div>
														</td>
														<td style="width:35%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f6_ach[<?=$i?>][ach_org]" value="<?=ist($f6_ach[$i]['ach_org'])?>">
																</div>
															</div>
														</td>
														<td style="width:30%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control year-picker" name="f6_ach[<?=$i?>][ach_year]" value="<?=ist($f6_ach[$i]['ach_year'])?>">
																</div>
															</div>
														</td>
													</tr>
													<?php 
														} 
													?>
												</tbody>
											</table>
										</div>
										<div class="row clearfix">
											<div class="col-sm-12">
												<h3>Other Activity</h3>
												<label for="f6_hobby">Hobby &amp; Interest</label>
												<div class="form-group">
													<div class="form-line">
														<textarea name="f6[hobby]" cols="30" rows="3" class="form-control no-resize"><?=ist($f6['hobby'])?></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12 m-t-10 text-center">
											<button class="btn btn-lg bg-indigo waves-effect" data-type="fx" type="button">Save Changes</button>
										</div>
										<?php echo form_close()?>
									</div>
								</div>
							</div>
							<!-- FORM 7 - REFERENCES -->
							<div class="panel <?=ist($panelColor[7], $p_empty)?>">
								<div class="panel-heading" role="tab" id="f7_heading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#applicant_form" href="#f7_references" aria-expanded="false" aria-controls="f7_references">
											<i class="material-icons">contact_phone</i> 7. References
											<?php if ($panelColor[7] == $p_fill) echo "<i class='material-icons pull-right'>done</i>" ?>
										</a>
									</h4>
								</div>
								<div id="f7_references" class="panel-collapse collapse" role="tabpanel" aria-labelledby="f7_heading">
									<div class="panel-body">
										<?php echo form_open('', ['id' => 'frm_f7', 'class' => 'frm_applicant'])?>
										<div class="row clearfix">
											<div class="col-sm-12 italic">Persons other than your employer(s) above, who are familiar with your character, background or work performance, who we may contact at any time, <strong>not including your relatives</strong>.</div>
										</div>
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Name</th>
														<th>Relationship</th>
														<th>Address</th>
														<th>Occupation/Position</th>
														<th>Years Known</th>
													</tr>
												</thead>
												<tbody>
													<?php
														for ($i = 0; $i < 3; $i++) {
													?>
													<tr class="">
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f7[<?=$i?>][name]" value="<?=ist($f7[$i]['ref_name'])?>">
																	<input type="hidden" class="form-control" name="f7[<?=$i?>][ref_id]" value="<?=ist($f7[$i]['ref_id'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f7[<?=$i?>][relation]" value="<?=ist($f7[$i]['ref_relation'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f7[<?=$i?>][address]" value="<?=ist($f7[$i]['ref_address'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="text" class="form-control" name="f7[<?=$i?>][position]" value="<?=ist($f7[$i]['ref_occupation'])?>">
																</div>
															</div>
														</td>
														<td style="width:20%">
															<div class="form-group m-b-0">
																<div class="form-line">
																	<input type="number" min="0" class="form-control" name="f7[<?=$i?>][year]" value="<?=ist($f7[$i]['ref_year'])?>">
																</div>
															</div>
														</td>
													</tr>
													<?php 
														} 
													?>
												</tbody>
											</table>
										</div>
										<div class="col-md-12 m-t-10 text-center">
											<button class="btn btn-lg bg-indigo waves-effect" data-type="fx" type="button">Save Changes</button>
										</div>
										<?php echo form_close()?>
									</div>
								</div>
							</div>
							<!-- FORM 8 - WHY WE SHOULD HIRE YOU -->
							<div class="panel <?=ist($panelColor[8], $p_empty)?>">
								<div class="panel-heading" role="tab" id="f8_heading">
									<h4 class="panel-title">
										<a class="collapsed" role="button" data-toggle="collapse" data-parent="#applicant_form" href="#f8_reason" aria-expanded="false" aria-controls="f8_reason">
											<i class="material-icons">help_outline</i> 8. Why we should hire you ? <span class="col-orange">*</span>
											<?php if ($panelColor[8] == $p_fill) echo "<i class='material-icons pull-right'>done</i>" ?>
										</a>
									</h4>
								</div>
								<div id="f8_reason" class="panel-collapse collapse" role="tabpanel" aria-labelledby="f8_heading">
									<div class="panel-body">
										<?php echo form_open('',['id' => 'frm_f8', 'class' => 'frm_applicant'])?>
										<div class="row clearfix">
											<div class="col-md-12">
												<label for="f8_describe">Describe yourself (strength, weakness, etc.) &amp; explain why we should hire you</label>
												<div class="form-group">
													<div class="form-line">
														<textarea id="f8_describe" name="f8[describe]" cols="30" rows="3" class="form-control no-resize" required><?=ist($f8['describe'])?></textarea>
													</div>
												</div>
												<label for="f8_salary">Expected Salary (IDR)</label>
												<div class="form-group">
													<div class="form-line">
														<input type="text" class="form-control currency" id="f8_salary" name="f8[salary]" value="<?=ist($f8['salary'])?>" required>
													</div>
												</div>
											</div>
											<div class="col-md-12 m-t-10 text-center">
												<button class="btn btn-lg bg-indigo waves-effect" data-type="fx" type="button">Save Changes</button>
											</div>
										</div>
										<?php echo form_close()?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="m-t-30">
							<div class="well text-center" style="border-radius:0;">
								<p class="strong"><em>I certify that all information provided on this application is true and complete to the best of my knowledge.</em></p><p class="strong m-b-0"><em>I understand that any false information or omission may lead to dismissal or discplinary action.</em></p>
							</div>
							<?php 
								if (isset($vacancy_detail) and $vacancy_detail != '0') {
									$vac_id = "";
									foreach ($vacancy_detail as $v) {
										xss_filter($v);
										$vac_title = $v->vacant_title;
										$vac_id = $v->vacant_id;
									}
							?>
							<hr>
							<div class="text-center m-t-30">
								<p class="m-b-20">Continue with applying vacancy : <strong><?=$vac_title?></strong></p>
								<button class="btn btn-lg bg-indigo waves-effect m-r-20" data-type="apply" data-vid="<?=$vac_id?>" type="button">Yes, I'm sure !</button><button class="btn btn-lg bg-red waves-effect" data-type="back" data-href="<?=base_url()?>" type="button">No, send me back !</button>
							</div>
							<?php 
								} 
								else {
							?>
							<hr>
							<div class="text-center m-t-30">
								<a class="btn btn-lg bg-indigo waves-effect" href="<?=base_url()?>">Vacancy List</a>
							</div>
							<?php 
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>