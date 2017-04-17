<?php 
   $self -> document -> setTitle($lang['heading_title']); 
   echo $self -> load -> controller('common/header'); 
   echo $self -> load -> controller('common/column_left'); 
   ?>
</div>
<div class="main-content" style="margin-top: 50px;">
<!-- Start .content -->
  <div class="content" style="">
     <div class="row">
        <!-- .row start -->
      <div class="">
        <div class="btn-toolbar pull-right col-md-4" style="margin-bottom:20px;">
            <a style="min-width: 100%" href="<?php echo $self -> url -> link('account/gd/create', '', 'SSL'); ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i><?php echo $lang['text_button_create'] ?></a>
         </div>
      </div>
        <div class="col-md-12">
           <!-- col-md-12 start here -->
           <?php $num = 1; foreach ($gds as $value => $key){ ?>
           <div class="panel panel-default" id="dash_0">
              <!-- Start .panel -->
              <div class="panel-heading">
                 <h4 class="panel-title"><i class="fa fa-align-justify"></i><?php echo $lang['text_register_user'] ?></h4>
              </div>

              <div class="panel-body form-horizontal group-border stripped" style="background: rgba(221, 158, 38, 0.18)">
                 <div class="form-group">
                    <div class="col-lg-12 col-md-12">
                      <div class="input-group input-icon file-upload">
                        <div class="widget-content" style="padding:10px">
                           <div class="">
                              <div class="">
                                 
                                 
                                 <!-- <div class="clearfix"></div> -->
                              </div>
                              <?php if($gds){ ?>
                              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                              
                              <div class="list_ph" style="margin-bottom: 30px">
                                 <div class="Head" role="tab" id="headingOne<?php echo $key['gd_number'] ?>">
                                    
                                    <h4 style=" width: 350px;float: left;"><?php echo $lang['Your_GD'] ?> : <strong>GD<?php echo $key['gd_number'] ?></strong></h4>

                                    <?php $progress = ($self -> get_transfer_gd_id($key['id'])); 
                                        if ($progress['finish'] == 0)
                                        {
                                          $percent = 0;
                                        }
                                        else
                                        {
                                          $percent = round($progress['finish']/$progress['total']*100,2);
                                        }
                                        
                                      ?>
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percent ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent ?>%">
                                          <?php echo $percent ?>%
                                        </div>
                                      </div>

                                    <div class="clearfix"></div>
                                    <table  class="table">
                                        <thead>
                                         
                                        
                                          <tr>
                                            <td><?php echo $lang['DATE_CREATED'] ?></td>
                                            <td><?php echo $lang['useridph'] ?></td>
                                            <td><?php echo $lang['AMOUNT'] ?></td>
                                            <!-- <td><?php //echo $lang['danhnhan'] ?></td> -->
                                            <!-- <td><?php //echo $lang['transferTime'] ?></td> -->
                                            <td><?php echo $lang['STATUS'] ?></td>
                                            
                                            <td rowspan="2" style="height: 50px;">
                                              <a style="margin-top:15px;" class="pull-right btn btn-primary " role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $key['gd_number'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $key['gd_number'] ?>">
                                              <i class="short-full fa  fa-list glyphicon-plus glyphicon-minus"></i>

                                              <?php echo $lang['detail'] ?>
                                              </a>
                                            </td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td data-title="<?php echo $lang['DATE_CREATED'] ?>"><strong><?php echo date("d/m/Y", strtotime($key['date_added'])); ?></strong></td>
                                            <td data-title="ID"><strong><?php echo $key['username'] ?></strong></td>
                                            <td data-title="<?php echo $lang['AMOUNT'] ?>"><strong><?php echo number_format($key['amount']); ?> <?php echo $lang['VND'] ?></strong></td>
                                            <!-- <td data-title="<?php echo $lang['danhnhan'] ?>"><strong><?php echo number_format($key['filled']); ?> <?php echo $lang['VND'] ?></strong></td> -->
                                            
                                            <td data-title="<?php echo $lang['STATUS'] ?>"><strong><span class=""><?php switch ($key['status']) {
                                       case 0:
                                           echo '<span style="width:100px;" class="btn btn-warning">'.$lang['dangcho'].'</span>';
                                           break;
                                       case 1:
                                           echo '<span class="btn btn-info">'.$lang['khoplenh'].'</span>';
                                           break;
                                       case 2:
                                           echo '<span style="width:100px;background-color: #9a9292; color: #fff;"  class="btn btn-success">'.$lang['ketthuc'].'</span>';
                                           break;
                                       case 3:
                                           echo '<span style="width:100px;" class="btn btn-danger">'.$lang['baocao'].'</span>';
                                           break;
                                       } ?></span></strong></td>
                                       <?php if ($key['status'] == 1) { ?>
                                         <td data-title="<?php echo $lang['transferTime'] ?>"><strong><span style="color:red; font-size:15px;" class="text-danger countdowns" data-countdown="<?php echo $key['date_finish']; ?>">
                                       </span> </strong></td> 
                                        <?php } ?>
                                          </tr>
                                          <td rowspan="2" class="click_pd">
                                              <a style="margin-top:-6px;" class="pull-right btn btn-primary " role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $key['gd_number'] ?>" aria-expanded="true" aria-controls="collapseOne<?php echo $key['gd_number'] ?>">
                                              <i class="short-full fa  fa-list glyphicon-plus glyphicon-minus"></i>

                                              <?php echo $lang['detail'] ?>
                                              </a>
                                            </td>
                                        </tbody>
                                      </table>
                                 </div>
                                 <div id="collapseOne<?php echo $key['gd_number'] ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $key['gd_number'] ?>">
                                    <div class="ph_collapse">
                                       <?php 
                                          $show_transfer = $self -> show_transfer($key['id']); 
                                          if (!$show_transfer) {
                                            echo '<p class="text-warning"> Please waiting!!!!';
                                          }else {
                                            echo $show_transfer;
                                          }
                                      
                                          ?>
                                    </div>
                                 </div>
                              </div>
                              
                           </div>
                           <!-- panel-group -->
                           <div class="clearfix" ></div>
                           <script>
                              function toggleIcon(e) {
                                  $(e.target)
                                      .prev('.Head')
                                      .find(".short-full")
                                      .toggleClass('glyphicon-plus glyphicon-minus');
                              }
                              $('.panel-group').on('hidden.bs.collapse', toggleIcon);
                              $('.panel-group').on('shown.bs.collapse', toggleIcon);
                           </script>
                              
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <!-- End Row -->
                     <!-- End row -->
                  </div>
                  <script type="text/javascript">
                     $(document).ready(function() {
                         $('#datatable').dataTable();
                     } );
                  </script>
                      
              </div>
           </div>
        </div>
        <?php $num++; } ?>
     </div>

  </div>
<button style="display: none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" id="myModal_gdreport" data-target="#myModal_GD">Open Modal</button>

<!-- Modal -->
<div id="myModal_GD" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $lang['btn_report'] ?></h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="radio">
            <label><input type="radio" name="optradio" checked="true"><?php echo $lang['Idonotgetmoney'] ?></label>
          </div>
          <div class="radio">
            <label><input type="radio" name="optradio"><?php echo $lang['Other_reasons'] ?></label>
          </div>
          <div class="radio" style="margin-left: 20px;">
            <textarea id="textareald" style="width: 100%; height: 50px;border: 1px solid #eee; border-radius: 4px; padding: 4px;" placeholder="<?php echo $lang['Reasons'] ?>"></textarea>
          </div>
          <h3 class="text-center"><?php echo $lang['Are_you_sure_to_Report'] ?></h3>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-value="" class="gh_report_confirm btn btn-danger" style=""><?php echo $lang['btn_report'] ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang['Close'] ?></button>
      </div>
    </div>

  </div>
</div>

  <div class="clearfix" style="margin-top: 80px;"></div>
</div>

<script type="text/javascript">

  $('.gh_confirm').on('click', function() {
    var result = confirm("<?php echo $lang['Confirm_Bill']; ?>");
    var code = $(this).data().value;
    if (result) {
      url = 'confirmgh.html&token='+code;
      location = url;
    }
  });
   $('.gh_report').on('click', function() {
    var code = $(this).data().value;
    $('#myModal_GD .gh_report_confirm').attr('data-value',code);
    $('#myModal_gdreport').trigger('click');
    
    /*var result = confirm("<?php echo $lang['Confirm_Report_ID_PD']; ?>");
    var code = $(this).data().value;
    if (result) {
      url = 'reportgh.html&token='+code;
      location = url;
    }*/
  });

    $('.gh_report_confirm').on('click', function() {
    var id = $(this).data('value');
    if ($('#radio0').is(":checked"))
    {
      var textareald = "no_money";
    }
    if ($('#radio1').is(":checked"))
    {
      if ($('#textareald').val() == "")
      {
        $('#textareald').css({'border':'1px solid red'});
        return false;
      }
      var textareald = $('#textareald').val();
    }
    
      url = 'reportgh.html&token='+id+'&textareald='+textareald;
      location = url;
  });
</script>

<?php echo $self->load->controller('common/footer') ?>
<style type="text/css">
  .radio-custom{
    float: left;
    margin-top: 0px;
  }
</style>