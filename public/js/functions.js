function resetForm(id) {
    $('#' + id + ' input, #' + id + ' select, #' + id + ' textarea').each(
        function (index) {
            var input = $(this);
            if (input.attr('type') != "submit" && input.attr('type') != "button") {
                if (input.attr('type') == "checkbox") {
                    input.prop('checked', false)
                } else {
                    input.val("")
                }
            }

            //reset inputs from ckeditor
            if (findClass(input, "ckeditor")) {
                CKEDITOR.instances[input.attr("id")].setData('')
            }
        }
    );
}

function findClass(element, class_name) {
    let classes = (element.attr('class') + "").split(" ")
    for (let i = 0; i < classes.length; i++) {
        const item_class = classes[i];
        if (item_class == class_name.replace(/\s/g, '')) {
            return true
        }
    }
    return false
}

function classExist(class_name) {
    return $('div.'+class_name).length
}