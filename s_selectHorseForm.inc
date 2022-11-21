<p><strong>Select Horse to Edit.</strong>
<br>
<p>Use the dropdown menu to select the Horse.</p>
<p>When finished, hit <b> Select Horse </b> at the bottom of this page </p><p>(<span style = "font-size:x-small;color:FF0000">*</span> required information).</p>

<form method = "POST" action="/Horse/s_horseEdit.php?formAction=editHorse">
	<input type="hidden" name="old_name" value"new">
	<input type-"hidden" name="_form_submit" value = "1">
	<fieldset>
		<legend>Horse: </legend>
		<p>Horse Name<span style = "font-size:x-small;color:FF0000"></span>:</p>
		<select name = "horseName" tabindex="1">
			<?php
				$titles = getall_horse_names();

				foreach($titles as $t){
					echo("<option value='$t' >$t</option>");
				}
				?>
			</select>
			<script src="lib/>jquery-1.9.1.js"></script>
			<script src="lib/>jquery-ui.js"></script>
		</fieldset>
		<br>
		<input type="submit" value="Select Horse"/>
</form>

