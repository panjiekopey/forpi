/*$(function(){
  $( 'textarea.texteditor' ).ckeditor({toolbar:'Full'});
  $( 'textarea.mini-texteditor' ).ckeditor({toolbar:'Basic',width:700});
});*/

$(function(){
        $( 'textarea.texteditor' ).ckeditor({
                toolbar:
                /*[
                ['Source','-','Save','NewPage','Preview','-','Templates'],
        ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
        '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Link','Unlink','Anchor','Youtube'],
        ['Image','Flash','Table','HorizontalRule','Hhs','Smiley','SpecialChar','PageBreak'],
        '/',
        ['Styles','Format','Font','FontSize'],
        ['TextColor','BGColor'],
        ['Maximize', 'ShowBlocks','-','About','CreatePlaceholder']

        ]*/'Full',
        //this code below for kcfinder
        filebrowserBrowseUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor/kcfinder/browse.php?opener=ckeditor&amp;type=files',
        filebrowserImageBrowseUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor/kcfinder/browse.php?opener=ckeditor&amp;type=images',
        filebrowserFlashBrowseUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor/kcfinder/browse.php?opener=ckeditor&amp;type=flash',
        filebrowserUploadUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor/kcfinder/upload.php?opener=ckeditor&amp;type=files',
        filebrowserImageUploadUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor/kcfinder/upload.php?opener=ckeditor&amp;type=images',
        filebrowserFlashUploadUrl: '/ci_bootstrap_3/assets/grocery_crud/texteditor/ckeditor/kcfinder/upload.php?opener=ckeditor&amp;type=flash'
        ,width:700
        });
        $( 'textarea.mini-texteditor' ).ckeditor({
                toolbar: 'Basic',
                width: 700
        });
});
