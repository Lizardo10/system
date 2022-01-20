<?php $this->load->view("partial/header"); ?>

<div class="manage_buttons hidden-print">
	<div class="row">
		<div class="col-md-6">
			<div class="hidden-print search no-left-border">
				<ul class="list-inline print-buttons">
					<li></li>
					
						<?php
						if ((empty($deleted) || (!$deleted))) { ?>
						<li>
							<?php 
							 if ($sale_id_raw != lang('sales_test_mode_transaction') && !$store_account_payment && !$is_purchase_points && !$is_ecommerce && $this->Employee->has_module_action_permission('sales', 'edit_sale', $this->Employee->get_logged_in_employee_info()->person_id)){

						   		$edit_sale_url = (isset($sale_type) && ($sale_type == ($this->config->item('user_configured_layaway_name') ? $this->config->item('user_configured_layaway_name') : lang('common_layaway')) || $sale_type == lang('common_estimate'))) ? 'unsuspend' : 'change_sale';
								echo form_open("sales/$edit_sale_url/".$sale_id_raw,array('id'=>'sales_change_form')); ?>
								<button class="btn btn-primary btn-lg hidden-print" id="edit_sale"> <?php echo lang('sales_edit'); ?> </button>

							<?php }	?>
							</form>		
						</li>
					<?php } ?>
						
					<?php 
					if ($sale_id_raw != lang('sales_test_mode_transaction')){
					?>	
						<li>
							<button class="btn btn-danger btn-lg hidden-print" id="eliminar_factura_button" onclick="window.open('<?php echo site_url("sales/fulfillment/$sale_id_raw"); ?>', '_blank');" > <?php echo "Anular Factura"; ?></button>
						</li>
					<?php } ?>
					
					<li>
						<button class="btn btn-primary btn-lg hidden-print gift_receipt" id="gift_receipt_button" onclick="toggle_gift_receipt()" > <?php echo lang('sales_gift_receipt'); ?> </button>
					</li>
						<?php if ($sale_id_raw != lang('sales_test_mode_transaction') && !empty($customer_email)) { ?>
							<li>
									<?php echo anchor('sales/email_receipt/'.$sale_id_raw, lang('common_email_receipt'), array('id' => 'email_receipt','class' => 'btn btn-primary btn-lg hidden-print'));?>
							</li>
						<?php }?>
					
										
				</ul>
			</div>
		</div>
		<div class="col-md-6">	
			<div class="buttons-list">
				<div class="pull-right-btn">
					<ul class="list-inline print-buttons">
						<li>
							<?php
							echo form_checkbox(array(
								'name'        => 'print_duplicate_receipt',
								'id'          => 'print_duplicate_receipt',
								'value'       => '1',
							)).'&nbsp;<label for="print_duplicate_receipt"><span></span>'.lang('sales_duplicate_receipt').'</label>';
								?>		
						</li>
						<li>
							<button class="btn btn-primary btn-lg hidden-print" id="print_button" onclick="window.print()" > <?php echo lang('common_print'); ?> </button>		
						</li>
						<li>
							<?php echo anchor_popup(site_url('sales/open_drawer'), '<i class="ion-android-open"></i> '.lang('common_pop_open_cash_drawer'),array('class'=>'btn btn-primary btn-lg hidden-print', 'target' => '_blank')); ?>
						</li>
						<li>
							<button class="btn btn-primary btn-lg hidden-print" id="new_sale_button_1" onclick="window.location='<?php echo site_url('sales'); ?>'" > <?php echo lang('sales_new_sale'); ?> </button>	
						</li>
					</ul>
				</div>
			</div>				
		</div>
	</div>
</div>

<?php

echo $invoice;
?>