				<?php if($_POST["status"]=="1"){?>
					<div class="btn-group btn-group-toggle" data-toggle="buttons">
					  <label class="btn btn-success active">
					    <input type="radio" name="approve" id="approve1" value="1" autocomplete="off" checked><i class="fas fa-check"></i> อนุมัติ
					  </label>
					  <label class="btn btn-danger">
					    <input type="radio" name="approve" id="approve2" value="0" autocomplete="off"><i class="fas fa-times"></i> ไม่อนุมัติ
					  </label>
					</div>
				<?php } ?>