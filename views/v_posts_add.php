<!--Add posts form-->
<form method="POST" enctype="multipart/form-data">
	
	<label for='content'>Add your book review:</label><br/>
	Author: <input type="text" name="author"/>
	Title: <input type="text" name="title"/>
	<textarea name='content' id='content'></textarea>
	<br /><br />
	
	Upload book cover image: <input type='file' name='image'>
		
	<input type='submit' value='Add review'>

<!--</form>-->
</form>

<div id="results"></div>