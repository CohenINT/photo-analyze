


$(document).ready(init);
function init()
{


$("form").on("submit",function(e)
{
    let submit={submit:"submit"};
    e.preventDefault();
       $.ajax({
           url:"./src/analyze.php",
           type: "POST",
            data:  new FormData(this),
            contentType: false,
           cache: false,
            processData:false,
           success: function(ret_data){
          console.log("success");
            //TODO: use return data to append an html element to present the results.
            console.log("sucess ajax");
            $("body").html("");
            $.each(ret_data,function(i,val){
                $("body").append("<p>"+i+" ,"+ret_data[i].display+" , "+ret_data[i].counter+"</p>")
                });
            debugger;
           },
           error:function(xhr,status,error)
           {
               console.log("error ajax call");
               console.log(xhr);
           }

        
       });
});














}