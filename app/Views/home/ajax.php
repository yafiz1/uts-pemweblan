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
<script>
	$("button[type=reset]").click(function() {
		$("#modal #note_id").val("");
		$("#modal #note_header").val("")
		$("#modal #note_body").val("")
		$("#modal input[name=category]").removeAttr("checked")
		$("#modal input[name=category]").parent().removeClass("active")
	})
	$(".add a").click(function() {
		$("button[type=reset]").trigger("click");
		$("#modalLabel").text("Catatan Baru");
		$("#modal .modal-footer button[type=submit]").text("Tambah");
		$("#modal form").attr("action", "<?= base_url().'/Home/addNote' ?>");

		$("#modal").modal();
	})

	$(".edit").each(function() {
		$(this).click(function() {
			$("button[type=reset]").trigger("click");
			$("#modalLabel").text("Edit Catatan");
			$("#modal .modal-footer button[type=submit]").text("Edit");
			$("#modal form").attr("action", "<?= base_url().'/Home/updateNote' ?>");
			$("#modal #note_id").val($(this).attr("note-id"));
			$("#modal #note_header").val($(this).parent().parent().parent().children().first().children('.card-header').text())
			$("#modal #note_body").val($(this).parent().parent().parent().children().first().children('.card-body').children().children("span").text())
			<?php foreach ($categories as $category): ?>
				if ($(this).attr("category-name") == "<?= $category->category_name; ?>") {
					$("#<?= $category->category_name; ?>").attr("checked","");
					$("#<?= $category->category_name; ?>").parent().addClass("active");
				}
			<?php endforeach; ?>
			$("#modal").modal();
			$("#modal").addClass("active");
		})
	})
	

	$("#editModal").on("hide.bs.modal", function() {
		$("#modal").removeClass("active");
	})


	$(".nav-link").each(function() {
		$(this).hover(
			function() {
				$(this).parent("li").addClass($(this).attr('bootstrap_class'))
				$(this).css("border","1px solid transparent");
				$(this).parent("li").css("border-top-left-radius",".25rem");
				$(this).parent("li").css("border-top-right-radius",".25rem");
			}, function() {$(this).parent("li").removeClass(["bg-danger","bg-success","bg-info","bg-warning","bg-dark","bg-primary","bg-secondary","bg-light","bg-white","bg-transparent"])}
		);

		$(this).click(function() {
			$.ajax({
				method: "POST",
				url: "<?= base_url()?>/Home/selectData/"+$(this).attr('category-id'),
				success: function(result) {
					// console.log(result);
					$("#container").html(result);
				}
			})

			$("#card-header").removeClass(["bg-danger","bg-success","bg-info","bg-warning","bg-dark"]);
			if ($(this).text() == "Work") $("#card-header").addClass("bg-danger");
			else if ($(this).text() == "Life") $("#card-header").addClass("bg-success");
			else if ($(this).text() == "Personal") $("#card-header").addClass("bg-info");
			else if ($(this).text() == "Travel") $("#card-header").addClass("bg-warning");
			else $("#card-header").addClass("bg-dark");

			$(".nav-link").removeClass(["active","text-dark"]);
			$(".nav-link").addClass("text-white");
			$(this).addClass(["active","text-dark"]);

		});
	})

	$(".note").each(function() {
		$(this).hover(
			function() {$(this).children('.overplay').fadeIn()},
			function() {$(this).children('.overplay').fadeOut()}
		)

		if ($(this).children().first().children('.card-body').children().children().text().length > 265) {
			$(this).css('cursor','pointer');
			$(this).click(function() {
				if ((!$("#editModal").hasClass('active'))) {
					$("#detailNoteModal .modal-header").removeClass(['bg-danger','bg-info','bg-success','bg-warning']);

					$("#detailNoteModal .modal-title").text($(this).children().children('.card-header').text());
					$("#detailNoteModal .modal-body").text($(this).children().children('.card-body').children().children().text());

					let jenis = $(this).children().attr('class').split(' ');
					$("#detailNoteModal .modal-header").addClass(jenis[jenis.length-1]);
					$("#detailNoteModal").modal('show');	
				}
				
			});
		}
	});
</script>