<div class="container-fluid mt-5 text-center d-flex flex-column">
	<div class="card text-center mt-2">
		<div id="card-header" class="card-header bg-dark">
			<ul class="nav nav-tabs card-header-tabs d-flex">
				<li class="nav-item flex-grow-1">
					<div class="nav-link text-dark active" bootstrap_class='bg-dark' category-id='-1'>All Note</div>
				</li>
				<?php foreach ($categories as $category): ?>
					<li class="nav-item flex-grow-1">
						<div class="nav-link text-white" bootstrap_class='<?= $category->bootstrap_class; ?>' category-id='<?= $category->category_id; ?>'><?= $category->category_name; ?></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div id="container" class="card-body d-flex flex-wrap justify-content-center">
			<?php foreach ($notes as $note):?>

				<div class="p-1 note" style="position: relative;">
					<div class="card text-white <?= $note->bootstrap_class ?>">
						<div class="card-header text-center"><?= $note->note_header; ?></div>
						<div class="card-body">
					    	<p class="card-text">
					    		<?= substr($note->note_body,0,265); ?>
					    		<?= strlen($note->note_body) > 265 ? '...' : '' ?>
					    		<span hidden=""><?= $note->note_body; ?></span>
					    	</p>
						</div>
					</div>
					<div class="card overplay" style="position: absolute; top: .25rem; display: none;">
						<div class="card-body d-flex justify-content-around align-items-center">
							<a href="#" category-name="<?= $note->category_name ?>" note-id="<?= $note->note_id ?>" class="text-primary edit"><i class="far fa-edit fa-3x"></i></a>
							<a href="<?= base_url()."/Home/deleteNote/".$note->note_id ?>" class="text-danger"><i class="fas fa-trash fa-3x"></i></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
				<div class="p-1 add">
					<div class="card text-white bg-dark">
						<div class="card-body d-flex justify-content-around align-items-center">
					    	<a href="#" class="text-white"><i class="fas fa-plus fa-5x"></i></a>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailNoteModal" tabindex="-1" role="dialog" aria-labelledby="detailNoteModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-white">
        <h5 class="modal-title" id="detailNoteModalTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="modalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open() ?>
      <div class="modal-body ">
      		<div class="form-group">
				<input type="number" hidden="" class="form-control" id="note_id" name="note_id">
			</div>
			<div class="form-group">
				<label for="note_header">Judul</label>
				<input type="text" class="form-control" id="note_header" name="note_header">
			</div>
			<div class="form-group">
			    <label for="note_body">Catatan</label>
			    <textarea class="form-control" id="note_body" rows="3" name="note_body"></textarea>
			 </div>
			 <div class="form-group">
			    <label for="category">Kategori</label>
			    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons" style="width: 100%;">
			    	<?php foreach ($categories as $category): ?>
			    		<label class="btn btn-<?= substr($category->bootstrap_class, 3); ?>">
						    <input type="radio" name="category" id="<?= $category->category_name; ?>" autocomplete="off" value="<?= $category->category_id; ?>"> <?= $category->category_name; ?>
						</label>
					<?php endforeach; ?>
				</div>
			 </div>
			 
		
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-dark">Reset</button>
        <button type="submit" class="btn btn-dark"></button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>

	$.ajax({
		method: "POST",
		url: "<?= base_url()?>/Home/selectData/-1",
		success: function(result) {
			// console.log(result);
			$("#container").html(result);
		}
	})
	
</script>
