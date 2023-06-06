$(document).ready(function () {


    $('#add_post_form').submit(function(e){
        e.preventDefault();
        // console.log('add form is clicked');
        const formdata = new FormData(this);
        console.log(formdata);
        $("#add_post_btn").text("Adding...");
        $.ajax({
            url : '/news/create',
            data : formdata,
            contentType : false,
            processData : false,
            cache : false,
            success : function(response){
                $('#add_post_modal').modal('hide');
                $('#add_post_form')[0].reset();
                fetchAllPosts();
                $("#add_post_btn").text("Add Post");

            }
        })
    })

    function fetchAllPosts(){
        $.ajax({
            url: 'news/fetch',
            method: 'get',
            success: function(response) {
                // $('#show_posts').html(response.message);
                console.log(response.message);
            }
        })
    }
})