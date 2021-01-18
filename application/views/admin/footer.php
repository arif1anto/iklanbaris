<footer class="footer-content">
	<span> <span id="copyright-year"></span></span>
</footer>
</section>
<div class="modal fade" id="print" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" style="width: calc(100% - 300px)">
		<div class="modal-content">
			<div class="modal-header" style="padding: 8px 15px">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Print Preview</h4>
				<button type="button" class="btn btn-primary btn-sm pull-right" style="position: absolute;
    right: 71px;
    top: 5px;" onclick="window.frames['frame'].print();"><i class="fa fa-print"></i> Print</button>
			</div>
			<div class="modal-body" style="padding: 0">
				<iframe name="frame" id="frame" style="height: 550px; width: 100%;"></iframe>
			</div>
		</div>
	</div>
</div>
<div id="loading" style="display:none">
  <img src="<?php echo base_url().'assets/img/loading.gif' ?>"/>
</div>
<?php echo $this->load->view('admin/get_js'); ?>
</body>
</html>
