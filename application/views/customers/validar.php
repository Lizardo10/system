<div class="form-group">
	<form action="<?php echo base_url().'/index.php/customers/view/-1/'?>" method="post">
            NIT:

		<div class="col-sm-9 col-md-9 col-lg-10">
			<input type="text" id="nit" name="nit" value="<?php echo $customer?>" >
            <input type="submit" value="comprobar">
		</div>
	</form>		
</div>