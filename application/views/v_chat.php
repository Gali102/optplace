<?php //params
	$u_s = $this->session->userdata['user_status_maj'];
	$u_i = $this->session->userdata['user_id'];
	$u_n = $this->session->userdata['user_name'];

	$dis = true;
?>

<div class="container-fluid">
	<div class="row">

		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12">
		<div class="row">
			<div class="col-md-3 chat-dialogs" style="background-color: #3c8dbc;">
				<div class="row"></div>
			</div>

			<div class="col-md-6 chat">
			
				<div class="chat-data"></div>
				<div class="chat-interface">
					<div class="chat-smiles">
						<?php foreach(scandir('img/smiles') as $smile) : ?>
							<?php if($smile[0] != '.') : ?>
								<img src="/img/smiles/<?= $smile ?>">
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<div class="chat-input">
						<button id="smiles-open">
							<i class="fa fa-smile-o"></i>
						</button>
						<button id="image-upload">
							<i class="fa fa-picture-o"></i>
						</button>
						<input type="file" name="files[]" accept="image/*" multiple="true" id="chat-files" onchange="handleFiles(files);">
						<div class="form-control" id="chat-text" contenteditable></div>
						<button id="chat-send">
							<i class="fa fa-paper-plane"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="col-md-3 users-data-cont">
				<div class="users-data"></div>
			</div>
		</div>
		</div>
    </div>
</div>

<input type="hidden" id="poluch_id" value="0">