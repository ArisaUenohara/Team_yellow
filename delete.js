 //deleteBtn(削除ボタン)をクリックした時。
    $(".delete-Btn").click(function(){
        //data-idをbtnidで取得
        var btnid = $(this).data("id");
        //関数deleteData()を呼び出します。
        //btnidをidを通して削除するデータを渡します。
        deleteData(btnid);
    });
          
    //関数deleteData()にbtnid(削除するデータのid)が渡されます。
    function deleteData(btnid){
        //Ajaxを使って、delete_func.phpに削除するidを投げます。
        //削除の処理自体はdelete_func.phpが行います。
        //jsだけではサーバーサイドを扱うことはできません。
        $.ajax({
                type: 'POST',
                dataType:'json',
                //データを投げる先のphpを指定。
                url:'functions/delete.php',
                data:{
                    //送信するデータを設定。
                    //ひとまず右辺と左辺btnidにしてください。
                    btnid:btnid,
                },
                success:function(data) {
                    //削除が成功したら、結果がdataで受け取れます。
                    //何を結果として送信するかはphp側で決められます。
                    //今回は特に受けとらず、画面を再読み込みします。
                    window.location.href = "./";
                },
                error:function(XMLHttpRequest, textStatus, errorThrown) {
                    //何かエラーが起きた時、エラーを表示させます。
                    alert(errorThrown);
                }
        });
    };