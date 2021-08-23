setTimeout(function(){
   document.getElementById('msg').style.	display = 'none';
}, 3000);  //4secs

reset(function(){
	document.getElementById("name").textContent = '';
	document.getElementById("email").textContent = '';
	document.getElementById("message").textContent = '';
});

reset_post(function () {
    document.getElementById("title").setContent = '';
    document.getElementById("category").setContent = '';
    document.getElementById("image").setContent = '';
    document.getElementById("link").setContent = '';
    document.getElementById("content").setContent = '';
	//alert("Function working!");
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        // noinspection SpellCheckingInspection
        reader.onload = function (e) {
            $('#image_view')
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}