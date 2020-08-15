<?php if ( !defined('BASEPATH' ) )exit('No direct script access allowed');?>

<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/waves.min.css">
<link rel="stylesheet/less" href="<?php echo base_url(); ?>assets/css/main.less">

<?php require_once "header_apply_form.php"; ?>

<div class="bg_pattern pac60">
    <div class="frame">
        <div class="box_apply">
            <form role="form" action="#" id="tempCandForm" method="POST" enctype="multipart/form-data">
                <div>
                    <h3>Apply</h3>
                    <section>
                        <div class="card shadow">
                            <div class="col-md-4">
                                <?php
                                if (isset($applicant_data) and $applicant_data != 0) {
                                    foreach ($applicant_data as $row) {
                                        if ($row->candidat_foto != "") {
                                           ?>
                                           <img src="<?php echo base_url(); ?>/media/candidate/<?php echo $row->candidat_foto; ?>" class="img_avatar">
                                           <?php
                                       }
                                   }
                               } 
                               ?>
                           </div>
                           <div class="position">
                            <h3 class="text-right">Applied Position</h3>
                            <?php
                            if (isset($applicant_apply) and $applicant_apply != 0) {
                                foreach ($applicant_apply as $row) {
                                    ?>
                                    <ul>
                                        <li style="float: right;"><?php echo $row->a ?></li>
                                    </ul>
                                    <?php 
                                }
                            }else{
                                ?>
                                <h4 style="float: right;">Nothing Applied Before</h4>     
                                <?php 
                            } 
                            ?> 
                        </div>
                    </div>

                    <div class="tile">Apply</div>
                    <?php
                    if (isset($vacancy_detail)) {
                        foreach ($vacancy_detail as $row) {
                            ?>
                            <label for="position">Position *</label>
                            <select class="custom-select my_select" name="position">
                                <option value="">Choose Your Position</option>
                                <?php
                                if (isset($vacancy)) {
                                    foreach ($vacancy as $row2) {
                                        ?>
                                        <option value="<?php echo $row2->vacant_id ?>" <?=(ist($row2->vacant_id) == $row->vacant_id) ? 'selected' : ''  ?>><?php echo $row2->vacant_title ?></option>
                                        <?php 
                                    }
                                } 
                                ?>
                            </select>
                            <?php 
                        }
                    } 
                    ?> 
                    <div class="form-group">
                        <?php
                        if (isset($applicant_data) and $applicant_data != 0) {
                            foreach ($applicant_data as $row) {
                                ?>
                                <label for="uploadfile">Upload Your Photo (Allowed file type : jpg, jpeg, png (max. 200 Kb)) *</label>
                                <input type="file" name="uploadfile[]" accept=".jpg, .jpeg, .png">
                                <?php
                                echo (empty($row->candidat_foto) ? '<span style="color : red;">NOT UPLOADED</span>' : '<span style="color:green;">UPLOADED</span>'); 
                                ?>
                                <?php 
                            }
                        } 
                        ?>
                    </div>
                    <p>(*) Mandatory</p>
                </section>
                <!-- ######################################################################################################################################################## -->
                <h3>Personal Data</h3>
                <section>
                    <div class="tile">Personal Data</div>
                    <div class="form-group">
                        <?php 
                        if (isset($applicant_data) and $applicant_data != 0) {
                            foreach ($applicant_data as $row) {
                               if (is_null($row->dob)) {
                                $dob = '';
                            }else{
                                $dob = date('Y-m-d', strtotime($row->dob) );
                            }
                            ?>
                            <label for="fullname"><img src="<?php echo base_url(); ?>assets/icon/fullname.svg" alt=""/>&nbsp;Full Name *</label>
                            <input id="fullname" name="fullname" type="text" placeholder="Full Name" value="<?= $row->candidat_name ?>">
                            <input type="hidden" name="candidat_id" id="candidatID" value="<?= $row->candidat_id ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="pob"><img src="<?php echo base_url(); ?>assets/icon/dob.svg" alt=""/>&nbsp;Place of Birth *</label>
                                    <input id="pob" name="pob" type="text" placeholder="Place of Birth" value="<?= $row->pob ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="dob"><img src="<?php echo base_url(); ?>assets/icon/dob.svg" alt=""/>&nbsp;Date of Birth *</label>
                                    <input id="dob" name="dob" type="date" placeholder="Date of Birth" value="<?= $dob ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email"><img src="<?php echo base_url(); ?>assets/icon/email.svg" alt=""/>&nbsp;Email *</label>
                                    <input type="email" name="email" id="candidat_email" placeholder="Email" value="<?= $row->candidat_email ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="candidat_phone"><img src="<?php echo base_url(); ?>assets/icon/phone.svg" alt=""/>&nbsp;Phone Number *</label>
                                    <input type="number" name="candidat_phone" id="candidat_phone" placeholder="Phone Number" value="<?= $row->candidat_phone ?>">
                                </div>
                            </div>
                            <h5>Social Media</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" id="instagramCont" name="instagram" placeholder="Instagram" value="<?= $row->candidat_instagram ?>">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="facebookCont" name="facebook" placeholder="Facebook" value="<?= $row->candidat_facebook ?>">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="linkedinCont" name="linkedin" placeholder="LinkedIn" value="<?= $row->candidat_linkedin ?>">
                                </div>
                            </div>
                            <?php 
                        }
                    }
                    ?>
                    <label><img src="<?php echo base_url(); ?>assets/icon/education.svg" alt=""/>&nbsp;Education *</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Institution</th>
                                <th>Major</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>GPA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <select id="eduInstitute" name="edu_institute" class="form-control show-tick" data-container="body">
                                                <option value="">- Choose -</option>
                                                <option value="OTHER"> Other </option>
                                                <?php
                                                if (isset($university) and $university != 0) {
                                                    foreach ($university as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->university_name ?>" ><?php echo $row->university_name; ?></option>
                                                        <?php 
                                                    }
                                                }
                                                ?>        
                                            </select>
                                            <input type="hidden" name="cedu_id" id="eduId" value="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="eduMajor" name="edu_major" placeholder="Major" value="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <select class="form-control show-tick" id="eduTitle" name="edu_title" data-container="body">
                                                <option value="">- Choose -</option>
                                                <option value="S2"> S2 </option>
                                                <option value="S1"> S1 </option>
                                                <option value="D3"> D3 </option>
                                                <option value="SMU"> SMU </option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="date" class="form-control" id="eduStart" name="edu_start" value="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="date" class="form-control" id="eduEnd" name="edu_end" value="">
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 30%">
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="eduGpa" name="edu_gpa" placeholder="GPA" value="">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <label><img src="<?php echo base_url(); ?>assets/icon/work.svg" alt=""/>&nbsp;Work Experience</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Job Title</th>
                                <th>Last Salary</th>
                                <th>Job Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="company_name" id="companyName" placeholder="Company" value="">
                                            <input type="hidden" name="work_exp_id" id="workExpId" value="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="work_exp_title" id="workExpTitle" placeholder="Job Title" value="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="last_salary" id="lastSalary" placeholder="Last Salary" value="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="job_desc" id="jobDesc" placeholder="Job Desc" value="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="date" class="form-control" name="work_exp_from" id="workExpForm" value="">
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 30%">
                                    <div class="form-group m-b-0">
                                        <div class="form-line">
                                            <input type="date" class="form-control" name="work_exp_to" id="workExpTo" value="">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </form>
</div>
</div>
</div>

<script>var uri = "<?php echo base_url()?>/";</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vendor/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/waves.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.steps.js"></script>