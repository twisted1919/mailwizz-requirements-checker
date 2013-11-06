<?php defined('MW_INSTALLER_PATH') or exit();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MailWizz requirements checker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans:700italic" />
        <link rel="stylesheet" type="text/css" href="<?php echo MW_ASSETS_SERVER;?>/backend/assets/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo MW_ASSETS_SERVER;?>/backend/assets/css/bootstrap-glyphicons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo MW_ASSETS_SERVER;?>/backend/assets/css/style.css" />
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?php echo MW_ASSETS_SERVER;?>/backend/assets/js/bootstrap.js" id="script-bootstrap"></script>
    </head>

  <body>
    
    <nav class="navbar header-nav-bar" role="navigation">
        <div class="navbar-header">
            <a href="index.php?route=requirements" class="navbar-brand">MailWizz <small>Email marketing application.</small></a>
        </div>
    </nav>
    
    <div class="row-fluid wrapper">
        <div class="top"><!-- --></div>
        <div class="main">
            <div class="hide-under-top">
                <div class="col-lg-2">
                    
                    <div class="panel panel-default sidebar">
                        <div class="sidebar-nav">
                            <a class="nav-header<?php echo ($context instanceof RequirementsController) ? ' active':'';?>" href="javascript:;"><i class="glyphicon glyphicon-circle-arrow-right"></i> Requirements</a>
                        </div>                    
                    </div>
                    
                </div>
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php if (!empty($breadcrumbs)) { $bcount = count($breadcrumbs);?>
                            <ul class="breadcrumb">
                                <?php $i = 0; foreach ($breadcrumbs as $text => $href) { ++$i; ?>
                                <li><a href="<?php echo $href;?>"><?php echo $text;?></a> <?php if ($i < $bcount) {?> <span class="divider"></span><?php }?></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                            <div class="page-content">
                            <?php if ($error = $context->getError('general')) { ?>
                                <div class="alert alert-danger alert-block">
                                    <?php echo $error;?>
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                </div>
                            <?php } ?>
                                {{CONTENT}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
    </div>
    
  </body>
</html>