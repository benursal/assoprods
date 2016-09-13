<div>
<form name="dialogBox" onSubmit="return false;">
<div id="addDialog">
	<div id="title2"><span id="t">Dialog Box Title</span> <span id="closeDialog">
	<a href="#" onClick="closeDialog();return false; ">X</a></span></div>
	<div id="body">
		<table>
			<tr id="idRow"><td width="127" align="right" id="idLabel">Customer ID : </td><td width="10" class="divider">&nbsp;</td>
			<td width="253" align="left"><input id="id" size="10" onKeyPress="checkKey(event);"></td></tr>
			<tr><td align="right" id="nameLabel">Customer Name : </td><td class="divider">&nbsp;</td>
			<td><input id="name" size="40" name="name" onKeyPress="checkKey(event);"></td></tr>
			<tr id="addressRow">
			  <td align="right" id="nameLabel">Address : </td>
			  <td class="divider">&nbsp;</td>
			  <td align="right" id="addressLabel"><div align="left">
			    <textarea name="companyAddress" cols="34" rows="3" id="companyAddress" onKeyPress="checkKey(event);"></textarea>
		      </div></td>
		  </tr>
		</table>
	</div>
	<div id="button">
		<input type="button" id="dialogSaveButton" value="Save" onClick="saveInfo();">
		<input type="button" id="dialogCancelButton" value="Cancel" onClick="closeDialog()">
	</div>
</div>
</form>
<div id="cover"></div>
</div>