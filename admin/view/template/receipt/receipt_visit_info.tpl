<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if (isset($info)) { ?>
                            <div class="form-group">
                                <thead>
                                <tr>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <div class="row">
                                        <div class="col-md-2 text-right"><h4 style="font-weight: bold">回访日期</h4></div>
                                        <div class="col-md-10 text-left"><h4><?php echo $info['date_add']; ?></h4></div>
                                    </div>
                                    <?php if ($info['receipt_text'] != NULL) {                                             ?>
                                    <?php     foreach ($info['receipt_text'][0] as $onereceipt) {                  ?>
                                    <?php         if ( $onereceipt['flag'] == '1' ){                               ?>
                                    <div class="row">
                                        <div class="col-md-2 text-right"><h4 style="font-weight: bold"><?php echo($onereceipt['name']);?><h4></div>
                                        <div class="col-md-10 text-left">
                                            <h4>
                                                <?php         if ($onereceipt['name'] != '其他') echo('病史或症状：');          ?>
                                                <?php         if ($onereceipt['detail']){                                      ?>
                                                <?php             if(isset($onereceipt['detail']['key'])){                     ?>
                                                <?php                 if ($onereceipt['detail']['value'] == '有') {            ?>
                                                <?php                     echo($onereceipt['detail']['key']); echo('；');      ?>
                                                <?php                 }else if ($onereceipt['detail']['value'] != '无'){       ?>
                                                <?php                     echo($onereceipt['detail']['key']); echo('：');      ?>
                                                <?php                     echo($onereceipt['detail']['value']); echo('；');    ?>
                                                <?php                 }                                                        ?>
                                                <?php             }else{                                                       ?>
                                                <?php                 foreach ($onereceipt['detail'] as $onedetail) {          ?>
                                                <?php                     if ($onedetail['value'] == '有') {                   ?>
                                                <?php                         echo($onedetail['key']);echo('；');              ?>
                                                <?php                     }else if ($onedetail['value'] != '无'){              ?>
                                                <?php                         echo($onedetail['key']);echo('：');              ?>
                                                <?php                         echo($onedetail['value']);echo('；');            ?>
                                                <?php                     }                                                    ?>
                                                <?php                 }                                                        ?>
                                                <?php             }                                                            ?>
                                                <?php         }                                                                ?>
                                            </h4>
                                        </div>
                                    </div>
                                    <?php         }else{                                                           ?>
                                    <div class="row">
                                        <div class="col-md-2 text-right"><h4 style="font-weight: bold"><?php echo($onereceipt['name']);?><h4></div>
                                        <div class="col-md-10 text-left">
                                            <h4>
                                                <?php         if ($onereceipt['name'] != '其他') {                             ?>
                                                <?php              echo('病史或症状： 无'); }else{                              ?>
                                                <?php              echo('无'); }                                          ?>
                                            </h4>
                                        </div>
                                    </div>
                                    <?php         }                                                                ?>
                                    <?php     }                                                                    ?>
                                    <?php }else {                                                                  ?>
                                    <div class="row">
                                        <div class="col-md-2 text-right"><h4 style="font-weight: bold"><h4></div>
                                        <div class="col-md-10 text-left">
                                            <h4>
                                                <?php echo $text_no_results;                                                   ?>
                                            </h4>
                                        </div>
                                    </div>
                                    <?php }                                                                        ?>
                                </tr>
                                </tbody>
                            </div>
                            <?php } else { ?>
                            <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript"><!--
        $('.date').datetimepicker({
            pickTime: false
        });
        //--></script></div>
<?php echo $footer; ?>
