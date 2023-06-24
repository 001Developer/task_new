<?php
include('common/config.php');
include('common/app_function.php');

$title = "Registration Successfull";
index_header($title,$rewritepath,$tblpref,$db,$row_admin, $siteuploadpath);
?>
<section class="title-section">
              <ol class="breadcrumb">
                <li><a href="<?php echo $rewritepath; ?>home/">Home</a></li>
                <li class="active">Registration Successfull</li>
              </ol>
            </section>
            
            <h1>Registration Successfull</h1>
			<div class="alert alert-success" role="alert"><strong>Thank you for registering with WUC <a href="<?php echo $rewritepath; ?>wuc-login/">click here</a> to login to your account and start using Our online Services . </strong></div>
            
        </div>
    </div>
</main>
<?php
index_footer($rewritepath,$tblpref,$db,$row_admin,$connection);
?>