<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $wpdb;

$table = $wpdb->prefix.'wpbot_response_category';

$data = $wpdb->get_results($wpdb->prepare("select * from $table")); //DB Call OK, No Caching OK

?>
<style type="text/css">
table.qcdf_table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  table.qcdf_table td, table.qcdf_table th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }
  
  table.qcdf_table tr:nth-child(even) {
    background-color: #dddddd;
  }
.dfentity_wp_table{width: 600px;
    background: #fff;
    padding: 10px;}
.dfentity_actions{width:600px;float:left;margin-left: 50px;padding: 10px;background:#fff}
.dfentity_header_button{padding: 10px;
    background: #fff;
    margin-bottom: 21px;
    width: 1270px;}
</style>
<div class="qcwrap">
    <div class="wp-chatbot-wrap">
	
	
		<div class="wpbot_dashboard_header container">
			<h1>Manage STR Categories</h1>
			
		</div>
		
		<div class="wpbot_addons_section container">
		
			<a href="<?php echo esc_url( add_query_arg( 'opt', 'add', admin_url('admin.php?page=simple-text-response&action=manage-category') ) ); ?>" class="page-title-action button">Add New Category</a>
		
			<div class="wpbot_single_addon_wrapper2">
			
				<div class="dfentity_wp_table">
					<h2>Category List</h2>
					<hr>
					<?php 
					
					if(!empty($data)):
					?>
					<table class="qcdf_table">
						<tr>
							<th>Id</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
						<?php foreach($data as $result): ?>
						<tr>
							<td><?php echo esc_html($result->id); ?></td>
							<td><?php echo esc_html($result->name); ?></td>
							<td>
							<a href="<?php echo esc_url( add_query_arg( 'id', $result->id, admin_url('admin.php?page=simple-text-response&action=manage-categories&opt=edit') ) ); ?>" class="page-title-action">Edit</a>
							 | 
							<a href="<?php echo esc_url( add_query_arg( 'id', $result->id, admin_url('admin.php?page=simple-text-response&action=manage-categories&opt=delete') ) ); ?>" class="page-title-action">Delete</a>
							
							</td>
						</tr>
						<?php endforeach; ?>
					</table>
					<?php else: ?>
						<p>No category found!</p>
					<?php endif; ?>
				
				</div>
			
			</div>
			
			<footer class="wp-chatbot-admin-footer">
				<div class="row">
					<div class="text-left col-sm-3 col-sm-offset-3">
						
					</div>
					<div class="text-right col-sm-6">
						<input type="submit" class="button button-primary" name="submit" id="submit" value="Save Settings">
					</div>
				</div>
				<!--                    row-->
			</footer>


		</div>
    </div>
</div>