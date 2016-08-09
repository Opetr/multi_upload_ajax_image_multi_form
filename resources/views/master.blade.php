<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <style>
        img{
            width: 50px;
        }
    </style>
</head>
<body>
<div class="container">

    <h1>Image Uploader </h1>

    <input type="file" name="images[]" id="images" multiple="multiple">
    <hr>
    <div id="images-to-upload">


    </div>{{-- End image title-to-upload --}}

    <hr>

    <a href="#" class="btn btn-sm btn-success">Upload all images</a>

</div>

<script>

    // indirect ajax
    // file collection array
    var fileCollection = new Array();

    $('#images').on('change', function(e){

       var files = e.target.files;

        $.each(files, function(i, file){

            fileCollection.push(file);

           var reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = function(e){

                var template = '<form action="/upload">'+
                        '<img src="'+e.target.result+'">'+
                        '<label for="title">Image Title</label><input type="text" name="title" id="">'+
                        '<button class="btn btn-sm btn-info upload">Upload</button>'+
                        '<a href="#" class="btn btn-sm btn-danger remove">Remove</a>'+
                        '</form>'+
                        '<br>';

                $('#images-to-upload').append(template);
            };

        });

    });
    // form upload
    $(document).on('submit', 'form', function(e){

        e.preventDefault();

        var index =$(this).index();

        var formdata = new FormData($(this)[0]); // direct form not object

        //append the file relation to index
        formdata.append('image', fileCollection[index]);

        var request = new XMLHttpRequest();
        request.open('post', 'server.php', true);

        request.send(formdata);
//        console.log('form prevented')
//        console.log(e);
//        console.log($(this));
        // this form index
//        console.log($(this).index())
//        var index = $(this).index();
//        console.log(fileCollection[index]);
    });
</script>
</body>
</html>