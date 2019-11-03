function addAmigo(id, obj,baseURL){
    if(id != ''){
        
        $.ajax({
            url: baseURL+"ajax/addFriend",
            type: 'POST',
            data:{id:id},
            success: function(){
                $(obj).closest('.sugestaoItem').fadeOut('slow');
            }
        });
    }
}
function accAmigo(id, obj){
    if(id != ''){
        
        $.ajax({
            url:"./ajax/accFriend",
            type: 'POST',
            data:{id:id},
            success: function(){
                $(obj).closest('.sugestaoItem').fadeOut('slow');
            }
        });
    }
}
function recAmigo(id, obj){
    if(id != ''){
        
        $.ajax({
            url:"./ajax/recFriend",
            type: 'POST',
            data:{id:id},
            success: function(){
                $(obj).closest('.sugestaoItem').fadeOut('slow');
            }
        });
    }
}
function curtir(obj, baseURL){
    var id = $(obj).attr("data-id");
    var likes = parseInt($(obj).attr("data-likes"));
    var liked = parseInt($(obj).attr("data-liked"));
    var texto = "";
    $.ajax({
        type: 'POST',
        url: baseURL+'ajax/curtir',
        data:{id:id},
        success: function(data){
            if(data == "add"){
                texto = "Descurtir";
                likes++;
                liked = 1;
            }else{
                liked = 0;
                texto = "Curtir";
                likes--;
            }
            $(obj).attr("data-liked", liked);
            $(obj).attr("data-likes", likes);
            $(obj).html('('+likes+') '+texto);
        }
    });
}
function displayComentario(obj){
    $(obj).closest(".postItem_Botoes").find(".postItem_Comentario").slideToggle();
}
function displayComentarios(obj){
    $(obj).closest(".postItem").find(".postItem_Comentarios").slideToggle();
}
function comentar(obj, baseURL){
    var id = $(obj).attr("data-id");
    var txt = $(obj).closest(".postItem_Comentario").find(".postItem_Text").val();
    $.ajax({
        type: 'POST',
        url: baseURL+"ajax/comentar",
        data:{
            id:id,
            txt:txt
        },
        success: function(){
            $(obj).closest(".postItem_Comentario").find(".postItem_Text").val("");
            $(obj).closest(".postItem_Comentario").slideToggle();
        }
    });
}