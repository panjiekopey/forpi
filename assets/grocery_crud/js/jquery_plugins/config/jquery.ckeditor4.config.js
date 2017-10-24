// Added by CI Bootstrap 3
$(function(){
	$( 'textarea.texteditor' ).ckeditor({toolbar:'Full',
      filebrowserBrowseUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor4/kcfinder/browse.php?opener=ckeditor&amp;type=files',
      filebrowserImageBrowseUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor4/kcfinder/browse.php?opener=ckeditor&amp;type=images',
      filebrowserFlashBrowseUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor4/kcfinder/browse.php?opener=ckeditor&amp;type=flash',
      filebrowserUploadUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor4/kcfinder/upload.php?opener=ckeditor&amp;type=files',
      filebrowserImageUploadUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor4/kcfinder/upload.php?opener=ckeditor&amp;type=images',
      filebrowserFlashUploadUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor4/kcfinder/upload.php?opener=ckeditor&amp;type=flash'
    ,width:700
  });
	$( 'textarea.mini-texteditor' ).ckeditor({toolbar:'Basic',width:700});
});
