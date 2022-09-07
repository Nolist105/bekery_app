function fetchemp(){
    var id = document.getElementById("material_name").value;

    $.ajax({
        url:"../material/fetchMat.php",
        method: "POST",
        data:{
            x : id
        },
        dataType: "JSON",
        success: function(data){
            document.getElementById("M_ID").value = data.M_ID;
            document.getElementById("M_unit_pack").value = data.M_unit_pack;
            console.log(data);
        }
    });
}