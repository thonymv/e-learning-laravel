function resetForm(id) {
    $('#'+id+' input, #'+id+' select, #'+id+' textarea').each(
        function(index){
            var input = $(this);
            if (input.attr('type') != "submit" && input.attr('type') != "button") {
                input.val("")
            }

            //reset inputs from ckeditor
            if (
                (input.attr('class')+"").includes(" ckeditor ") ||
                (input.attr('class')+"").replace(/\s/g, '') == "ckeditor"
            ){
                CKEDITOR.instances[input.attr("id")].setData('')
            }
        }
    );
}

