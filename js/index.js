


$(document).ready(init);
function init()
{


$("form").on("submit",function(e)
{
    //delete exist photo
   $("#loaded_photo").attr("src","");

    //remove exist data rgb
    $("#data_tbl").children().remove()





    let submit={submit:"submit"};
    e.preventDefault();
       $.ajax({
           url:"./src/analyze.php",
           type: "POST",
            data:  new FormData(this),
            contentType: false,
           cache: false,
            processData:false,
           success: function(ret_data) {

               let selectFile = document.getElementById("file_load").files[0];
            //TODO: use return data to append an html element to present the results.
               console.table(ret_data);


            $.each(ret_data,function(i,val) {
                $("#data_tbl").append("<p>" + ret_data[i].display + " :   " + ret_data[i].percent + "%" + "<span style='height:30px;display:block;background-color:" + ret_data[i].display + ";'>"  +"<span> </p>"  );



               });




               $("#loaded_photo").attr("src", "http://localhost:4000/www/photo-analyze/src/uploads/" + selectFile.name);

           },
           error:function(xhr,status,error)
           {
               console.log(xhr.responseText);

               alert("error - " + xhr.responseText);
           }

        
       });
});

}







