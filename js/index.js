


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



//test
function find_max()
{

var arr2=new Array();
var arr1=[1,34,45,2,7,111,5,99,40,76,55,99,94,92];
let arr_len=arr1.length;
var max=0;
arr1.forEach(element => {
    if(element>max)
    {
        max = element;
    }



});

arr2.push(max);
return arr2;
}



function test()
{

    var number=3;
    var result;
    while(number>0)
    {
        find_max();
        number--;
    }


}