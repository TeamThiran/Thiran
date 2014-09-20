<div class="space"></div>
<div class="container">
	<div class="jumbotron">
		<br><br>
		<table class="table">
			<tbody>
				<tr>
					<td>Username</td>
					<td class="text-info"><?php echo $this->session->userdata('name');?></td>
				</tr>
				<tr>
					<td>College</td>
					<td class="text-info"><?php echo $this->session->userdata('college_id');?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td class="text-info"><?php echo $this->session->userdata('email');?></td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td class="text-info"><?php echo $this->session->userdata('phone_no');?></td>
				</tr>
			</tbody>
		</table>
                <a href="<?php echo base_url();?>welcome/logout">Log-out</a>
	</div>
</div>